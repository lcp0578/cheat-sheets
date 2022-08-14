## OSG复现OpenGL入门示例
#### 法线的意义
- 所谓的法线是指：物品在光的照射下肉眼能看到的物体的面，而物体里面是看不到的。也就说，计算光照是运算需要法线。未设置法线那么一般情况是看不到物体的，处于一片漆黑状态。
#### OSG示例关键代码

	void OsgWidget::testOpenGLDemo()
	{
	    osg::ref_ptr<osg::Group> pGroop = new osg::Group;
	#if 1
	    {
	        // 绘制三角形
	        // 创建一个用户保存几何信息的对象
	        osg::ref_ptr<osg::Geometry> pGeometry = new osg::Geometry;
	        // 创建四个顶点的数组
	        osg::ref_ptr<osg::Vec3Array> pVec3Array = new osg::Vec3Array;
	        // 添加四个顶点
	        pGeometry->setVertexArray(pVec3Array.get());
	        //        OSG的坐标系：X正方向向右，Y正方向朝上，Z正方向朝里
	        //                     OpenGL中  x     y     z
	        //        OSG的坐标系：X正方向向右，Y正方向朝里，Z正方向朝上
	        //                     Osg中     x     y     z
	        pVec3Array->push_back(osg::Vec3(-3.0, 0.0, 0.0));
	        pVec3Array->push_back(osg::Vec3(-1.0, 0.0, 0.0));
	        pVec3Array->push_back(osg::Vec3(-2.0, 0.0, 3.0));
	        // 创建四种颜色的数据
	        osg::ref_ptr<osg::Vec4Array> pVec4Array = new osg::Vec4Array;
	        // 添加四种颜色
	        pGeometry->setColorArray(pVec4Array.get());
	        // 绑定颜色
	        pGeometry->setColorBinding(osg::Geometry::BIND_PER_VERTEX);
	        //                               r    g    b    a(a设置无效，估计需要其他属性配合)
	        pVec4Array->push_back(osg::Vec4(0.0, 1.0, 0.0, 1.0));
	        pVec4Array->push_back(osg::Vec4(0.0, 0.0, 1.0, 1.0));
	        pVec4Array->push_back(osg::Vec4(1.0, 0.0, 0.0, 1.0));
	        // 为唯一的法线创建一个数组    法线: normal
	        osg::ref_ptr<osg::Vec3Array> pVec3ArrayNormal = new osg::Vec3Array;
	        pGeometry->setNormalArray(pVec3ArrayNormal.get());
	        pGeometry->setNormalBinding(osg::Geometry::BIND_OVERALL);
	        pVec3ArrayNormal->push_back(osg::Vec3(0.0, -1.0, 0.0));
	        // 由保存的数据绘制四个顶点的多边形
	        pGeometry->addPrimitiveSet(new osg::DrawArrays(osg::PrimitiveSet::TRIANGLES, 0, 3));
	        // 向Geode类添加几何体(Drawable)
	        osg::ref_ptr<osg::Geode> pGeode = new osg::Geode;
	        pGeode->addDrawable(pGeometry.get());
	        pGroop->addChild(pGeode);
	    }
	#endif
	#if 1
	    {
	        // 绘制四边形
	        // 创建一个用户保存几何信息的对象
	        osg::ref_ptr<osg::Geometry> pGeometry = new osg::Geometry;
	        // 创建四个顶点的数组
	        osg::ref_ptr<osg::Vec3Array> pVec3Array = new osg::Vec3Array;
	        // 添加四个顶点
	        pGeometry->setVertexArray(pVec3Array.get());
	        //
	        //                               x     z     y
	        pVec3Array->push_back(osg::Vec3( 1.0, 0.0, 0.0));
	        pVec3Array->push_back(osg::Vec3( 3.0, 0.0, 0.0));
	        pVec3Array->push_back(osg::Vec3( 3.0, 0.0, 3.0));
	        pVec3Array->push_back(osg::Vec3( 1.0, 0.0, 3.0));
	        // 注意：此处若不绑定画笔，则表示使用之前绑定的画笔
	        // 创建四种颜色的数据
	//        osg::ref_ptr<osg::Vec4Array> pVec4Array = new osg::Vec4Array;
	        // 添加四种颜色
	//        pGeometry->setColorArray(pVec4Array.get());
	        // 绑定颜色
	//        pGeometry->setColorBinding(osg::Geometry::BIND_PER_VERTEX);
	//        pVec4Array->push_back(osg::Vec4(1.0, 0.0, 0.0, 1.0));
	//        pVec4Array->push_back(osg::Vec4(0.0, 1.0, 0.0, 1.0));
	//        pVec4Array->push_back(osg::Vec4(0.0, 0.0, 1.0, 1.0));
	//        pVec4Array->push_back(osg::Vec4(1.0, 1.0, 1.0, 1.0));
	        // 为唯一的法线创建一个数组    法线: normal
	        osg::ref_ptr<osg::Vec3Array> pVec3ArrayNormal = new osg::Vec3Array;
	        pGeometry->setNormalArray(pVec3ArrayNormal.get());
	        pGeometry->setNormalBinding(osg::Geometry::BIND_OVERALL);
	        pVec3ArrayNormal->push_back(osg::Vec3(0.0, -1.0, 0.0));
	        // 由保存的数据绘制四个顶点的多边形
	        pGeometry->addPrimitiveSet(new osg::DrawArrays(osg::PrimitiveSet::QUADS, 0, 4));
	        // 向Geode类添加几何体(Drawable)
	        osg::ref_ptr<osg::Geode> pGeode = new osg::Geode;
	        pGeode->addDrawable(pGeometry.get());
	        pGroop->addChild(pGeode);
	    }
	#endif
	_pViewer->setSceneData(pGroop);
	}