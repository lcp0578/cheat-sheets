## deploy git project shell
- 配置ssh key到本地
	
		#!/bin/bash
 
		WEB_PATH='/home/wwwroot/kitlabs.cn'
		WEB_BIN=$WEB_PATH/bin/console
		WEB_USER='www'
		WEB_USERGROUP='www'
		 
		echo "Start deployment"
		cd $WEB_PATH
		echo "pulling source code..."
		git reset --hard origin/master
		git clean -f
		git pull
		git checkout master
		echo "changing permissions..."
		chown -R $WEB_USER:$WEB_USERGROUP $WEB_PATH
		echo "Finished."
        
		echo "start clear cache..."
		php $WEB_BIN  cache:clear --env=prod --no-debug
		echo "clear cache end."
		
        echo "start clear doctrine cache..."
        php $WEB_BIN doctrine:cache:clear-metadata --env=prod
        php $WEB_BIN doctrine:cache:clear-query --env=prod
        php $WEB_BIN doctrine:cache:clear-result --env=prod
        echo "clear doctrine cache end."
  
        echo "start update db schema"
        php $WEB_BIN doctrine:schema:update --force
        echo "update db schema end."
        
        echo "start install asset"
		php $WEB_BIN  asset:install
        echo "install asset end."
		
        echo "start chown"
		chown -R $WEB_USER:$WEB_USERGROUP $WEB_PATH
        echo "chown end."