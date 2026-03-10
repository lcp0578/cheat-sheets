## QSignalMapper
- 该类收集一组无参数信号，并使用与发送信号的对象对应的整数、字符串或小部件参数重新发射它们。
- 注意，在大多数情况下，您可以使用lambda将自定义参数传递给插槽。这是较低的成本，并将简化代码。
- 该类支持特定字符串、整数、对象和小部件与特定对象的映射。
- QSignalMapper我们可以理解为转发器。比如，按钮点击的响应槽，绑定到QSignalMapper上，QSignalMapper收到按钮的点击后，又通知到另外的控件上做处理。
- 示例代码

		#include "mainwindow.h"
		#include "ui_mainwindow.h"
		#include <QDebug>
		#include <QVBoxLayout>
		#include <QSignalMapper>
		#include <QLineEdit>
		#include <QPushButton>
		
		MainWindow::MainWindow(QWidget *parent)
		    : QMainWindow(parent)
		    , ui(new Ui::MainWindow)
		{
		    ui->setupUi(this);
		    QSignalMapper *pMapper = new QSignalMapper(this);
		
		    QString str = "Button1 Button2 Button3 Button4 Button5";
		    QStringList strList = str.split(" ");
		
		    QVBoxLayout *pLayout = new QVBoxLayout(this);
		    int nRowCnt = 0;
		    foreach(const auto& it, strList){
		        QPushButton *pBtn = new QPushButton(this);
		        pBtn->setText(it);
		
		        connect(pBtn, SIGNAL(clicked()), pMapper, SLOT(map()));
		        pMapper->setMapping(pBtn, pBtn->text()+"test");
		        pLayout->addWidget(pBtn);
		        pBtn->move(10,nRowCnt++*30);
		    }
		
		    QLineEdit *pEdit = new QLineEdit(this);
		    pEdit->move(10,nRowCnt++*30);
		    connect(pMapper, SIGNAL(mapped(QString)), pEdit, SLOT(setText(QString)));
		    pLayout->addWidget(pEdit);
		    pLayout->addStretch();
		    setLayout(pLayout);
		}
		
		MainWindow::~MainWindow()
		{
		    delete ui;
		}

