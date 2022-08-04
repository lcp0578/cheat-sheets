## three.js
#### WebGL 与 three.js
- WebGL（Web Graphics Library）是一种3D绘图协议，它允许把JavaScript和OpenGL ES 2.0结合在一起，通过增加OpenGL ES 2.0的一个JavaScript绑定，WebGL可以为HTML5 Canvas提供硬件3D加速渲染，这样Web开发人员就可以借助系统显卡来在浏览器里更流畅地展示3D场景和模型。
- 但使用WebGL原生的API来写3D程序非常复杂，需要相对较多的数学知识，对于前端开发者来说学习成本较高。而Three.js对WebGL提供的接口进行了非常好的封装，简化了很多细节，大大降低了学习成本，成为前端开发者完成3D绘图的得力工具。
#### three.js
- three.js中的三大要素：场景（scene）、相机（camera）、渲染器（renderer），有了这三样东西，我们才能够使用相机将场景渲染到网页上去。
	- 场景
		- 场景是所有物体的容器，场景只有一种。
		- 创建场景：要构件一个场景很简单，只需要new一个场景对象出来即可：var scene = new THREE.Scene()
	- 相机
		- 相机是成像的工具，相机有很多种类，不同种类的相机即使从一个角度拍摄，所成像出来的结果也不相同。相机决定了场景中哪个角度的景色会显示出来。
		- 说到相机，就涉及到坐标系的概念。webGL和three.js使用的是右手坐标系
		- 在Three.js中有两种常用的相机：透视相机（perspectiveCamera）和正交投影相机（OrthographicCamera ）
	- 渲染器
		- 渲染器的作用就是将相机拍摄出的画面在浏览器中呈现出来。渲染器决定了渲染的结果应该画在页面的什么元素上面，并且以怎样的方式来绘制。
		- three.js中有很多种类的渲染器，例如webGLRenderer、canvasRenderer、SVGRenderer，通常使用的是webGL渲染器。
		- 创建webGL渲染器：var renderer = new THERR.WebGLRenderer();
		- 创建完渲染器后，需要调用render方法将之前创建好的场景和相机相结合从而渲染出来，即调用渲染器的render方法：renderer.render(scene,camera)