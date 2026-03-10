## SOAP
##### SoapClient::__soapCall — Calls a SOAP function

说明 

	public mixed SoapClient::__soapCall ( string $function_name , array $arguments [, array $options [, mixed $input_headers [, array &$output_headers ]]] )
    
options
An associative array of options to pass to the client.

- The **location** option is the URL of the remote Web service.

- The **uri** option is the target namespace of the SOAP service.

- The **soapaction** option is the action to call.
#### SOAP Service
``` php
class SmsService
{

    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * 短信发送
     */
    public function send($phone, $content)
    {
        $client = $this->getSoapClinet();
        $sendId = time() . uniqid();
        try {
            $params = $this->getParams($phone, $content, $sendId);
            $response = $client->__soapCall('SEND', [
                'parameters' => $params
            ]);
            //打印和调试上一次的请求
            dump($client->__getLastRequest());
            $xml = simplexml_load_string($response->return, "SimpleXMLElement", LIBXML_NOCDATA);
            $result = json_decode(json_encode($xml), true);
            if (isset($result['flag']) && $result['flag'] == '00') {
                return [
                    'code' => 1,
                    'msg' => 'success'
                ];
            } else {
                // 01 失败; 02密码错; 03 系统错误
                return [
                    'code' => 2,
                    'msg' => 'faild',
                    'data' => [
                        isset($result['flag']) ? $result['flag'] : '03'
                    ]
                ];
            }
        } catch (\Exception $e) {
            return [
                'code' => 3,
                'msg' => 'exception',
                'data' => [
                    'exception_code' => $e->getCode(),
                    'exception_msg' => $e->getMessage(),
                    'request' => $e->getFile(),
                    'response' => $e->getLine()
                ]
            ];
        }
    }

    /**
     *
     * @return \SoapClient
     */
    private function getSoapClinet()
    {
        return new \SoapClient("http://ip:port/GATWebService/SMSWebService?wsdl", [
            'trace' => 1, //开启调试模式
            'soap_version' => SOAP_1_1 //或者SOAP_1_2
        ]);
    }

    /**
     */
    private function getParams($phone, $content, $sendId)
    {
        return [
            'userID' => 92,
            'password' => '****',
            'phone' => $phone,
            'content' => $content,
            'sendSEQ' => $sendId,
            'orID' => 98
        ];
    }
}
```
### 非标准soap的service
``` php
<?php
namespace BaseBundle\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;
use SystemBundle\Entity\SmsLog;

class SmsSoapService
{

    private $em;

    private $container;

    /**
     *
     * @var \Doctrine\Bundle\DoctrineBundle\Registry
     */
    private $doctrine;

    public function __construct(EntityManager $em, Container $container)
    {
        $this->em = $em;
        $this->container = $container;
        $this->doctrine = $this->container->get('doctrine');
    }

    /**
     * 发起请求
     *
     * @param unknown $mobile            
     * @param string $type            
     * @param string $code            
     * @param number $origin            
     * @param number $sendType            
     * @param string $ip            
     * @return number[]|string[]|number[]|string[]|string[][]|NULL[][]|number[][]|number[]|string[]|\Psr\Http\Message\RequestInterface[][]|\Psr\Http\Message\ResponseInterface[][]|NULL[][]|number[]|string[]|NULL[][]
     */
    public function request($mobile, $type = '', $code = '', $origin = 0, $sendType = 0, $ip = '', $userID = 0)
    {
        try {
            $client = $this->getSoapClinet();
            
            $header = new \SoapHeader('http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd', 'Security', $this->getHeaderSoapVar());
            $client->__setSoapHeaders($header);
            if (empty($code)) {
                $code = substr(str_shuffle('1234567890'), 0, 4);
            }
            if (false === $params = $this->getRequestParam($mobile, $type, $code)) {
                return [
                    'code' => 8,
                    'msg' => 'faild 参数有误',
                    'data' => ''
                ];
            }
            $response = $client->__soapCall("sendSms", array(
                new \SoapParam($params['soap_var'], 'sendSms')
            ));
            $result = json_decode($response, true);
            if (isset($result['result'])) {
                return [
                    'code' => 1,
                    'msg' => '发送成功',
                    'data' => $code
                ];
            } else {
                return [
                    'code' => 2,
                    'msg' => '发送失败',
                    'data' => $result
                ];
            }
        } catch (\Exception $e) {
            return [
                'code' => 3,
                'msg' => 'exception',
                'data' => [
                    'exception_code' => $e->getCode(),
                    'exception_msg' => $e->getMessage(),
                    'request' => $e->getFile(),
                    'response' => $e->getLine()
                ]
            ];
        }
    }
    public function getSendStatus($sendNumber, $mobile)
    {
        $client = $this->getSoapClinet();
        $header = new \SoapHeader('http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd', 'Security', $this->getHeaderSoapVar());
        $client->__setSoapHeaders($header);
        $response = $client->__soapCall("notifySmsDeliveryReceipt", array(
            new \SoapParam($this->getStatusSoapVar($sendNumber, $mobile), 'notifySmsDeliveryReceipt')
        ));
        $result = json_decode($response, true);
        return $result;
    }

    /**
     *
     * @return \SoapClient
     */
    private function getSoapClinet()
    {
        // return new \SoapClient("http://ip:port/SendSmsService/services/SendSms?wsdl"); //政务外网区
        return new \SoapClient("http://ip:port/SendSmsService/services/SendSms?wsdl", array(
            'trace' => 1,
            'exceptions' => 0, //此项设置为0时，wsdl服务异常时，并不会主动抛出异常，但会返回异常结果
            'soap_version' => SOAP_1_1
        )); // 互联网区
    }
    private function getHeaderSoapVar()
    {
        $spId = 12345678;
        $spPassword = 'xxxxxxxx';
        $serviceId = 1;
        $headerXml = <<<XML
<v2:RequestSOAPHeader xmlns:v2='http://www.huawei.com.cn/schema/common/v2_1'>
    <v2:spId>{$spId}</v2:spId>
    <v2:spPassword>{$spPassword}</v2:spPassword>
    <v2:serviceId>{$serviceId}</v2:serviceId>
 </v2:RequestSOAPHeader>
XML;
        return new \SoapVar($headerXml, XSD_ANYXML);
    }

    private function getStatusSoapVar($sendNumber, $mobile)
    {
        $statusXml = <<<XML
<ns2:notifySmsDeliveryReceipt xmlns:ns2="http://www.csapi.org/schema/parlayx/sms/notification/v2_2/local">
         <ns2:correlator>{$sendNumber}</ns2:correlator>
         <ns2:deliveryStatus>
            <address>tel:{$mobile}</address>
            <deliveryStatus>DeliveredToTerminal</deliveryStatus>
         </ns2:deliveryStatus>
      </ns2:notifySmsDeliveryReceipt>
XML;
        return new \SoapVar($statusXml, XSD_ANYXML);
    }
    private function getRequestParam($mobile, $type, $code = "")
    {
        switch ($type) {
            case 'register':
            case 'forget':
            case 'sms':
                $msg = '【这个是签名】您的短信验证码为' . $code . '有效时间为10分钟,请保管好您的验证码,不要泄露信息。';
                break;
            default:
                $msg = $code;
                break;
        }
        $requestxml = <<<XML
<loc:sendSms xmlns:loc="http://www.csapi.org/schema/parlayx/sms/send/v2_2/local">
 <loc:addresses>tel:{$mobile}</loc:addresses>
 <loc:message>{$msg}</loc:message>
  <loc:priority>5</loc:priority>
</loc:sendSms>
XML;
        return [
            'uri' => '/SendSmsService/services/SendSms?wsdl',
            'content' => $msg,
            'soap_var' => new \SoapVar($requestxml, XSD_ANYXML),
            'action' => 'sendSms',
        ];
    }
}
```

