## 模型的变换之平移、旋转和缩放
#### 变换模型的添加与删除
- 添加变换模型

		void OsgWidget::on_pushButton_addOffsetNode_clicked()
		{
		    QString filePath = QFileDialog::getOpenFileName(0, "打开...", QString(""), "osg(*.osg)");
		    if(!filePath.isEmpty())
		    {
		        osg::ref_ptr<osg::Group> pGroup = _pViewer->getSceneData()->asGroup();
		        if(pGroup == 0)
		        {
		            return;
		        }
		        osg::ref_ptr<osg::Node> pNode = osgDB::readNodeFile(filePath.toStdString());
		        osg::ref_ptr<osg::MatrixTransform> pTrans = new osg::MatrixTransform(osg::Matrix::translate(0,0,0));
		        pTrans->addChild(pNode.get());
		        // 此处添加一个不动变换的模型
		//        pGroup->addChild(pNode.get());
		        // 此处添加一个变换的模型
		        pGroup->addChild(pTrans.get());
		        // 结果：显示2个模型
		    }
		}
- 删除变换模型

		void OsgWidget::on_pushButton_deleteOffsetNode_clicked()
		{
		    osg::ref_ptr<osg::Group> pGroup = _pViewer->getSceneData()->asGroup();
		    if(pGroup == 0)
		    {
		        return;
		    }
		    for(int index = 0; index < pGroup->getNumChildren(); index++)
		    {
		        osg::ref_ptr<osg::Transform> pTransform = pGroup->getChild(index)->asTransform();
		        if(pTransform)
		        {
		            osg::ref_ptr<osg::MatrixTransform> pTrans = pTransform->asMatrixTransform();
		            if(pTrans)
		            {
		                pGroup->removeChild(pTransform);
		                break;
		            }
		        }
		    }
		}

#### 平移
- 加入单个模型的时候，不进行移动的话，默认加入的中心点为场景的中心点。

		void OsgWidget::on_pushButton_decX_clicked()
		{
		    osg::ref_ptr<osg::Group> pGroup = _pViewer->getSceneData()->asGroup();
		    if(pGroup == 0)
		    {
		     return;
		    }
		    for(int index = 0; index < pGroup->getNumChildren(); index++)
		    {
		        LOG_DEBUG("");
		        osg::ref_ptr<osg::Transform> pTransform = pGroup->getChild(index)->asTransform();
		        if(pTransform)
		        {
		            LOG_DEBUG("");
		            osg::ref_ptr<osg::MatrixTransform> pTrans = pTransform->asMatrixTransform();
		            if(pTrans)
		            {
		                osg::Matrix matrix = pTrans->getMatrix();
		                //          _offsetDistance = 0.1       x          y  z
		                matrix *= osg::Matrix::translate(-_offsetDistance, 0, 0);
		                pTrans->setMatrix(matrix);
		                break;
		            }
		        }
		    }
		}
#### 缩放
- 可以用变量保存当前倍数，便于恢复与重置。

		void OsgWidget::on_pushButton_zoomOut_clicked()
		{
		    osg::ref_ptr<osg::Group> pGroup = _pViewer->getSceneData()->asGroup();
		    if(pGroup == 0)
		    {
		        return;
		    }
		    for(int index = 0; index < pGroup->getNumChildren(); index++)
		    {
		        osg::ref_ptr<osg::Transform> pTransform = pGroup->getChild(index)->asTransform();
		        if(pTransform)
		        {
		            osg::ref_ptr<osg::MatrixTransform> pTrans = pTransform->asMatrixTransform();
		            if(pTrans)
		            {
		                osg::Matrix matrix = pTrans->getMatrix();
		                matrix *= osg::Matrix::scale(0.9, 0.9, 0.9);
		                pTrans->setMatrix(matrix);
		                break;
		            }
		        }
		    }
		}

#### 旋转
- 参数是弧度，需要转换以下，后面3个参数是绕哪个轴，只有非0和0的区别。

		void OsgWidget::on_pushButton_rotateX_clicked()
		{
		    osg::ref_ptr<osg::Group> pGroup = _pViewer->getSceneData()->asGroup();
		    if(pGroup == 0)
		    {
		        return;
		    }
		    for(int index = 0; index < pGroup->getNumChildren(); index++)
		    {
		        osg::ref_ptr<osg::Transform> pTransform = pGroup->getChild(index)->asTransform();
		        if(pTransform)
		        {
		            osg::ref_ptr<osg::MatrixTransform> pTrans = pTransform->asMatrixTransform();
		            if(pTrans)
		            {
		                osg::Matrix matrix = pTrans->getMatrix();
		                matrix *= osg::Matrix::rotate(osg::DegreesToRadians(10.0), 1, 0, 0);
		                pTrans->setMatrix(matrix);
		                break;
		            }
		        }
		    }
		}
#### 扩展：OSG中正确的矩阵变换
- OSG中正确的矩阵变换级联顺序应该是：缩放（scale），旋转(rotate)，平移(translate)，简记SRT。其中的原因就是矩阵的变换的结果直接依赖于矩阵变换的顺序，顺序不同变换后的结果也是不同的(一般而言)。