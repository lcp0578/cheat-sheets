## Api Exception Listener

- 定义ExceptionListener

		<?php
        namespace ApiBundle\EventListener;

        use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
        use Symfony\Component\HttpFoundation\JsonResponse;

        class ExceptionListener
        {
            public function onKernelException(GetResponseForExceptionEvent $event)
            {
                $uri = $event->getRequest()->getRequestUri();
                // if uri prefix is /api/
                if (false !== strpos($uri, '/api/')) {
                    // You get the exception object from the received event
                    $exception = $event->getException();
                    // Customize your response object to display the exception details
                    $response = new JsonResponse([
                        'code' => 9999,
                        'msg' => "接口服务异常",
                        'data' => [
                            'code' => $exception->getCode(),
                            'message' => $exception->getMessage()
                        ]
                    ]);
                    // sends the modified response object to the event
                    $event->setResponse($response);
                }
            }
        }

- 注册ExceptionListener

		# ApiBundle/Reources/config/services.yml
		api.exception_listener:
            class: ApiBundle\EventListener\ExceptionListener
            tags:
                - { name: kernel.event_listener, event: kernel.exception }