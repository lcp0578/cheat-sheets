## svg(Scalable Vector Graphics)
svg 教程 [http://www.w3school.com.cn/svg](http://www.w3school.com.cn/svg)
### 什么是SVG？
- SVG 指可伸缩矢量图形 (Scalable Vector Graphics)
- SVG 用来定义用于网络的基于矢量的图形
- SVG 使用 XML 格式定义图形
- SVG 图像在放大或改变尺寸的情况下其图形质量不会有所损失
- SVG 是万维网联盟的标准
- SVG 与诸如 DOM 和 XSL 之类的 W3C 标准是一个整体

示例:

	<?xml version="1.0" standalone="no"?>
	
	<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" 
	"http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
	
	<svg width="100%" height="100%" version="1.1"
	xmlns="http://www.w3.org/2000/svg">
	
	<circle cx="100" cy="50" r="40" stroke="black"
	stroke-width="2" fill="red"/>
	
	</svg>
代码解释:

第一行包含了 XML 声明。请注意 standalone 属性！该属性规定此 SVG 文件是否是“独立的”，或含有对外部文件的引用。
standalone="no" 意味着 SVG 文档会引用一个外部文件 - 在这里，是 DTD 文件。  
第二和第三行引用了这个外部的 SVG DTD。该 DTD 位于 “http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd”。该 DTD 位于 W3C，含有所有允许的 SVG 元素。  
SVG 代码以 <svg> 元素开始，包括开启标签 <svg> 和关闭标签 </svg> 。这是根元素。width 和 height 属性可设置此 SVG 文档的宽度和高度。version 属性可定义所使用的 SVG 版本，xmlns 属性可定义 SVG 命名空间。
SVG 的 <circle> 用来创建一个圆。cx 和 cy 属性定义圆中心的 x 和 y 坐标。如果忽略这两个属性，那么圆点会被设置为 (0, 0)。r 属性定义圆的半径。  
stroke 和 stroke-width 属性控制如何显示形状的轮廓。我们把圆的轮廓设置为 2px 宽，黑边框。  
fill 属性设置形状内的颜色。我们把填充颜色设置为红色。  
关闭标签的作用是关闭 SVG 元素和文档本身。  
注释：所有的开启标签必须有关闭标签！   

### SVG in HTML 
SVG 文件可通过以下标签嵌入 HTML 文档：`<embed>`、`<object>` 或者 `<iframe> `


	<embed src="rect.svg" width="300" height="100" 
	type="image/svg+xml"
	pluginspage="http://www.adobe.com/svg/viewer/install/" />
	
	<object data="rect.svg" width="300" height="100" 
	type="image/svg+xml"
	codebase="http://www.adobe.com/svg/viewer/install/" />
	
	<iframe src="rect.svg" width="300" height="100">
	</iframe>