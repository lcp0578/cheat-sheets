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
- 查看当前状态

		php bin\console doctrine:migrations:status
		+----------------------+----------------------+------------------------------------------------------------------------+
		| Configuration                                                                                                        |
		+----------------------+----------------------+------------------------------------------------------------------------+
		| Storage              | Type                 | Doctrine\Migrations\Metadata\Storage\TableMetadataStorageConfiguration |
		|                      | Table Name           | doctrine_migration_versions                                            |
		|                      | Column Name          | version                                                                |
		|----------------------------------------------------------------------------------------------------------------------|
		| Database             | Driver               | Symfony\Bridge\Doctrine\Middleware\Debug\Driver                        |
		|                      | Name                 | sf54_kdb                                                               |
		|----------------------------------------------------------------------------------------------------------------------|
		| Versions             | Previous             | 0                                                                      |
		|                      | Current              | 0                                                                      |
		|                      | Next                 | Already at latest version                                              |
		|                      | Latest               | 0                                                                      |
		|----------------------------------------------------------------------------------------------------------------------|
		| Migrations           | Executed             | 0                                                                      |
		|                      | Executed Unavailable | 0                                                                      |
		|                      | Available            | 0                                                                      |
		|                      | New                  | 0                                                                      |
		|----------------------------------------------------------------------------------------------------------------------|
		| Migration Namespaces | DoctrineMigrations   | D:\phpstudy_pro\WWW\jihulab.com\core\sf54/migrations                   |
		+----------------------+----------------------+------------------------------------------------------------------------+

- 创建迁移

		php bin\console doctrine:migrations:diff  或者 php bin\console make:migration
		
		 Generated new migration class to "D:\phpstudy_pro\WWW\jihulab.com\core\sf54/migrations/Version20231008073018.php"
		 
		 To run just this migration for testing purposes, you can use migrations:execute --up 'DoctrineMigrations\\Version20231008073018'
		 
		 To revert the migration you can use migrations:execute --down 'DoctrineMigrations\\Version20231008073018'
- 执行迁移

		php bin\console doctrine:migrations:migrate
		
		 WARNING! You are about to execute a migration in database "sf54_kdb" that could result in schema changes and data loss. Are you sure you wish to continue? (yes/no) [yes]:
		 > yes
		
		[notice] Migrating up to DoctrineMigrations\Version20231008074553
		[notice] finished in 68.7ms, used 26M memory, 1 migrations executed, 252 sql queries
		
		 [OK] Successfully migrated to version : DoctrineMigrations\Version20231008074553
- 再次查看状态

		php bin\console doctrine:migrations:status 
		+----------------------+----------------------+------------------------------------------------------------------------+
		| Configuration                                                                                                        |
		+----------------------+----------------------+------------------------------------------------------------------------+
		| Storage              | Type                 | Doctrine\Migrations\Metadata\Storage\TableMetadataStorageConfiguration |
		|                      | Table Name           | doctrine_migration_versions                                            |
		|                      | Column Name          | version                                                                |
		|----------------------------------------------------------------------------------------------------------------------|
		| Database             | Driver               | Symfony\Bridge\Doctrine\Middleware\Debug\Driver                        |
		|                      | Name                 | sf54_kdb                                                               |
		|----------------------------------------------------------------------------------------------------------------------|
		| Versions             | Previous             | 0                                                                      |
		|                      | Current              | DoctrineMigrations\Version20231008074553                               |
		|                      | Next                 | Already at latest version                                              |
		|                      | Latest               | DoctrineMigrations\Version20231008074553                               |
		|----------------------------------------------------------------------------------------------------------------------|
		| Migrations           | Executed             | 1                                                                      |
		|                      | Executed Unavailable | 0                                                                      |
		|                      | Available            | 1                                                                      |
		|                      | New                  | 0                                                                      |
		|----------------------------------------------------------------------------------------------------------------------|
		| Migration Namespaces | DoctrineMigrations   | D:\phpstudy_pro\WWW\jihulab.com\core\sf54/migrations                   |
		+----------------------+----------------------+------------------------------------------------------------------------+
- 配置表过滤`config/packages/doctrine.yaml`

		doctrine:
		    dbal:
		        default_connection: default
		        connections:
		            # 默认数据库
		            default:
		                url: '%env(resolve:DATABASE_KINGBASE_URL)%'
		                schema_filter: ~^(?!sysmac)~ # 过滤sysmac开头的表，不进行迁移