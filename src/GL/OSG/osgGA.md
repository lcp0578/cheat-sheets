## osg中漫游器
#### 前言
- 在osg中，编写以下简单代码

		osg::ref_ptr<osgViewer::Viewer> viewer = new osgViewer::Viewer();
		viewer->setSceneData(osgDB::readNodeFile("glider.osg"));
		viewer->run();
- 运行可以看到场景中的滑翔机，并通过鼠标操作它的姿态。你有没有觉得很奇怪，使用opengl代码在渲染函数中写下绘制代码时，得到的场景是静止的，需要事件处理函数才可以控制场景的变化。
- 事实上如此简单的代码，osg替我们作了大量的工作，包括添加了用来操作场景的漫游器。

#### 基本理论
- 首先要理解OpenGL中的模型视图矩阵的概念，在OpenGL中，通过模型视图矩阵，我们将顶点数据从局部坐标系转换到相机坐标系统，OpenGL中模型视图矩阵是一体的，或者说可以理解为一体。
- 但在OSG中它把这两者分离开来，OSG通过场景的树状结构实现模型矩阵（通过场景中的MatrixTransform），把视图矩阵放在漫游器中，通过两者产生模型视图矩阵。
- 关于视图矩阵，有一个重要的结论：**相机在世界坐标系统中的位置姿态矩阵等于相机观察矩阵（视图矩阵）的逆矩阵。**
- 相机的位置姿态矩阵可以理解为相机坐标系统下的顶点向世界坐标系统转换的变化矩阵，而观察矩阵（视图矩阵）则理解为世界坐标系的顶点转换到相机坐标系中的变化矩阵。

#### OSG漫游器是什么
- 漫游器在osgGA库中实现，这个库主要是用来处理用户与三维场景的交互（包括鼠标、键盘、手势、操纵杆等），提供了大量的漫游器展示，文章开头代码中默认添加的轨迹球操作器（TrackballManipulator），这些漫游器都继承自`osgGA::CameraManpualtor`
- `osgGA::CameraManipulator`继承自`osgGA::GUIEventHandler`，我们知道`GUIEventHandler`是用来处理事件的类，从这一点就可以知道漫游器实际上就是一个交互操作修改场景中节点位置和姿态的类，只不过它修改的是最顶层的相机节点，这个节点的修改影响着整个场景。osg的视景器（view）中管理着`GUIEventHanlder`的列表，一般添加的方式是使用：`addEventHandler`这种方式，在添加漫游器的时候如果使用这种方式并没有任何意义，因为用于表达相机观察方位的`getMatrix`和`getInverseMatrix`函数永远不会被视景器View调用到，正确添加漫游器的方法是：

		viewer.setCameraManipulator(new osgGA::TrackballManipulator);

#### 漫游器什么时候被添加
- 在文章开头的示例代码中，我们并没有调用setCameraManipulator的代码，那操作器是怎么被添加的呢？答案就在`viewer->run()`这行代码中，通过查看它的代码得知

		int Viewer::run()
		{
		    if (!getCameraManipulator() && getCamera()->getAllowEventFocus())
		    {
		        setCameraManipulator(new osgGA::TrackballManipulator());
		    }
		 
		    setReleaseContextAtEndOfFrameHint(false);
		 
		    return ViewerBase::run();
		}
- 当我们在调用`run`之前没有设置漫游器，osgViewer::Viewer会为我们默认设置一个轨迹球的漫游器。
- 此外，通过`setCameraManipulator`函数的实现：

		void View::setCameraManipulator(osgGA::CameraManipulator* manipulator, bool resetPosition)
		{
		    _cameraManipulator = manipulator;
		 
		    if (_cameraManipulator.valid())
		    {
		        _cameraManipulator->setCoordinateFrameCallback(new ViewerCoordinateFrameCallback(this));
		 
		        if (getSceneData()) _cameraManipulator->setNode(getSceneData());
		 
		        if (resetPosition)
		        {
		            osg::ref_ptr<osgGA::GUIEventAdapter> dummyEvent = _eventQueue->createEvent();
		            _cameraManipulator->home(*dummyEvent, *this);
		        }
		    }
		}
- 可以看到这个函数同时设置了home位置，也就是说如果我们自己的漫游器想有一个初始的位置，那么可以重新实现home这个虚函数来达到这样的目的。

#### 漫游器是如何起作用的
- 漫游器在添加之后，它必须处理输入事件，并且更新场景，要了解这些内容需要进入到OSG中每一帧绘制的代码中，在osg一帧的绘制中会经历 事件遍历、更新遍历、渲染这三个过程，详细代码可以参看每一帧的代码frame函数：

		void ViewerBase::frame(double simulationTime)
		{
		    if (_done) return;
		 
		    // OSG_NOTICE<<std::endl<<"CompositeViewer::frame()"<<std::endl<<std::endl;
		 
		    if (_firstFrame)
		    {
		        viewerInit();
		 
		        if (!isRealized())
		        {
		            realize();
		        }
		 
		        _firstFrame = false;
		    }
		    advance(simulationTime);
		 
		    eventTraversal();
		    updateTraversal();
		    renderingTraversals();
		}
- 很显然漫游器的对事件的处理应该是在eventTraversal函数中，漫游器更新的代码应该在updateTraversal中，事实上确实如此：在evnetTraversal处理完场景中事件EventHandler和所有节点的事件回调之后，在函数的最后调用漫游器的事件处理函数：

	    for(osgGA::EventQueue::Events::iterator itr = events.begin();
	        itr != events.end();
	        ++itr)
	    {
	        osgGA::Event* event = itr->get();
	        if (event && _cameraManipulator.valid())
	        {
	            _cameraManipulator->handle( event, 0, _eventVisitor.get());
	        }
	    }
- 同样在更新完场景中节点的更新回调与遍历之后，在函数的最后处理漫游器的更新：
   
	    if (_cameraManipulator.valid())
	    {
	        setFusionDistance( getCameraManipulator()->getFusionDistanceMode(),
	                            getCameraManipulator()->getFusionDistanceValue() );
	 
	        _cameraManipulator->updateCamera(*_camera);
	    }
- updateCamera函数的调用如下（默认实现方式 ）

		virtual void updateCamera(osg::Camera& camera) { camera.setViewMatrix(getInverseMatrix()); }
- 直接调用相机的观察矩阵，矩阵从漫游器的getInverseMatrix函数中获取，这是我们编写自己漫游器的关键函数，这个函数在所有漫游器基类CameraManipulator中是一个纯虚函数，需要我们实现，它被调用的位置就是在此处。

#### 如何实现自己的漫游器
- 实现自己的漫游器有多种方式：可以直接从基类`osgGA::CameraManipulator`开始写，也可以从它的子类如`StandardManipulator`、`DriveManipulato`r等中继承去写。下面提供一个简单的漫游器示例，这个漫游器实现了当用户使用鼠标滚轮滚动时，视点沿着鼠标位置进行zoom in和zoom out，代码如下：

		#include <osgGA/CameraManipulator>
		 
		//定义操作器
		class ZoomManipulator : public osgGA::CameraManipulator
		{
		public:
			//构造函数传入节点计算包围盒
			ZoomManipulator(osg::Node *node);
			~ZoomManipulator();
		 
			//所有漫游器都必须实现的4个纯虚函数
			virtual void setByMatrix(const osg::Matrixd& matrix){}
			virtual void setByInverseMatrix(const osg::Matrixd& matrix){}
			virtual osg::Matrixd getMatrix() const{return osg::Matrix();}
			virtual osg::Matrixd getInverseMatrix() const;
		 
			//获取传入节点，用于使用CameraManipulator中的computeHomePosition
			virtual const osg::Node* getNode() const { return _root; }
			virtual osg::Node* getNode() { return _root;  }
		 
			virtual bool handle(const osgGA::GUIEventAdapter& ea,osgGA::GUIActionAdapter& us);
		 
			osg::Vec3	_eye;				//视点位置
			osg::Vec3   _direction;         //视点方向
			osg::Vec3	_up;                //向上方向
			osg::Node*	_root;
		};
- 在实现代码中通过计算鼠标点处的世界坐标，使视点沿着与鼠标点世界坐标的连线移动

#include <osgViewer/Viewer>
 
ZoomManipulator::ZoomManipulator(osg::Node *node)
{
	_root = node;
	computeHomePosition();
 
	_eye = _homeEye;
	_direction = _homeCenter - _homeEye;
	_up = _homeUp;
}
 
ZoomManipulator::~ZoomManipulator()
{
 
}
 
osg::Matrixd ZoomManipulator::getInverseMatrix() const
{
	osg::Matrix mat;
	mat.makeLookAt(_eye, _eye + _direction, _up);
 
	return mat;
}
 
 
bool ZoomManipulator::handle(const osgGA::GUIEventAdapter& ea,osgGA::GUIActionAdapter& us)
{
	switch(ea.getEventType())
	{
 
	case (osgGA::GUIEventAdapter::SCROLL):
		{
			osgViewer::Viewer *viewer = dynamic_cast<osgViewer::Viewer*>(&us);
			osg::Camera *camera = viewer->getCamera();
			osg::Matrix MVPW = camera->getViewMatrix() * camera->getProjectionMatrix() * camera->getViewport()->computeWindowMatrix();
 
			osg::Matrix inverseMVPW = osg::Matrix::inverse(MVPW);
			osg::Vec3 mouseWorld = osg::Vec3(ea.getX(), ea.getY(), 0) * inverseMVPW;
 
			osg::Vec3 direction = mouseWorld - _eye;
			direction.normalize();			
 
			if (ea.getScrollingMotion() == osgGA::GUIEventAdapter::SCROLL_UP)
			{
				_eye += direction * 20.0;
			}
			else if (ea.getScrollingMotion() == osgGA::GUIEventAdapter::SCROLL_DOWN)
			{
				_eye -= direction * 20.0;
			}
		}
		
	default:
		return false;
	}
}
