## Babylon.js简介
#### 简介
- babylon.js是一个完整的 JavaScript 框架，可以用于构建 H5、WebGL、WebVR 和 Web Audio 等3D游戏和体验。

#### 几款主流Web3D开发方案的对比
- ＷebGL：很原生，对于前端开发者来说学习成本比较大。
- threeJS：纯渲染引擎，API很多，但文档相对太少，不稳定因素也不小。
- babylonJS：游戏开发引擎，由微软提供完善的开发团队，文档完善且更新及时，支持 JavaScript 和 TypeScript 两种编程语言，相对稳定。

#### babylon.js的其他特点
- 基于WebGL的图形渲染框架，可直接运行在所有支持WebGL的浏览器上。
- API高度封装，可操作性空间小，减少过分自由而产生坑的可能。
- 文档详细，支持TypeScript，适合做大型项目。
- 倾向于基于web的游戏开发，碰撞检测、抗锯齿等游戏特性支持较全面。
- 有做过优化处理的交互事件API。
- Web、IOS、Android上的画面表现高度一致，是一款可以让美术只专注于模型，程序只专注于代码的Web3D引擎。程序员不再需要耗费过多的时间去处理模型在各个平台上的兼容性和画面表现，可以节省大量与美术的沟通时间。
- 开源、免费。

#### Babylon官方工具简介
- Sandbox（美术和程序都可以使用）
	- Sandbox 用于预览模型，可以将3D模型直接拖到 Sandbox 中预览模型的效果，在程序不对模型属性做动态修改的情况下，在 Sandbox 中看到的效果就基本上是项目发布后的实际效果。
	- Sandbox 支持 gltf、glb、obj 和 babylon 等格式的3D文件。
	- Sandbox 地址：https://sandbox.babylonjs.com
- Playground（主要供程序员使用）
	- Playground是制作或测试场景最快捷、最简单的地方，程序员可以在这里以代码方式做出一个场景，觉得满意后再将相关代码用到项目上。使用 Playground 可以在一个“干净”的环境中测试模型效果，同时也是学习和体验 Babylon API 功能的极佳场所。而且也无需搭建和配置项目环境，打开即可直接使用 Babylon 的各种 API 了。
	- Playground 地址：https://www.babylonjs-playground.com
- Editor（主要供美术使用）
	- Editor是 Babylon 的模型编辑器，美术设计师可以将在别的 IDE（如 3DS Max、Maya、Sketchfab）中制作的3D模型导入Editor中继续编辑，当然也可以使用 Editor 从零开始制作模型。
	- Editor 也是一个将别的模型文件转为.babylon模型文件的好工具，如果模型是由别的 IDE 所创作，并想将这些模型用到Babylon引擎中，强烈建议先将这些模型导入Editor，确认模型效果后再通过 Editor 导出模型文件给程序员使用，这样可以大大减少不同模型文件格式在Babylon引擎中的不兼容性。

#### 主要类库
- 核心库　　
	- BabylonJS主程序脚本：https://cdn.babylonjs.com/babylon.js
	- BabylonJS的未压缩版：https://cdn.babylonjs.com/babylon.max.js
- 加载器
	- 模型加载使用这个就可以满足大部分需求了：https://preview.babylonjs.com/loaders/babylonjs.loaders.min.js
	- 更多的模型加载器可以在这里寻找：https://github.com/BabylonJS/Babylon.js/tree/master/dist/loaders
- 其他工具类
　　- Babylon.js 提供：Inspector、Materials、PostProcesses、GUI、Procedural Textures、Serializers 等类库，详见：https://doc.babylonjs.com/babylon101/how_to_get