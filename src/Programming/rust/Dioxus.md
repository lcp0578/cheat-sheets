## Dioxus 构建跨平台应用的 Rust UI 框架
- https://github.com/DioxusLabs/dioxus
- Dioxus 是一个用于构建跨平台用户界面的高性能、可移植且符合人体工程学的 Rust 框架。它的核心思想是提供一种类似 React 的开发体验（使用类似 JSX 的 RSX 语法、组件化、Hooks API、虚拟 DOM 等），但利用 Rust 的优势（性能、内存安全、类型安全）来构建可在多个平台上运行的应用程序。

- 核心哲学与灵感：
	- React 范式： Dioxus 深受 React 启发，采用了其声明式 UI、组件化、单向数据流和虚拟 DOM 的概念。这使得熟悉 React/JSX 的开发者能更快地上手。
	- Rust 优先： 所有逻辑、组件和状态管理都用 Rust 编写，充分利用 Rust 的性能、安全性和强大的类型系统。
	- 真正的可移植性： 编写一次核心 UI 逻辑，就能部署到多个平台（Web, Desktop, Mobile, TUI, 甚至服务端渲染）。
	- 性能： 利用 Rust 的零成本抽象和高效的虚拟 DOM Diffing 算法（Fermi 引擎），Dioxus 旨在提供接近原生或优于传统 JS 框架的性能。
	- 开发者体验： 提供强大的工具链（CLI、热重载、浏览器扩展）、清晰的错误信息和符合直觉的 API。