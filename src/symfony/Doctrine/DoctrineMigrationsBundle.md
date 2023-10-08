## DoctrineMigrationsBundle
- 为什么要用DoctrineMigrationsBundle
	- Database migrations are a way to safely update your database schema both locally and on production. 
	- Instead of running the `doctrine:schema:update` command or applying the database changes manually with SQL statements, migrations allow to replicate the changes in your database schema in a safe manner.
- 官方文档
	- https://symfony.com/bundles/DoctrineMigrationsBundle/current/index.html
	- https://www.doctrine-project.org/projects/doctrine-migrations/en/3.6/index.html
- 安装

		composer require doctrine/doctrine-migrations-bundle "^3.0"

		// config/bundles.php
		// in older Symfony apps, enable the bundle in app/AppKernel.php
		return [
		    // ...
		    Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle::class => ['all' => true],
		];
- 使用

		doctrine
		 doctrine:migrations:current                [current] Outputs the current version.
		 doctrine:migrations:diff                   [diff] Generate a migration by comparing your current database to your mapping information.
		 doctrine:migrations:dump-schema            [dump-schema] Dump the schema for your database to a migration.
		 doctrine:migrations:execute                [execute] Execute a single migration version up or down manually.
		 doctrine:migrations:generate               [generate] Generate a blank migration class.
		 doctrine:migrations:latest                 [latest] Outputs the latest version number
		 doctrine:migrations:migrate                [migrate] Execute a migration to a specified version or the latest available version.
		 doctrine:migrations:rollup                 [rollup] Roll migrations up by deleting all tracked versions and inserting the one version that exists.
		 doctrine:migrations:status                 [status] View the status of a set of migrations.
		 doctrine:migrations:up-to-date             [up-to-date] Tells you if your schema is up-to-date.
		 doctrine:migrations:version                [version] Manually add and delete migration versions from the version table.
		 doctrine:migrations:sync-metadata-storage  [sync-metadata-storage] Ensures that the metadata storage is at the latest version.
		 doctrine:migrations:list                   [list-migrations] Display a list of all available migrations and their status.
