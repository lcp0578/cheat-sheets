## Clear Cache In Controller

	<?php
	namespace KitAdminBundle\Controller;
	
	use Symfony\Component\Console\Input\ArrayInput;
	use Symfony\Bundle\FrameworkBundle\Console\Application;
	use Symfony\Component\Console\Output\BufferedOutput;
	use KitBaseBundle\Controller\BaseController;
	use Symfony\Component\HttpFoundation\Request;
	
	/**
	 * cache controller.
	 */
	class CacheController extends BaseController
	{
	    public function indexAction(Request $request)
	    {
	        return $this->render('KitAdminBundle:Cache:index.html.twig');
	    }
	    
	    public function clearAction()
	    {
	        $result = $this->command([
	            'command' => 'cache:clear',
	            '--env'   => 'prod',
	        ]);
	        if(0 == $result['code']){
	            return $this->json([
	                'code' => 1,
	                'msg' => '清除成功'
	            ]);
	        }else{
	            return $this->json([
	                'code' => 2,
	                'msg' => '清除失败'
	            ]);
	        }
	    }
	    
	    public function clearfileAction()
	    {
	        /**
	         * @var \Symfony\Component\Filesystem\Filesystem $fs
	         */
	        $fs = $this->get('filesystem');
	        //$fs = new Filesystem();
	        $fs->remove($this->getParameter('kernel.cache_dir'));
	        return $this->json([
	            'code' => 1,
	            'msg' => '清除成功'
	        ]);
	        
	    }
	    
	    public function doctrineAction()
	    {
	        // 
	        $result = $this->command([
	            'command' => 'doctrine:cache:clear-metadata',
	            '--env'   => 'prod',
	        ]);
	        if(0 != $result['code']){
	           return $this->json([
	               'code' => 2,
	               '清除metadata缓存失败'
	           ]); 
	        }
	        $result = $this->command([
	            'command' => 'doctrine:cache:clear-query',
	            '--env'   => 'prod',
	        ]);
	        if(0 != $result['code']){
	            return $this->json([
	                'code' => 3,
	                '清除query缓存失败'
	            ]);
	        }
	        $result = $this->command([
	            'command' => 'doctrine:cache:clear-result',
	            '--env'   => 'prod',
	        ]);
	        if(0 != $result['code']){
	            return $this->json([
	                'code' => 4,
	                '清除result缓存失败'
	            ]);
	        }else{
	            return $this->json([
	                'code' => 1,
	                '清除缓存成功'
	            ]);
	        }
	    }
	    /**
	     * 
	     * @param unknown $arrayInput
	     * @return string[]|number[]|number[]|string[]
	     */
	    private function command($arrayInput)
	    {
	        set_time_limit(0);
	        $kernel = $this->get('kernel');
	        
	        $application = new Application($kernel);
	        $application->setAutoExit(false);
	        
	        $input = new ArrayInput($arrayInput);
	        
	        $output = new BufferedOutput();
	        try {
	            $code = $application->run($input, $output);
	            return [
	                'code' => $code,
	                'msg' => $output->fetch()
	            ];
	        }catch (\Exception $e) {
	            return [
	                'code' => -1,
	                'msg' => 'exception'
	            ];
	        }
	    }
	}
