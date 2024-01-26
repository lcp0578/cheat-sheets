## symfony recipes
#### 简介
- https://github.com/symfony/recipes
- Symfony recipes allow the automation of Composer packages configuration via the Symfony Flex Composer plugin.
- This repository contains "official" recipes for Composer packages endorsed by the Symfony Core Team. 
#### `composer recipes` 命令
 
	 #composer recipes
	
	 Available recipes.
	
	 * doctrine/annotations
	 * doctrine/doctrine-bundle (update available)
	 * doctrine/doctrine-migrations-bundle
	 * jsor/doctrine-postgis
	 * phpunit/phpunit
	 * sensio/framework-extra-bundle
	 * symfony/console
	 * symfony/debug-bundle (update available)
	 * symfony/flex
	 * symfony/framework-bundle (update available)
	 * symfony/mailer (update available)
	 * symfony/maker-bundle
	 * symfony/monolog-bundle (update available)
	 * symfony/notifier
	 * symfony/phpunit-bridge
	 * symfony/routing (update available)
	 * symfony/security-bundle (update available)
	 * symfony/translation
	 * symfony/twig-bundle (update available)
	 * symfony/validator (update available)
	 * symfony/web-profiler-bundle (update available)
	 * twig/extra-bundle
	
	Run:
	 * composer recipes vendor/package to see details about a recipe.
	 * composer recipes:update vendor/package to update that recipe.
- to see details about a recipe

		 composer recipes vendor/package
- to update that recipe

		composer recipes:update vendor/package 
- Update the recipe by re-installing the latest version with:

		composer recipes:install symfony/flex --force -v