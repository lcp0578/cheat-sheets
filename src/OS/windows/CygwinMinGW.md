## Cygwin 和 MinGW 区别与联系

#### Cygwin
- Cygwin，原 Cygnus 出品（已被红帽收购），目前是 RedHat 名下的项目。
- 项目的目的是提供运行于 Windows 平台的类 Unix 环境（以 GNU 工具为代表），为了达到这个目的，Cygwin 提供了一套抽象层 dll，用于将部分 Posix 调用转换成 Windows 的 API 调用，实现相关功能。这里面最典型的，最基本的模拟层就是那个 cygwin1.dll。除此之外，随着 Linux 系统的发展壮大，目前的 Cygwin 已经不仅仅提供 POSIX 兼容，因此也顺带多了更多模拟层的依赖关系。
- Cygwin 的目录结构基本照搬了 linux 的样子，但同时，也兼容了 Windows 的许多功能：大部分应用使用 Unix 风格的路径，Windows的盘符通过类似挂载点的方式提供给 Cygwin 使用；Cygwin 中既可以运行 Cygwin 的应用（依赖模拟层），又可以运行 Windows 应用，而传递给应用的路径会经过它的模拟层变换，以此保证程序运行不会出错。
- 由于它的模拟层实现了相当良好的 Posix 兼容，人们试着将许多重要的 Linux/BSD 应用移植到了Cygwin下，使得Cygwin越来越大，功能也越来越丰富，以至于目前很多人直接把将Linux应用移植到Windows平台的任务都交给了Cygwin（当然，这种移植并非原生）。事实上，Cygwin诞生之初，本就是想通过GCC编译出Windows应用来，因为bootstrap  GCC而顺带搞了一坨别的东西过来，最后发展到现在的。
- 小结：Cygwin是运行于Windows平台的POSIX“子系统”，提供Windows下的类Unix环境，并提供将部分 Linux 应用“移植”到Windows平台的开发环境的一套软件。

#### MinGW
- MinGW，Minimalist GNU for Windows，用于开发原生（32位） Windows 应用的开发环境。它主要提供了针对 win32 应用的 GCC、GNU binutils 等工具，以及对等于 Windows SDK（的子集）的头文件和用于 MinGW 版本 linker 的库文件（so、a等，而不是 VC 的 lib）。
- MinGW 能够替代 cl 用于编译不包含 MFC 的、以 WinSDK 为主的 Windows 应用，并且编译出来的应用不依赖于第三方的模拟层支持，其运行时为大部分 Windows 标配的 msvcrt（故称原生 Windows 应用）。除此之外，MinGW 也支持 GCC 支持的其他语言。
- 因为这些原因，MinGW 被许多 Linux 上发展起来的开发工具选择为 Windows 版本的默认编译器，例如 CodeBlocks，例如 DevC++。
- 小结，MinGW 是用于进行 Windows 应用开发的 GNU 工具链（开发环境），它的编译产物一般是原生 Windows 应用，虽然它本身不一定非要运行在 Windows 系统下（是的 MinGW 工具链也存在于 Linux、BSD 甚至 Cygwin 下）。

#### 区别与联系
- 区别（小结）：Cygwin是模拟 POSIX 系统，源码移植 Linux 应用到 Windows 下；MinGW 是用于开发 Windows 应用的开发环境。
- 联系：均提供了部分 Linux 下的应用，多跑在 Windows 上；MinGW 作为 Cygwin 下的软件包，可以在 Cygwin  上运行。