## basic
-  Determine where a binary command is stored / located on file system

	- whereis command example  
	Display ls command location along with man page path:
		
			lcpeng@ubuntu:~$ whereis php
			php: /usr/bin/php /usr/local/php5.6 /usr/local/php

	- type command example  
	Find out which command the shell executes:

			lcpeng@ubuntu:~$ type -a php
			php is /usr/bin/php
			lcpeng@ubuntu:~$ 
			lcpeng@ubuntu:~$ type -a php5
			php5 is /usr/bin/php5