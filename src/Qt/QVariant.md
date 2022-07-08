## QVariant类及QVariant与自定义数据类型转换的方法
- 它把绝大多数Qt提供的数据类型都封装起来，起到一个数据类型“擦除”的作用。
- `QVariant`类型的放入和取出必须是相对应的
- `QVariant` 属于 Qt 的Core模块，属于Qt的底层核心之一，`ActiveQt`、`QtScript`、`QtDeclarative`等都严重依赖于`QVariant`。
- `QVariant` 可以保存很多Qt的数据类型，包括`QBrush`、`QColor`、`QCursor`、`QDateTime`、`QFont`、`QKeySequence`、 `QPalette`、`QPen`、`QPixmap`、`QPoint`、`QRect`、`QRegion`、`QSize`和`QString`，并且还有C++基本类型，如 `int`、`float`等。
- `QVariant`还能保存很多集合类型，如`QMap<QSTRING, QVariant>`, `QStringList`和`QList`。item view classes，数据库模块和`QSettings`都大量使用了`QVarian`t类，，以方便我们读写数据。
- QVariant也可以进行嵌套存储，例如

		QMap<QString, QVariant> pearMap;   
		pearMap["Standard"] = 1.95;   
		pearMap["Organic"] = 2.25;   
		
		QMap<QString, QVariant> fruitMap;   
		fruitMap["Orange"] = 2.10;   
		fruitMap["Pineapple"] = 3.85;   
		fruitMap["Pear"] = pearMap;
- `QVariant`被用于构建Qt Meta-Object，因此是QtCore的一部分。当然，我们也可以在GUI模块中使用，例如

		QIcon icon("open.png");   
		QVariant variant = icon;   
		// other function   
		QIcon icon = variant.value<QIcon>();
#### 自定义数据类型
- 如果你觉得`QVariant`提供的存储数据类型太少，也可以自定义`QVariant`的存储类型。被`QVariant`存储的数据类型需要有一个默认的构造函数和一个拷贝构造函数。为了实现这个功能，首先必须使用`Q_DECLARE_METATYPE()`宏。通常会将这个宏放在类的声明所在头文件的下面(`Q_DECLARE_METATYPE(MyClass)`宏的位置：头文件，类声明后)：

		//要使用一个自定义类型可用于QVariant中只需要在类声明的后面加上:Q_DECLARE_METATYPE(), 
		struct MyClass
		{
		QString name;
		int age;
		}
		Q_DECLARE_METATYPE(MyClass)
		
		
		//这样我们的类就可以像QMetaType::Type类一样使用没什么不同,有点不同的是使用方法上面只能这样使用.
		MyClass myClass;
		QVariant v3 = QVairant::fromValue(myClass);
		//
		v2.canConvert<MyClass>();
		MyClass myClass2 = v2.value<MyClass>();
- 使用

		BusinessCard businessCard;   
		QVariant variant = QVariant::fromValue(businessCard);   
		// ...   
		if (variant.canConvert<BusinessCard>()) {   
		     BusinessCard card = variant.value<BusinessCard>();   
		     // ...   
		}