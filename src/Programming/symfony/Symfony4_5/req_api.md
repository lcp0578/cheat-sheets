## symfony composer req api
#### 加载包
	$ symfony composer req api
	./composer.json has been updated
	Running composer update api-platform/api-pack
	Loading composer repositories with package information
	Updating dependencies
	Lock file operations: 3 installs, 0 updates, 0 removals
	  - Locking api-platform/api-pack (v1.3.0)
	  - Locking symfony/orm-pack (v2.4.0)
	  - Locking symfony/serializer-pack (v1.1.0)
	Writing lock file
	Installing dependencies from lock file (including require-dev)
	Package operations: 3 installs, 0 updates, 0 removals
	  - Installing symfony/serializer-pack (v1.1.0): Extracting archive
	  - Installing symfony/orm-pack (v2.4.0): Extracting archive
	  - Installing api-platform/api-pack (v1.3.0): Extracting archive
	Package sensio/framework-extra-bundle is abandoned, you should avoid using it. Use Symfony instead.
	Generating optimized autoload files
	composer/package-versions-deprecated: Generating version class...
	composer/package-versions-deprecated: ...done generating version class
	139 packages you are using are looking for funding.
	Use the `composer fund` command to find out more!
	
	Run composer recipes at any time to see the status of your Symfony recipes.
	
	Unpacking Symfony packs
	  - Unpacked api-platform/api-pack
	  - Unpacked symfony/orm-pack
	  - Unpacked symfony/serializer-pack
	Loading composer repositories with package information
	Updating dependencies
	Nothing to modify in lock file
	Installing dependencies from lock file (including require-dev)
	Package operations: 0 installs, 0 updates, 3 removals
	  - Removing symfony/serializer-pack (v1.1.0)
	  - Removing symfony/orm-pack (v2.4.0)
	  - Removing api-platform/api-pack (v1.3.0)
	Package sensio/framework-extra-bundle is abandoned, you should avoid using it. Use Symfony instead.
	Generating optimized autoload files
	composer/package-versions-deprecated: Generating version class...
	composer/package-versions-deprecated: ...done generating version class
	137 packages you are using are looking for funding.
	Use the `composer fund` command to find out more!
	
	Run composer recipes at any time to see the status of your Symfony recipes.
	
	Executing script cache:clear [OK]
	Executing script assets:install public [OK]
	
	Found 1 security vulnerability advisory affecting 1 package.
	Run composer audit for a full list of advisories.
	
	Found 1 security vulnerability advisory affecting 1 package.
	Run composer audit for a full list of advisories.
#### composer audit

	$ composer audit
	Found 1 security vulnerability advisory affecting 1 package:
	+-------------------+----------------------------------------------------------------------------------+
	| Package           | api-platform/core                                                                |
	| CVE               | CVE-2023-25575                                                                   |
	| Title             | CVE-2023-25575: Secured properties may be accessible within collections          |
	| URL               | https://github.com/api-platform/core/security/advisories/GHSA-vr2x-7687-h6qv     |
	| Affected versions | >=2.6.0,<2.7.10|>=3.0.0,<3.0.12|>=3.1.0,<3.1.3                                   |
	| Reported at       | 2023-02-28T10:37:00+00:00                                                        |
	+-------------------+----------------------------------------------------------------------------------+
#### 查看安装的版本

	$ composer show -i api-platform/core
	You are using the deprecated option "installed". Only installed packages are shown by default now. The --all option can be used to show all packages.
	name     : api-platform/core
	descrip. : Build a fully-featured hypermedia or GraphQL API in minutes!
	keywords : Hydra, JSON-LD, api, graphql, hal, jsonapi, openapi, rest, swagger
	versions : * v2.7.0
	type     : library
	license  : MIT License (MIT) (OSI approved) https://spdx.org/licenses/MIT.html#licenseText
	homepage : https://api-platform.com
	source   : [git] https://github.com/api-platform/core.git d3f5fb8a1e5de4d516c3407b71e592e26efdca05
	dist     : [zip] https://api.github.com/repos/api-platform/core/zipball/d3f5fb8a1e5de4d516c3407b71e592e26efdca05 d3f5fb8a1e5de4d516c3407b71e592e26efdca05
	path     : D:\phpstudy_pro\WWW\jihulab.com\core\sf54\vendor\api-platform\core
	names    : api-platform/core
