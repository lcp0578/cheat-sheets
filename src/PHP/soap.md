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
             * 插入或更新数据库
             */
            private function flushDb($type, $data)
            {}

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
