## OSG模型的基本操作之添加/删除、显示/隐藏、开关节点开/关
#### 模型的添加/删除
- 模型节点的添加使用osg::Group::addChild函数，函数原型如下：

		virtual bool addChild( Node *child );
		virtual bool removeChild(Node *child);
- 添加示例

		void OsgWidget::on_pushButton_addNode_clicked()
		{
		    // 查找当前视图，添加一个节点
		    QString filePath = QFileDialog::getOpenFileName(0, "打开...", QString(""), "osg(*.osg)");
		    if(!filePath.isEmpty())
		    {
		        osg::ref_ptr<osg::Group> pGroup = _pViewer->getSceneData()->asGroup();
		        pGroup->addChild(osgDB::readNodeFile(filePath.toStdString()));
		    }
		}
- 删除示例

		void OsgWidget::on_pushButton_deleteNode_clicked()
		{
		    // 查找当前视图，删除第一个节点
		    osg::ref_ptr<osg::Group> pGroup = _pViewer->getSceneData()->asGroup();
		    if(pGroup == 0)
		    {
		        return;
		    }
		    if(pGroup->getNumChildren() != 0)
		    {
		        pGroup->removeChild(pGroup->getChild(0));
		    }
		}

#### 模型的显示/隐藏
- 删除模型将会把模型从内存中删除，再次加载需要时间读取文件，OSG提供了隐藏方法，隐藏只是不显示，模型文件仍然在内存中。
- 隐藏示例

		void OsgWidget: :on_pushButton_hideNode_clicked()
		{
			//查找当前视图，隐藏查到到的第一个模型
			osg::ref_ ptr<osg::Group> pGroup = _pViewer->getSceneData()->asGroup();
			if(pGroup == 0)
			{
				return;
			}
			for(int index = 0; index < pGroup->getNumChildren(); index++)
			{
				if(pGroup->getChild(index)->asNode()->getNodeMask() == 0)
				{
					pGroup-> getChild(index)->asNode()->setNodeMask(1);
					break;
				}
			}
		}
- 显示示例

		void OsgWidget: :on_pushButton_hideNode_clicked()
		{
			//查找当前视图，隐藏查到到的第一个模型
			osg::ref_ ptr<osg::Group> pGroup = _pViewer->getSceneData()->asGroup();
			if(pGroup == 0)
			{
				return;
			}
			for(int index = 0; index < pGroup->getNumChildren(); index++)
			{
				if(pGroup->getChild(index)->asNode()->getNodeMask() ！= 0)
				{
					pGroup-> getChild(index)->asNode()->setNodeMask(0);
					break;
				}
			}
		}

#### 模型的开关结点开/关 
- 删除一个节点，节点从内存中清除，隐藏一个节点，节点在内存中模型不显示，此时存在结点开关，这样不显示的时候，会自动将内存从节点中删除，显示的时候，节点的内存会自动加载。
- 添加开关结点

		void OsgWidget::on_pushButton_addSwith_clicked()
		{
		    osg::ref_ptr<osg::Group> pGroup = _pViewer->getSceneData()->asGroup();
		    if(pGroup == 0)
		    {
		        return;
		    }
		    QString filePath = QFileDialog::getOpenFileName(0, "打开...", QString(""), "osg(*.osg)");
		    if(!filePath.isEmpty())
		    {
		        osg::ref_ptr<osg::Node> pNode = osgDB::readNodeFile(filePath.toStdString());
		        osg::ref_ptr<osg::Switch> pSwitch = new osg::Switch();
		        pSwitch->addChild(pNode, true);
		        pGroup->addChild(pSwitch);
		    }
		}
- 开关结点--关

		void OsgWidget::on_pushButton_nodeClose_clicked()
		{
		    // 查找当前视图，关闭查到的第一个模型
		    osg::ref_ptr<osg::Group> pGroup = _pViewer->getSceneData()->asGroup();
		    if(pGroup == 0)
		    {
		        return;
		    }
		    for(int index = 0; index < pGroup->getNumChildren(); index++)
		    {
		        bool doIt = false;
		        osg::ref_ptr<osg::Switch> pSwitch = pGroup->getChild(index)->asSwitch();
		        if(pSwitch)
		        {
		            for(int index2 = 0; index2 < pSwitch->getNumChildren(); index2++)
		            {
		                if(pSwitch->getChildValue(pSwitch->getChild(index2)))
		                {
		                    pSwitch->setChildValue(pSwitch->getChild(index2), false);
		                    doIt = true;
		                    break;
		                }
		            }
		        }
		        if(doIt)
		        {
		            break;
		        }
		    }
		}
- 开关结点--开

		void OsgWidget::on_pushButton_nodeOpen_clicked()
		{
		    // 查找当前视图，打开查到的第一个模型
		    osg::ref_ptr<osg::Group> pGroup = _pViewer->getSceneData()->asGroup();
		    if(pGroup == 0)
		    {
		        return;
		    }
		    for(int index = 0; index < pGroup->getNumChildren(); index++)
		    {
		        bool doIt = false;
		        osg::ref_ptr<osg::Switch> pSwitch = pGroup->getChild(index)->asSwitch();
		        if(pSwitch)
		        {
		            for(int index2 = 0; index2 < pSwitch->getNumChildren(); index2++)
		            {
		                if(!pSwitch->getChildValue(pSwitch->getChild(index2)))
		                {
		                    pSwitch->setChildValue(pSwitch->getChild(index2), true);
		                    doIt = true;
		                    break;
		                }
		            }
		        }
		        if(doIt)
		        {
		            break;
		        }
		    }
		}