## yii2
- 安装框架  

		composer global require "fxp/composer-asset-plugin:^1.2.0" 
	安装 Composer asset plugin， 它是通过 Composer 管理 bower 和 npm 包所必须的  

		composer create-project --prefer-dist yiisoft/yii2-app-basic project_name
		composer create-project --prefer-dist yiisoft/yii2-app-advanced project_name
- 约定  
	控制器：  

		article 对应 app\controllers\ArticleController;
		post-comment 对应 app\controllers\PostCommentController;
		admin/post-comment 对应 app\controllers\admin\PostCommentController;
		adminPanels/post-comment 对应 app\controllers\adminPanels\PostCommentController.
- 生成入口文件  
	init.bat OR init
- gii生成  
	访问地址:

		http://youdomain.com/index.php?r=gii
	相关配置：
	
		// app-name/main-local.php
		$config['bootstrap'][] = 'gii';
	    $config['modules']['gii'] = [
	        'class' => 'yii\gii\Module',
	        'allowedIPs' => ['127.0.0.1', '::1', '192.168.0.*', '192.168.178.20'] // adjust this to your needs，限制IP
	    ];
- behaviors,即行为  
	行为是 yii\base\Behavior 或其子类的实例。 行为，也称为 [mixins](https://en.wikipedia.org/wiki/Mixin)， 可以无须改变类继承关系即可增强一个已有的 组件 类功能。  
	当行为附加到组件后，它将“注入”它的方法和属性到组件，然后可以像访问组件内定义的方法和属性一样访问它们。  
	即DI，注入了，让我想起来了php的新特性[trait](http://php.net/manual/zh/language.oop5.traits.php)。  
	官方文档也对此做出了比较，关于各自的优势和缺点：  
	- behaviors 支持继承，traits不支持  
	- behaviors 可以动态的绑定或者删除  
	- behaviors 可以配置  
	- behaviors 可以对不同的事件进行定制化的处理
	- behaviors 当名称冲突的时候，可以根据绑定的优先级进行调用
	- tarits 性能会更好（这个肯定的，PHP的特性）
	- traits IDEs支持更友好  
	
	另外，yii的filter本质上是一种特殊的behaviors
- model里面的tableName()

		public static function tableName()
	    {
	        return '{{%user_level}}'; // %为表前缀占位符
	    }
- yii Migration   
	MySQL 字段类型参考，[yii-db-schema](http://www.yiiframework.com/doc-2.0/yii-db-schema.html)  
	Create Migration

		yii migrate/create table_name
	Applying Migrations
	
		yii migrate
		