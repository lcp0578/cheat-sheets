## SOAP
##### SoapClient::__soapCall — Calls a SOAP function

说明 

	public mixed SoapClient::__soapCall ( string $function_name , array $arguments [, array $options [, mixed $input_headers [, array &$output_headers ]]] )
    
options
An associative array of options to pass to the client.

- The **location** option is the URL of the remote Web service.

- The **uri** option is the target namespace of the SOAP service.

- The **soapaction** option is the action to call.