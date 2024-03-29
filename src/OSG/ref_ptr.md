## 内存管理机制
- OSG中使用场景树结构来管理整个三维世界，如果需要绘制一个规模宏大的场景，则是必要创建和维护众多的结点对象。
- 这一场景不在继续渲染时，对于传统的开发流程来说，就需要手动卸载其中所有的节点，释放所有已分配的内存空间，在进行下一步的工作。如果未能释放所有场景对象，则会产生内存泄漏。
- OSG提供一种“垃圾收集”机制，通过“内存引用计数”的形式来管理场景中的节点和绘制体，每个场景中的对象都维护着一个引用计数值，当它被其他对象使用时，引用计数值加1，反之减一。当一个对象的引用计数为0时，它将自动从内存中释放。
- 智能指针

		osg::ref_ptr<T>类
	- 使用如下方法来定义一个使用智能指针来管理的参照对象

			osg::Geode*  geode=new  osg::Geode;

			osg：：ref_ptr<osg::Geode>  geodePtr=geode;//创建一个新的ref_ptr对象，并将一个新建的Geode指针分配给它。

			osg::Geode*  obj1 = *geodePtr;    //获取Geode指针
			groupNode->addChild(geodePtr);//   获取指针并传递给其他函数

			//在这个过程中，如果超出了geodePtr的生命周期范围，那么这个智能指针变量在析构的过程中会自动将Geode对象的引用计数值减1，一共引用了一次，运行结束后减1，则该结点变量会被自动卸载。

- 参考对象
	- 参考对象是引用计数和对象自动卸载的实际执行者。