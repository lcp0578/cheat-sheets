## Ajax Authentication Listener
- 定义事件监听

``` php
<?php
namespace AuthBundle\EventListener;

use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @author lcp0578
 */
class AjaxAuthenticationListener
{

    /**
     * Handles security related exceptions.
     *
     * @param GetResponseForExceptionEvent $event
     *            An GetResponseForExceptionEvent instance
     */
    public function onCoreException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();
        $request = $event->getRequest();
        
        if ($request->isXmlHttpRequest()) {
            if ($exception instanceof AuthenticationException || $exception instanceof AccessDeniedException) {
                $event->setResponse(new JsonResponse([
                    'code' => 99403,
                    'msg' => '请先登录或者登录信息失效'
                ]));
            }
        }
    }
}
```
- `service.yml`定义

``` yaml
auth.ajax_authentication_listener:
        class: AuthBundle\EventListener\AjaxAuthenticationListener
        tags:
          - { name: kernel.event_listener, event: kernel.exception, method: onCoreException, priority: 1000 }
```
- 前端ajax

``` javascript
function sendAjax(url, serialize)
{
	var index = layer.load(1, {
		  shade: [0.3,'#ccc'] 
		});
	$.ajax({
		type:"post",
		url:url,
        data:serialize,
		async:true,
		beforeSend:function(XMLHttpRequest){
			console.log("ajax开始");
		},
		success:function(result, textStatus){
			layer.msg(result.msg);
			if(result.code == 1){
				nextIndex();
			}else{
				
			}
		},
		error:function(XMLHttpRequest, textStatus, errorThrown){
			 result = $.parseJSON(XMLHttpRequest.responseText);
			 console.log(result.msg);
			 if(result.msg == undefined){
				 layer.msg('请求异常');
			 }else{
				 layer.msg(result.msg);
			 }
		},
		complete:function(XMLHttpRequest, textStatus){
			layer.close(index);
			console.log("ajax结束");
		}
	});
}
```