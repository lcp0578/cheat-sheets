## PHP Coding Standards Fixer (PHP CS Fixer) 
- 官网：https://cs.symfony.com/
- 简单使用
	- 第一步，安装（需要创建tools/php-cs-fixer目录）
	
			composer require --working-dir=tools/php-cs-fixer friendsofphp/php-cs-fixer
	- 第二步，简单使用

			tools/php-cs-fixer/vendor/bin/php-cs-fixer fix src
			或
			tools\php-cs-fixer\vendor\bin\php-cs-fixer fix src