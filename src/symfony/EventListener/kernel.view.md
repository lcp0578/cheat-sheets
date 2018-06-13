## kernel.view
- 需要在控制器直接返回值
- 事件监听的实现

		<?php
        namespace BaseBundle\EventListener;

        use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;

        class PdfViewListener
        {
            private $templating;
            public function __construct($templating)
            {
                $this->templating = $templating;
            }
            public function preRender(GetResponseForControllerResultEvent $event)
            {
                //result returned by the controller
                $data = $event->getControllerResult();

                /* @var $request  \Symfony\Component\HttpFoundation\Request */
                $request =  $event->getRequest();
                $template = $request->get('_template');
                $route = $request->get('_route');
                $format = $request->get('format');
                dump($format);
                dump($request);
                if('pdf' == $format){
                    $template = '@Base/Default/base.pdf.twig';
                    $data['parameters']['base_view'] = $data['view'];
                }else{
                    $template = $data['view'];
                }
                $response = $this->templating->renderResponse($template, $data['parameters']);
                $event->setResponse($response);
            }
		}
        
- 定义

		base.pdf_view_listener:
            class: BaseBundle\EventListener\PdfViewListener
            arguments: ["@templating"]
            tags:
                - { name: kernel.event_listener, event: kernel.view, method: preRender}