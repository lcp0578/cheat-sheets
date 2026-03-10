## symfony 1.4
- 手动安装plugin([sfPHPExcelPlugin](http://www.symfony-project.org/plugins/sfPHPExcelPlugin))
	- 下载源码包[sfPHPExcelPlugin](http://www.symfony-project.org/plugins/sfPHPExcelPlugin)
	- 复制到vendor/symfony/lib/plugins/下，去掉版本号
	- 修改配置文件config/ProjectConfiguration.class.php
	
			$this->enablePlugins( array(‘sfDoctrinePlugin’, ‘sfPhpExcelPlugin’) );
	- 执行如下命令
	
			php symfony plugin:publish-assets

	