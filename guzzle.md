## guzzlehttp v6

1. Exception

		try {
           
            $response = $client->post($uri, [
                'header' => [
                    'Content-Type' => 'text/xml;charset-utf-8'
                ],
                'body' => $xml
            ]);
            if (200 == $response->getStatusCode()) {
                $contentType = $response->getHeader('content-type');
                $xmlString = $response->getBody()->getContents();
                $array =\GuzzleHttp\json_decode(\GuzzleHttp\json_encode(simplexml_load_string($xmlString)), true);
                $records = isset($array['record']) && is_array($array['record']) ? $array['record'] : [];
                return [
                    'code' => 1,
                    'msg' => 'success',
                    'data' => [
                        'rows' => $records
                    ]
                ];
            } else {
                return [
                    'code' => 5,
                    'msg' => 'http error',
                    'data' => [
                        'exception_code' => $response->getStatusCode(),
                        'exception_msg' => 'http code',
                        'request' => '',
                        'response' => $response->getBody()->getContents()
                    ]
                ];
            }
        } catch (ClientException $e) {
			// GuzzleHttp\Exception\ClientException
            return [
                'code' => 2,
                'msg' => 'clint exception',
                'data' => [
                    'exception_code' => $e->getCode(),
                    'exception_msg' => $e->getMessage(),
                    'request' => $e->getRequest(),
                    'response' => $e->getResponse()
                ]
            ];
        } catch (RequestException $e) {
			//GuzzleHttp\Exception\RequestException
            return [
                'code' => 3,
                'msg' => 'request exception',
                'data' => [
                    'exception_code' => $e->getCode(),
                    'exception_msg' => $e->getMessage(),
                    'request' => $e->getRequest(),
                    'response' => $e->getResponse()
                ]
            ];
        } catch (\Exception $e) {
            return [
                'code' => 4,
                'msg' => 'exception',
                'data' => [
                    'exception_code' => $e->getCode(),
                    'exception_msg' => $e->getMessage(),
                    'request' => '',
                    'response' => ''
                ]
            ];
        }
