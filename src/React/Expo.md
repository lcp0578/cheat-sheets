## Expo - 基于React Native的一款上层框架
- https://expo.dev/
- Expo is a framework that makes developing Android and iOS apps easier. Our framework provides file-based routing, a standard library of native modules, and much more. 
- 总结
	- 基于React Native的一款上层框架
	- 同时支持Android、iOS 和 Web的跨端开发
	- 提供了Expo CLI脚手架、Expo Go沙箱、EAS 构建、EAS 提交、EAS 更新、Expo Router、Expo module API 等一系列扩展功能
	- 通过Expo，避免了直接对原生开发，原生代码都由Expo构建产出。（但也支持自定义原生内容）
	- Expo SDK 接续了 React Native 核心库的结尾。它提供对许多设备和系统功能的访问，例如音频、条形码扫描、相机、日历、联系人、视频等。它还添加了其他强大的库，如更新、地图、OAuth 身份验证工具等。目前很多主流库都支持Expo，不支持的库也提供了接入方式。
- `expo` 封装占地面积小；它只包含几乎每个应用所需的最小包集以及其他 Expo SDK 包构建所需要的模块和自动链接基础设施。在项目中安装并配置 `expo` 包后，你可以使用 `npx expo install` 从 SDK 添加任何其他 Expo 模块。
