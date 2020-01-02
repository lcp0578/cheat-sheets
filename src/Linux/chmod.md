## chmod
- To change all the directories to 755 (drwxr-xr-x):

		sudo find ~/htdocs -type d -exec chmod 755 {} \;
- To change all the files to 644 (-rw-r--r--):

		sudo find ~/htdocs -type f -exec chmod 644 {} \;