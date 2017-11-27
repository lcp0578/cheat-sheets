## Socket
### UDP
- server

		private function udpServer($ip, $port, OutputInterface $output)
	    {
	        if(!($socket = socket_create(AF_INET, SOCK_DGRAM, 0)))
	        {
	            $errorcode = socket_last_error();
	            $errormsg = socket_strerror($errorcode);
	            $output->writeln([
	                'Couldn\'t create socket',
	                $errorcode,
	                $errormsg
	            ]);
	            die();
	        }
	        
	        $output->writeln(["Socket created"]);
	        
	        // Bind the source address
	        if( !socket_bind($socket, $ip , $port) )
	        {
	            $errorcode = socket_last_error();
	            $errormsg = socket_strerror($errorcode);
	            $output->writeln([
	                'Could not bind socket:',
	                $errorcode,
	                $errormsg
	            ]);
	            die();
	        }
	        $output->writeln(["Socket bind OK "]);
	        $from = '';
	        $port = 0;
	        $buf = '';
	        socket_recvfrom($socket, $buf, 2048, 0, $from, $port);
	        $output->writeln([
	            'Client is now connected to us.',
	            $from,
	            $port,
	            'Received:',
	            $buf
	        ]);
	    }

- client

		private function udpClient($ip, $port, OutputInterface $output)
	    {
	        if(!($sock = socket_create(AF_INET, SOCK_DGRAM, 0)))
	        {
	            $errorcode = socket_last_error();
	            $errormsg = socket_strerror($errorcode);
	            $output->writeln([
	                'Couldn\'t create socket',
	                $errorcode,
	                $errormsg
	            ]);
	            die();
	        }
	        $message = 'client udp message';
	        
	        $bytes = socket_sendto($sock, $message , strlen($message), 0, $ip, $port);
	        socket_close($sock);
	        $output->writeln([
	            'send ' . $bytes . ' bytes'
	        ]);
	    }

### TCP