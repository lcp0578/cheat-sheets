## phar归档
- phar 扩展提供了一种将整个 PHP 应用程序放入单个叫做“phar”（PHP 归档）文件的方法，以便于分发和安装。 除了提供此服务外，phar 扩展还提供了一种文件格式抽象方法，用于通过 PharData 类创建和操作 tar 和 zip 文件，就像 PDO 提供访问不同数据库的统一接口一样。与不能在不同数据库之间转换的 PDO 不同，phar 还可以使用一行代码在 tar、zip 和 phar 文件格式之间进行转换。
- phar 归档的最佳特征是可以将多个文件组合成一个文件。 因此，phar 归档提供了在单个文件中分发完整的 PHP 应用程序并无需将其解压缩到磁盘而直接运行文件的方法。此外，phar 归档可以像任何其他文件一样由 PHP 在命令行和 Web 服务器上执行。phar 有点像 PHP 应用程序的移动存储器。
- https://www.php.net/manual/zh/intro.phar.php