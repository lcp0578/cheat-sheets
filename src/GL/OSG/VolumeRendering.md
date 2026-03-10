## OSG三维纹理映射(体渲染)

	osg::ref_ptr<osg::Node> OsgWidget::getEarthSphiere()
	{
	    osg::ref_ptr<osg::Group> pGroop = new osg::Group;
	#if 1
	    {
	        // 绘制球体
	        // 步骤一：绘制几何类型(几何体)
	        osg::ref_ptr<osg::Geode> pGeode = new osg::Geode;
	        qreal radius = 1.0;
	        pGeode->addDrawable(new osg::ShapeDrawable(new osg::Sphere(osg::Vec3(0, 0, 0), radius)));
	#if 1
	        // 步骤二：加载图片添加纹理
	        osg::ref_ptr<osg::Image> pImage;
	        pImage = osgDB::readImageFile("D:/qtProject/osgDemo/osgDemo/modules/osgWidget/image/earth.bmp");
	        if(!pImage->valid())
	        {
	            LOG_WARN(QString("Failed to load image: %1").arg(QString::fromStdString(pImage->getFileName())));
	        }
	//        qDebug() << __FILE__ << __LINE__ << osgDB::writeImageFile(*pImage.get(), "1.bmp");
	        osg::ref_ptr<osg::Texture2D> pTexture2D = new osg::Texture2D;
	//        pTexture2D->setDataVariance(osg::Object::DYNAMIC);
	        pTexture2D->setImage(pImage.get());
	        // 步骤三：渲染设置
	        osg::ref_ptr<osg::StateSet> pStateSet = pGeode->getOrCreateStateSet();
	        pStateSet->setTextureAttribute(0, pTexture2D.get());
	        pStateSet->setTextureMode(0, GL_TEXTURE_2D, osg::StateAttribute::ON);
	        pGeode->setStateSet(pStateSet);
	#endif
	        pGroop->addChild(pGeode);
	    }
	#endif
	    return pGroop.get();
	}

- 球体渲染的时候有黑色的缝隙
	-  首先要排除图片纹理本身边框的问题，然后修改渲染的边界处理方式和插值方式：

			// 步骤二：创建纹理
			    osg::ref_ptr<osg::Texture2D> pTexture2D = new osg::Texture2D;
			    pTexture2D->setImage(pImage);
			    pTexture2D->setUnRefImageDataAfterApply(true);
			//    pTexture2D->setWrap(osg::Texture2D::WRAP_S, osg::Texture2D::CLAMP);
			    pTexture2D->setWrap(osg::Texture2D::WRAP_S, osg::Texture2D::CLAMP_TO_EDGE);
			//    pTexture2D->setWrap(osg::Texture2D::WRAP_S, osg::Texture2D::CLAMP_TO_BORDER);
			//    pTexture2D->setWrap(osg::Texture2D::WRAP_S, osg::Texture2D::REPEAT);
			//    pTexture2D->setWrap(osg::Texture2D::WRAP_S, osg::Texture2D::MIRROR);
			 
			//    pTexture2D->setWrap(osg::Texture2D::WRAP_T, osg::Texture2D::CLAMP);
			    pTexture2D->setWrap(osg::Texture2D::WRAP_T, osg::Texture2D::CLAMP_TO_EDGE);
			//    pTexture2D->setWrap(osg::Texture2D::WRAP_T, osg::Texture2D::CLAMP_TO_BORDER);
			//    pTexture2D->setWrap(osg::Texture2D::WRAP_T, osg::Texture2D::REPEAT);
			//    pTexture2D->setWrap(osg::Texture2D::WRAP_T, osg::Texture2D::MIRROR);
			 
			//    pTexture2D->setWrap(osg::Texture2D::WRAP_R, osg::Texture2D::CLAMP);
			    pTexture2D->setWrap(osg::Texture2D::WRAP_R, osg::Texture2D::CLAMP_TO_EDGE);
			//    pTexture2D->setWrap(osg::Texture2D::WRAP_R, osg::Texture2D::CLAMP_TO_BORDER);
			//    pTexture2D->setWrap(osg::Texture2D::WRAP_R, osg::Texture2D::REPEAT);
			//    pTexture2D->setWrap(osg::Texture2D::WRAP_R, osg::Texture2D::MIRROR);
			 
			 
			//    pTexture2D->setFilter(osg::Texture2D::MIN_FILTER, osg::Texture2D::LINEAR);
			//    pTexture2D->setFilter(osg::Texture2D::MIN_FILTER, osg::Texture2D::LINEAR_MIPMAP_LINEAR);
			//    pTexture2D->setFilter(osg::Texture2D::MIN_FILTER, osg::Texture2D::LINEAR_M/IPMAP_NEAREST);
			//    pTexture2D->setFilter(osg::Texture2D::MIN_FILTER, osg::Texture2D::NEAREST);
			//    pTexture2D->setFilter(osg::Texture2D::MIN_FILTER, osg::Texture2D::NEAREST_MIPMAP_LINEAR);
			    pTexture2D->setFilter(osg::Texture2D::MIN_FILTER, osg::Texture2D::NEAREST_MIPMAP_NEAREST);
			//    pTexture2D->setFilter(osg::Texture2D::MAG_FILTER, osg::Texture2D::LINEAR);
			//    pTexture2D->setFilter(osg::Texture2D::MAG_FILTER, osg::Texture2D::LINEAR_MIPMAP_LINEAR);
			//    pTexture2D->setFilter(osg::Texture2D::MAG_FILTER, osg::Texture2D::LINEAR_MIPMAP_NEAREST);
			//    pTexture2D->setFilter(osg::Texture2D::MAG_FILTER, osg::Texture2D::NEAREST);
			//    pTexture2D->setFilter(osg::Texture2D::MAG_FILTER, osg::Texture2D::NEAREST_MIPMAP_LINEAR);
			    pTexture2D->setFilter(osg::Texture2D::MAG_FILTER, osg::Texture2D::NEAREST_MIPMAP_NEAREST);