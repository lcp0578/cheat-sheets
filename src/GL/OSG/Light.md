## OSG光照
- OSG全面支持OpenGL的光照特性，包括材质属性、光照属性和光照模型。与OpenGL相似，OSG中的光源也是不可见的，而非渲染一个灯泡或者其他自然形状。同样，光源会创建着色效果，但并不创建阴影，额外的阴影可以使用`osgShadow`可以用来创建。
- 光照：osg::Light
- 光源：osg::LightSource
- 光照实现方式与步骤
	- 打开光照，设置光照序号（与打开光照序号的灯光功能对应）
	- 创建光照（理解为光点，光从该点射出），设置光照属性（光的位置，光的方向，光的颜色，常量衰减指数，线性衰减，二次衰减指数，可关闭衰减）
	- 以光照创建光源，将光源添加进父结点中

			osg::ref_ptr<osg::Node> OsgWidget::getEarthSphiereLight()
			{
			    // 该结点是为了开关
			    osg::ref_ptr<osg::Switch> pSwitch = new osg::Switch;
			    // 该结点是为了变换
			    osg::ref_ptr<osg::MatrixTransform> pTrans = new osg::MatrixTransform;
			    // 该结点是为了灯光
			    osg::ref_ptr<osg::LightSource> pLightSource = new osg::LightSource;
			#if 1
			    {
			        // 绘制球体
			        // 步骤一：绘制几何类型(几何体)
			        osg::ref_ptr<osg::Geode> pGeode = new osg::Geode;
			        qreal radius = 1.0;
			        pGeode->addDrawable(new osg::ShapeDrawable(new osg::Sphere(osg::Vec3(0, 0, 0), radius)));
			        // 步骤二：加载图片添加纹理
			        osg::ref_ptr<osg::Image> pImage;
			        pImage = osgDB::readImageFile("D:/qtProject/osgDemo/osgDemo/modules/osgWidget/image/earth.bmp");
			        osg::ref_ptr<osg::Texture2D> pTexture2D = new osg::Texture2D;
			        pTexture2D->setImage(pImage.get());
			        // 步骤三：渲染设置
			        osg::ref_ptr<osg::StateSet> pStateSet = pGeode->getOrCreateStateSet();
			        pStateSet->setTextureAttribute(0, pTexture2D.get());
			        pStateSet->setTextureMode(0, GL_TEXTURE_2D, osg::StateAttribute::ON);
			        pTrans->addChild(pGeode);
			 
			        // 步骤四：打开光照（开关节点得光照）
			        pStateSet = pSwitch->getOrCreateStateSet();
			        pStateSet->setMode(GL_LIGHTING, osg::StateAttribute::ON);
			        pStateSet->setMode(GL_LIGHT0, osg::StateAttribute::ON);
			        // 步骤五：创建光照对象
			        osg::ref_ptr<osg::Light> pLight = new osg::Light();
			        // 设置光照对应的光照点，对应GL_LIGHT0
			        pLight->setLightNum(0);
			        // 设置光照方向
			        pLight->setDirection(osg::Vec3(0.0, 1.0, 0.0));
			        // 设置光照位置，最后一个参数0-平行光，1-点光源
			        pLight->setPosition(osg::Vec4(0.0, -2.0, 0.0, 0.0));
			        // 设置散射光颜色: 红光/白光
			        pLight->setDiffuse(osg::Vec4(1.0, 1.0, 1.0, 1.0));
			        // 设置常量衰减指数
			        pLight->setConstantAttenuation(1.0);
			        // 设置线行衰减指数
			        pLight->setLinearAttenuation(0.0);
			        // 设置二次衰减指数
			        pLight->setQuadraticAttenuation(0.0);
			        // 创建光源
			        pLightSource->setLight(pLight.get());
			        // 步骤六：添加事件管理器
			//        _pViewer->addEventHandler(new MyUserEventHandler);
			    }
			#endif
			    pSwitch->addChild(pTrans.get());
			    // 添加光源(光源与球体平级结点，球体变换，光源不变换）
			    pSwitch->addChild(pLightSource.get());
			    return pSwitch.get();
			} 