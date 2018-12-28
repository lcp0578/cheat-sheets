## guzzlehttp v6

- Exception

		try {
           
            $response = $client->post($uri, [
                'header' => [
                    'Content-Type' => 'text/xml;charset-utf-8'
                ],
                'body' => $xml
            ]);
            if (200 == $response->getStatusCode()) {
                $contentType = $response->getHeader('content-type');
                $xmlString = (string)$response->getBody();
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

- get the body of a response  

	Guzzle implements PSR-7. That means that it will by default store the body of a message in a Stream that uses PHP temp streams. To retrieve all the data, you can use casting operator:

		$contents = (string) $response->getBody();
	You can also do it with

		$contents = $response->getBody()->getContents();
	The difference between the two approaches is that getContents returns the remaining contents, so that a second call returns nothing unless you seek the position of the stream with rewind or seek .

		$stream = $response->getBody();
		$contents = $stream->getContents(); // returns all the contents
		$contents = $stream->getContents(); // empty string
		$stream->rewind(); // Seek to the beginning
		$contents = $stream->getContents(); // returns all the contents
	Instead, usings PHP's string casting operations, it will reads all the data from the stream from the beginning until the end is reached.

- POST
	
		$client = new \GuzzleHttp\Client();
		$response = $client->request('POST', 'http://www.example.com/user/create', [
		    'form_params' => [
		        'email' => 'test@gmail.com',
		        'name' => 'Test user',
		        'password' => 'testpassword',
		    ]
		]);
- Request with POST files

		$response = $client->request('POST', 'http://www.example.com/files/post', [
		    'multipart' => [
		        [
		            'name'     => 'file_name',
		            'contents' => fopen('/path/to/file', 'r')
		        ],
		        [
		            'name'     => 'csv_header',
		            'contents' => 'First Name, Last Name, Username',
		            'filename' => 'csv_header.csv'
		        ]
		    ]
		]);	
- REST verbs usage with params
		
		// PUT
		$client->put('http://www.example.com/user/4', [
		    'body' => [
		        'email' => 'test@gmail.com',
		        'name' => 'Test user',
		        'password' => 'testpassword',
		    ],
		    'timeout' => 5
		]);
		
		// DELETE
		$client->delete('http://www.example.com/user');
- Async POST data
		
		$client = new \GuzzleHttp\Client();
		$promise = $client->requestAsync('POST', 'http://www.example.com/user/create', [
		    'form_params' => [
		        'email' => 'test@gmail.com',
		        'name' => 'Test user',
		        'password' => 'testpassword',
		    ]
		]);
		$promise->then(
		    function (ResponseInterface $res) {
		        echo $res->getStatusCode() . "\n";
		    },
		    function (RequestException $e) {
		        echo $e->getMessage() . "\n";
		        echo $e->getRequest()->getMethod();
		    }
		);
- POST JSON数据包

		$response = $client->request('POST', '/api', ['json' => ['username' => 'lcp0578']]);