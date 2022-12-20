## ui->setupUi(this) 分析
- `mywindow.h`代码分析

		#ifndef MYWINDOW_H
		#define MYWINDOW_H
		
		#include <QMainWindow>
		
		QT_BEGIN_NAMESPACE
		namespace Ui { class MyWindow; } //声明了Ui下的MyWindow类
		QT_END_NAMESPACE
		
		class MyWindow : public QMainWindow
		{
		    Q_OBJECT
		
		public:
		    MyWindow(QWidget *parent = nullptr);
		    ~MyWindow();
		
		private:
		    Ui::MyWindow *ui; //定义私有成员变量ui
		};
		#endif // MYWINDOW_H
- `mywindow.cpp`代码分析

		#include "mywindow.h"
		#include "ui_mywindow.h" //引入了自动生成的ui文件的头
		
		MyWindow::MyWindow(QWidget *parent)
		    : QMainWindow(parent)
		    , ui(new Ui::MyWindow)
		{
		    ui->setupUi(this); //把这个对象注入到ui里面
		}
		
		MyWindow::~MyWindow()
		{
		    delete ui; //析构，释放ui
		}
- `ui_mywindow.h` 代码分析

		/********************************************************************************
		** Form generated from reading UI file 'mywindow.ui'
		**
		** Created by: Qt User Interface Compiler version 5.9.9
		**
		** WARNING! All changes made in this file will be lost when recompiling UI file!
		********************************************************************************/
		
		#ifndef UI_MYWINDOW_H
		#define UI_MYWINDOW_H
		
		#include <QtCore/QVariant>
		#include <QtWidgets/QAction>
		#include <QtWidgets/QApplication>
		#include <QtWidgets/QButtonGroup>
		#include <QtWidgets/QHeaderView>
		#include <QtWidgets/QMainWindow>
		#include <QtWidgets/QMenuBar>
		#include <QtWidgets/QStatusBar>
		#include <QtWidgets/QWidget>
		
		QT_BEGIN_NAMESPACE
		
		class Ui_MyWindow
		{
		public:
		    QWidget *centralwidget;
		    QMenuBar *menubar;
		    QStatusBar *statusbar;
		
		    void setupUi(QMainWindow *MyWindow) //定义了setupUi
		    {
		        if (MyWindow->objectName().isEmpty())
		            MyWindow->setObjectName(QStringLiteral("MyWindow"));
		        MyWindow->resize(800, 600);
		        centralwidget = new QWidget(MyWindow);
		        centralwidget->setObjectName(QStringLiteral("centralwidget"));
		        MyWindow->setCentralWidget(centralwidget);
		        menubar = new QMenuBar(MyWindow);
		        menubar->setObjectName(QStringLiteral("menubar"));
		        MyWindow->setMenuBar(menubar);
		        statusbar = new QStatusBar(MyWindow);
		        statusbar->setObjectName(QStringLiteral("statusbar"));
		        MyWindow->setStatusBar(statusbar);
		
		        retranslateUi(MyWindow);
		
		        QMetaObject::connectSlotsByName(MyWindow);
		    } // setupUi
		
		    void retranslateUi(QMainWindow *MyWindow)
		    {
		        MyWindow->setWindowTitle(QApplication::translate("MyWindow", "MyWindow", Q_NULLPTR));
		    } // retranslateUi
		
		};
		
		namespace Ui {
		    class MyWindow: public Ui_MyWindow {}; //声明MyWindow为Ui_MyWindow的子类
		} // namespace Ui
		
		QT_END_NAMESPACE
		
		#endif // UI_MYWINDOW_H