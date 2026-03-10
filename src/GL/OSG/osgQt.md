## 使用osgQt嵌入Qt应用程序
- OsgWidget.h

		#ifndef OSGWIDGET_H
		#define OSGWIDGET_H
		 
		#include <QWidget>
		#include <osgViewer/Viewer>
		#include <osgQt/GraphicsWindowQt>
		 
		namespace Ui {
		class OsgWidget;
		}
		 
		class OsgWidget : public QWidget
		{
		    Q_OBJECT
		 
		public:
		    explicit OsgWidget(QWidget *parent = 0);
		 
		protected:
		    void resizeEvent(QResizeEvent *event);
		 
		protected:
		    void initOsg();
		    void loadOsg(QString osgFilePath);
		 
		private slots:
		    void on_pushButton_open_clicked();
		 
		private:
		    Ui::OsgWidget *ui;
		 
		private:
		    osg::ref_ptr<osgViewer::Viewer> _pViewer;
		    osg::ref_ptr<osg::Viewport> _pViewport;
		    osgQt::GLWidget * _pGLWidget;
		    osgQt::GraphicsWindowQt* _pGraphicsWindowQt;
		};
		 
		#endif // OSGWIDGET_H
- OsgWidget.cpp

		#include "OsgWidget.h"
		#include "ui_OsgWidget.h"
		 
		#include <osgQt/GraphicsWindowQt>
		#include <osgViewer/Viewer>
		#include <osgGA/TrackballManipulator>
		#include <osgGA/StateSetManipulator>
		#include <osgViewer/ViewerEventHandlers>
		#include <osgDB/ReadFile>
		 
		#include "define.h"
		#include <QFileDialog>
		 
		OsgWidget::OsgWidget(QWidget *parent) :
		    QWidget(parent),
		    ui(new Ui::OsgWidget),
		    _pViewer(0),
		    _pGLWidget(0),
		    _pGraphicsWindowQt(0)
		{
		    ui->setupUi(this);
		    QString version = "V1.2.0";
		    setWindowTitle(QString("OsgDemo %1").arg(version));
		    initOsg();
		}
		 
		void OsgWidget::resizeEvent(QResizeEvent *event)
		{
		    if(_pGLWidget != 0)
		    {
		        _pGLWidget->move(0,0);
		        _pGLWidget->resize(rect().size());
		    }
		}
		 
		void OsgWidget::initOsg()
		{
		    // 使用osgQt步骤示例
		    // 定义
		//    osg::ref_ptr<osgViewer::Viewer> _pViewer;
		//    osg::ref_ptr<osg::Viewport> _pViewport;
		//    osgQt::GLWidget * _pGLWidget;
		//    osgQt::GraphicsWindowQt* _pGraphicsWindowQt;
		    // 步骤一：初始化qt窗口系统
		    osgQt::initQtWindowingSystem();
		    // 步骤二：创建视口
		    _pViewer = new osgViewer::Viewer;
		    // 步骤三：视口设为单线程（Qt5必须）
		    _pViewer->setThreadingModel(osgViewer::ViewerBase::SingleThreaded);
		    // 步骤四：对视图的操作，必须，否则无法显示黑屏
		    _pViewer->setCameraManipulator(new osgGA::TrackballManipulator);
		    // 步骤五：视口操作
		    _pViewer->setSceneData(osgDB::readNodeFile("glider.osg"));
		    // 步骤六：设置osgQt视口(一个应用程序用opgQt同一时刻只能设置一个视口）
		    osgQt::setViewer(_pViewer.get());
		    // 步骤七：创建窗口(2个都要，只创建osgQt::GLWidget会挂掉）
		//    _pGLWidget = new osgQt::GLWidget();
		    _pGLWidget = new osgQt::GLWidget(this);
		    _pGraphicsWindowQt = new osgQt::GraphicsWindowQt(_pGLWidget);
		    // 步骤八：设置视口
		    _pViewport = new osg::Viewport(0, 0, _pGLWidget->width(), _pGLWidget->height());
		    // 步骤九：设置摄像机视口范围，未设置不会显示，即窗口一片黑（刷新窗口但没有内容显示）
		    _pViewer->getCamera()->setViewport(_pViewport);
		    // 步骤十：设置刷新显示内容，未设置不会显示，即一片白（不会刷新窗口）
		    _pViewer->getCamera()->setGraphicsContext(_pGraphicsWindowQt);
		    // 步骤十一：显示
		    _pGLWidget->show();
		    _pGLWidget->lower();
		}
		 
		void OsgWidget::loadOsg(QString osgFilePath)
		{
		    _pViewer->setSceneData(osgDB::readNodeFile(osgFilePath.toStdString()));
		}
		 
		void OsgWidget::on_pushButton_open_clicked()
		{
		    QString filePath = QFileDialog::getOpenFileName(0, "打开...");
		    if(!filePath.isEmpty())
		    {
		        _pViewer->setSceneData(osgDB::readNodeFile(filePath.toStdString()));
		    }
		}