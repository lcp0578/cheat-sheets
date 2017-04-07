## composer cheat sheet

1 . 为某个项目设置中国的镜像

    composer config repo.packagist composer https://packagist.phpcomposer.com
	
站点地址：[https://pkg.phpcomposer.com/](https://pkg.phpcomposer.com/)

2 . 加载一个包

    composer require symfony/finder

3 . 更新自动加载的文件
	
	composer dump-autoload