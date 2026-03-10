## Qt中的connect用法总结
### 第一种
- 首先来看看老版本的 `connect` 写法，比较复杂些，需要将信号和槽进行明确的指定，包括形参。 
- 为方便演示，先自定义一个 Button，然后定义两个重载的信号

		class MyButton : public QWidget
		{
		    Q_OBJECT
		public:
		    explicit MyButton(QWidget *parent = nullptr);
		
		signals:
		    void sigClicked();
		    void sigClicked(bool check);
		};
- 那么在用这个 Button 的时候连接这两个信号，按照旧版本的写法，应该是这样：

		connect(m_pBtn,SIGNAL(sigClicked()),this,SLOT(onClicked()));
		
		connect(m_pBtn,SIGNAL(sigClicked(bool)),this,SLOT(onClicked(bool)));

- 这种写法比较麻烦，常常在用的时候缺少括号，不过该写法很明确，一眼就能看出来是将哪个信号连接到哪个槽。

### 第二种
- 接着上面的示例，在 Qt5.0以后推出一种新的写法，如下：

		connect(m_pBtn,&MyButton::sigClicked,this,&Widget::onClicked);

- 这种写法看起来很简洁，但是存在一些坑需要注意，这句写法如果用在上面的示例中，会报错下面的错误：

		error: no matching member function for call to 'connect' connect(m_pBtn,&MyButton::sigClicked,this,&Widget::onClicked);

- 这是因为我们自定义的 Button 中存在两个重载信号，然后用这种 connect 的方式会无法识别到底想要连接哪个信号。所以，如果信号是重载的话，需要用下面的写法来替换：

		connect(m_pBtn, static_cast<void (MyButton::*)(bool)>(&MyButton::sigClicked), this, &Widget::onClicked);

- 问题又来了，如果我的onClicked槽也是重载的话，还是会报同样的错误。因为编译器不知道你想要真正连接哪个槽。所以这里建议，如果信号重载，可以用上面的方法来写，如果槽重载…还是用第一种方法来 connect 吧，比较保险，虽然比较麻烦点。

### 第三种
- 最后来看一种最新的写法，忘记是在 Qt 的哪个版本推出的了，主要针对重载信号的连接做了调整，会更简单些： 
- 同样是上面的示例：

		connect(m_pBtn, QOverload<bool>::of(&MyButton::sigClicked),this,&Widget::onClicked);

- 很显然这种写法相对于第二种会比较简单些，但依然不能连接到重载的槽函数，如果连接重载槽函数，还是会报之前的错误。

### 第四种：Lambda 函数写法
- 个人比较喜欢用lambda函数的方式，如果槽函数中的内容比较简单的话，没必要再去单独定义一个槽来连接， 直接用Lambda 函数会更简单。 
- 来看一下示例：

		connect(m_pBtn, QOverload<bool>::of(&MyButton::sigClicked), [=](bool check){
                /* do something.. */

                });

		connect(m_pBtn, static_cast<void (MyButton::*)(bool)>(&MyButton::sigClicked), this, [=](bool check){
                 //do something

                 });

- 最后一部分的Lambda函数写法，是涉及到了C++11的特性，