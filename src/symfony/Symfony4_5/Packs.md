## Symfony Packs 集合包
- Sometimes a single feature requires installing several packages and bundles. Instead of installing them individually, Symfony provides **packs**, which are Composer metapackages that include several dependencies.

- For example, to add debugging features in your application, you can run the `composer require --dev debug` command. This installs the `symfony/debug-pack`, which in turn installs several packages like `symfony/debug-bundle`, `symfony/monolog-bundle`, `symfony/var-dumper`, etc.

- You won't see the `symfony/debug-pack` dependency in your `composer.json`, as Flex automatically unpacks the pack. This means that it only adds the real packages as dependencies (e.g. you will see a new `symfony/var-dumper` in `require-dev`). While it is not recommended, you can use the `composer require --no-unpack ...`` option to disable unpacking.