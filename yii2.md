## yii2
1. 安装框架  

		composer global require "fxp/composer-asset-plugin:^1.2.0" 
	安装 Composer asset plugin， 它是通过 Composer 管理 bower 和 npm 包所必须的  

		composer create-project --prefer-dist yiisoft/yii2-app-basic project_name
		composer create-project --prefer-dist yiisoft/yii2-app-advanced project_name
2. 约定  
	控制器：  

		article 对应 app\controllers\ArticleController;
		post-comment 对应 app\controllers\PostCommentController;
		admin/post-comment 对应 app\controllers\admin\PostCommentController;
		adminPanels/post-comment 对应 app\controllers\adminPanels\PostCommentController.
3. 生成入口文件  
	init.bat OR init