## Filesystem Component
> The Filesystem component provides basic utilities for the filesystem.

- 简单的使用

		/**
         * 
         * @var \Symfony\Component\Filesystem\Filesystem $filesystem
         */
        $filesystem = $this->get('filesystem');
        $uploadsDir = 'uploads/' . date('Ym/d');
        $filesystem->mkdir($uploadsDir);
- appendToFile(New in version 3.3)

		$filesystem->appendToFile('logs.txt', 'append data');