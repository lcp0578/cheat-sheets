## ApiKeyAuthenticator示例
		     
	<?php
	
	namespace App\AuthBundle\Security;
	
	use Symfony\Component\HttpFoundation\JsonResponse;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
	use Symfony\Component\Security\Core\Exception\AuthenticationException;
	use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
	use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
	use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
	use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
	use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;
	use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;
	use Symfony\Component\HttpFoundation\RedirectResponse;
	use App\AclBundle\Entity\User;
	use Kit\CryptBundle\Service\OpensslService;
	use App\AuditBundle\Service\LogService;
	use Doctrine\ORM\EntityManagerInterface;
	
	class ApiKeyAuthenticator extends AbstractAuthenticator implements AuthenticationEntryPointInterface {
		private $em;
		private $opensslService;
		private $logService;
		
		public function __construct(EntityManagerInterface $em, OpensslService $opensslService, LogService $logService) {
			$this->em = $em;
			$this->opensslService= $opensslService;
			$this->logService = $logService;
		}
		/**
		 *
		 * {@inheritdoc}
		 *
		 * @see \Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface::start()
		 */
		public function start(Request $request, AuthenticationException $authException = null) {
			$url = $this->router->generate ( 'api_v1_login_index' );
			return new RedirectResponse ( $url );
		}
		/**
		 * Called on every request to decide if this authenticator should be
		 * used for the request.
		 * Returning `false` will cause this authenticator
		 * to be skipped.
		 */
		public function supports(Request $request): ?bool {
			return strpos ( $request->getRequestUri (), '/api/' ) === 0;
		}
		public function authenticate(Request $request): Passport {
			$apiToken = $request->headers->get ( 'X-AUTH-TOKEN' );
			if (null === $apiToken) {
				// The token header was empty, authentication fails with HTTP Status
				// Code 401 "Unauthorized"
				throw new CustomUserMessageAuthenticationException ( 'No API token provided', [ 
						'code' => 51,
						'msg' => '无令牌，请先登录' 
				]);
			}
			
			return new SelfValidatingPassport ( new UserBadge ( $apiToken, function ($userIdentifier) {
				$tokenStr = $this->opensslService->decrypt ( $userIdentifier);
				if (false === strpos ( $tokenStr, '|' )) {
					throw new CustomUserMessageAuthenticationException ( 'No API token provided', [
							'code' => 52,
							'msg' => '用户令牌异常' 
					]);
				}
				$tokenInfo = explode ( '|', $tokenStr );
				if (3 !== count ( $tokenInfo )) {
					throw new CustomUserMessageAuthenticationException ( 'No API token provided', [
							'code' => 53,
							'msg' => '用户令牌信息缺失' 
					]);
				}
				//$entity = $userType == 1 ? 'AclBundle:User' : 'App\MemberBundle:User';
				$user = $this->em->getRepository ( User::class)->find ( intval ( $tokenInfo [0] ) );
				if (empty ( $user )) {
					throw new CustomUserMessageAuthenticationException ( 'No API token provided', [
							'code' => 54,
							'msg' => '用户信息异常' 
					]);
				}
				if ($tokenInfo [2] != $user->getExpireAt ()->getTimestamp ()) {
					throw new CustomUserMessageAuthenticationException ( 'No API token provided', [
							'code' => 55,
							'msg' => '登录信息已失效，请重新登陆' 
					]);
				}
				if ($user->getAppStatus () != 1) {
					throw new CustomUserMessageAuthenticationException ( 'No API token provided', [
							'code' => 56,
							'msg' => '登录状态异常，请重新登陆'
					]);
				}
				return $user;
			} ));
		}
		
		public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
		{
			// on success, let the request continue
			return null;
		}
		
		public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
		{
			return new JsonResponse($exception->getMessageData());
		}
	}