## 创建窗口分割线之QSplitter
- 关于QSplitter
	- `QSplitter`类继承自`QFrame`类，也就是说该类是一个带有边框的可视部件。
	- `QSplitter`类实现了分离器，分离器用于分离两个部件，用户可通过拖动部件之间的分界线来调整子部件的大小。
- 示例代码

		#include "serialport.h"
		#include "ui_serialport.h"
		#include <QSplitter>
		#include <QLayout>
		
		SerialPort::SerialPort(QWidget *parent):QWidget(parent),ui(new Ui::SerialPort)
		{
		    ui->setupUi(this);
		    QSplitter *splitter = new QSplitter(Qt::Vertical, this);   //创建上下分割的对象
		    splitter->setOpaqueResize(false);
		
		    splitter->setParent(ui->widget);    //设置QSplitter父容器widget，widget在布局页面拖拽生成
		    ui->textEdit->setParent(splitter);  //设置textEdit的父容器为QSplitter， textEdit在布局页面拖拽生成，
		    ui->tabWidget->setParent(splitter); //设置tabWidget的父容器为QSplitter，tabWidget在布局页面拖拽生成，
		    QVBoxLayout * qVBoxLayout = new QVBoxLayout();//创建垂直布局
		    qVBoxLayout->addWidget(splitter);   //将容器QSplitter设置到创建的垂直布局中
		    qVBoxLayout->setContentsMargins(3,8,0,0);//设置QVBoxLayout布局的上下左右的边距
		    ui->widget->setLayout(qVBoxLayout); //将创建好的垂直布局加载到widget中
		
		    QHBoxLayout * hBoxLayout = new QHBoxLayout();//创建水平布局
		    hBoxLayout->addWidget(ui->textEdit);
		    hBoxLayout->addWidget(ui->tabWidget);
		    //hBoxLayout->setContentsMargins(3,8,0,0);
		    //hBoxLayout->setStretch(1,8);
		    //hBoxLayout->setMargin(0);
		    splitter->setLayout(hBoxLayout);
		    splitter->setStretchFactor(1,1);
		    splitter->show();
		}
		
		SerialPort::~SerialPort()
		{
    delete ui;
}
