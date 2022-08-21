## OSG渲染状态与2D纹理映射
#### OSG渲染树
- OSG中存在两棵树，分别为场景树和渲染树，渲染树是一颗以StateSet和RenderLeaf为节点的树，它可以做到StateSet相同的RenderLeaf同时渲染而不用切换OpenGL状态，并且做到尽量少在多个不同的State间切换。

#### Osg::StateSet类
- 渲染时，需要在osg::StateSet中设置渲染状态，可以将StateSet关联到场景图形中的任意一个节点Node或关联到Drawable类。
- OSG将渲染状态分为2个部分，分别为渲染属性(Attribute)和渲染模式(Mode)。
	- 渲染属性：控制渲染特性的状态变量，如雾的颜色。
	- 渲染模式：设置模式量以允许或禁用某个功能，如纹理映射、灯光等。

#### OSG渲染
- 渲染必须的步骤：
	- 为将要设置状态的Node和Drawable对象提供一个StateSet实例。
	- 在StateSet实例中设置状态的渲染模式和渲染属性。
- 设置渲染属性
	- 要设置一项属性，首先需要将修改的属性类实例化，设置该类的数值，然后用osg::StateSet::setAttribute()将其关联到StateSet。

			// 获取StateSet指针
			osg::ptr<osg::StateSet> pStateSet = _pGeometry->getOrCreateStateSet();
			// 创建并添加CullFace属性类
			osg::ptr<osg::CullFace> pCullFace = new osg::CullFace(osg::CullFace::BACK);
			pStateSet->setAttribute(pCullFace.get());
- 设置渲染模式