## backup shell
- 备份shell脚本
	
	  #!/bin/bash

      # backup file dir
      BACKUP_DIR="/home/backup"

      # file name
      DATE=`date +%Y%m%d-%H%M%S`
      # save time
      DAYS=365
      # dist dir
      DIST_DIR="/home/wwwroot/test"

      # file prefix
      BACKUP_PREFIX=wateroa

      # do tar
      tar -zcPf ${BACKUP_DIR}/${BACKUP_PREFIX}${DATE}.tar.gz ${DIST_DIR} -X ${BACKUP_DIR}/exclude.txt

      # remove outdate file
      find ${BACKUP_DIR} -name "${BACKUP_PREFIX}*" -type f -mtime +${DAYS} -exec rm {} \;
         
- 排除某些目录(日志和缓存),exclude.txt文件中写入
         
        #/data/web/var
        #/data/web/logs
