## Asset 
The Asset component manages URL generation and versioning of web assets such as CSS stylesheets, JavaScript files and image files.  

管理静态资源。 

### console command

	# make a hard copy of the assets in web/
	$ php bin/console assets:install
	
	# if possible, make absolute symlinks in web/ if not, make a hard copy
	$ php bin/console assets:install --symlink
	
	# if possible, make relative symlinks in web/ if not, make a hard copy
	$ php bin/console assets:install --symlink --relative