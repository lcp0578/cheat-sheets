## backup shell
- 备份shell脚本
	
		#!/bin/bash
        
        # backup file dir
        BACK_DIR="/data/backup/bak_web"

        # file name
        DATE=`date +%Y%m%d-%H%M%S`
        # save time
        DAYS=365
        # dist dir
        DIST_DIR="/data/web"

        # file prefix
        BACKUP_PREFIX=Web

        # do tar
        tar zcvf ${BACK_DIR}/${BACKUP_PREFIX}${DATE}.tar.gz ${DIST_DIR} -X /data/backup/exclude.txt

        #只保留指定时间内的文件
        find ${WEBBACK_DIR} -name "${BACKUP_PREFIX}*" -type f -mtime +${DAYS} -exec rm {} \;
         
- 排除某些目录(日志和缓存),exclude.txt文件中写入
         #/data/web/var
         #/data/web/logs
