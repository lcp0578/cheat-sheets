## Qt 插件机制以及插件中几个重要的宏
> https://doc.qt.io/qt-5/qtplugin.html  
> https://doc.qt.io/qt-5/plugins-howto.html

- 简述
	- Qt 插件类必须继承自 QObject 类和插件接口类。
	- 然后，可以通过 QPluginLoader 类调用插件类。
	- 若没有 Q_DECLARE_INTERFACE 和 Q_INTERFACES 这两个宏，就无法对从插件中获取的实例指针进行 qobject_cast 映射。
- 接口类
	- 定义一个纯虚类作为插件接口类。

            #include <QtPlugin>    
            #include <QString>    

            class IMyPlugin    
            {    
            public:    
                virtual QString Hello() = 0;    
            };    

            Q_DECLARE_INTERFACE(IMyPlugin, "lcp_my_plugin")  
	- `Q_DECLARE_INTERFACE` 宏告诉Qt 这个纯虚类是一个插件接口类。
	- `Q_DECLARE_INTERFACE` 宏是与`qobject_cast`相关的。
	- 第一个参数是接口类名，第二个参数是插件标志符，标识符是大小写敏感的且必须是唯一。
- 实现类 
	- 实现类必须继承自 QObject 和插件接口类（也可以在插件接口类的时候就继承QObject）。每一个插件类都有一个独立的 IID 值。
	
    		class MyPlugin : public QObject, public IMyPlugin    
            {    
                Q_OBJECT    
                Q_PLUGIN_METADATA(IID "lcp_my_plugin" FILE "C:/a.json")    
                Q_INTERFACES(IMyPlugin)    

            public:    
                virtual QString Hello() Q_DECL_OVERRIDE;    
            };  
- `Q_PLUGIN_METADATA` 宏用于描述插件元数据，第一个参数 IID 是必须的，同插件标识符一样，而第二个参数FILE是可选的，指定一个本地的 json 文件，该文件可以描述插件的相关数据信息。

	- `Q_INTERFACES` ：若一个头文件或源文件中用到了 Q_INTERFACES 宏，那么在调用这个宏之前，必须存在一个 Q_DECLARE_INTERFACE 宏声明相应的接口（或者包含一个用 Q_DECLARE_INTERFACE 宏声明了该接口的头文件），MOC会检查这一点，因为它在为 Q_INTERFACES 宏生成代码时要用到Q_DECLARE_INTERFACE 宏的 IID 参数。Q_INTERFACES宏也是与qobject_cast相关，没有 Q_DECLARE_INTERFACE 和 Q_INTERFACES 这两个宏，就无法对从插件中获取的实例指针进行qobject_cast映射
	- `Q_DECL_OVERRIDE` 宏来声明这是一个对虚函数进行定义的方法，编译器会验证该方法名是否是父类中所有的，如果没有则报错。
- 调用
	- 通过 QPluginLoader 类调用插件类。

            {  
                QPluginLoader loader("C:/MyPlugin.dll");    
                if (loader.load())    
                {    
                    QObject *obj = loader.instance();    
                    if (obj)    
                    {    
                        IMyPlugin *plugin = qobject_cast<IMyPlugin*>(obj);    
                        if (plugin)    
                        {    
                            // 测试插件方法    
                            qDebug() << plugin->Hello();    

                            // 输出插件元数据    
                            qDebug() << loader.metaData();    
                        }    

                        // 需要手动释放    
                        delete obj;    
                    }    
                }    
            }  