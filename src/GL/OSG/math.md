## 基本数学组件
#### 一、基本数学组件
- 1.1 二维与多维向量
	- 构建一个单精度浮点类型的三维向量vector是：`osg::Vec3f  vector`
	- 构建一个双精度浮点类型的四维向量vector是：`osg::Vec4d  vector`
	- 以`osg::Vec3f` 为例来实现各种类型的向量运算

			osg::Vec3 v1;
			
			v1.set(1.0, 1.0, 1.0)  //设置向量的值
			v1.normalize()          //对向量进行归一化处理
			float x=v1[0]              //获取分量的值，即获得第一个元素的值
			
			osg::Vec3 v2(2.0, 5.0, 8.0)     //通过构造函数赋值，直接设置三个分量的值
			v2 *= 0.5                                 //向量的数乘运算
			v2 =osg::Vec3(1.0, 0.0, -2.0) -v2 //向量的四则运算中的减法
			
			float  distance = (v1 -v2 ).length()   //求取两向量的距离
			float  dotproduct  = v1 * v2         //向量点乘
			osg::Vec3   crossProduct = v1 ^ v2  //向量叉乘
- 1.2 四元数
	- 四元数的优势在于：它可以表达物体绕任意向量轴的旋转，并且和欧拉角度旋转与旋转矩阵的方法相比，其效率效高，操作也更加灵活
	- 四元数由三个复数和一个实数组成
	- 设置沿x轴逆时针旋转90度的代码

			osg::Quat quat(psg::PI_2,  osg::Vec3(1.0,  0.0,  0.0);
	其中`osg::PI_2`是OSG中的预定义宏，数学上表示为`pi/2`

			osg::Quat  quat(osg::DegreesToRadians(90.0),  osg::Vec3(1.0,  0.0,  0.0);
	和上一行代码表示的含义相同，其第一个参数直接使用角度值而非弧度值来表达旋转角度，应用到一个函数`osg::DegreesToRadians()`

			osg::Quat  quat3 = quat1 * quat2 
	它表示这两次旋转结果的叠加之和


			osg::Vec3  vec;
			
			double angle;
			
			quat.getRotate(angle,vec );   //通过getRotate（）函数获取四元数包含的旋转动作内容，即它所依据的旋转轴和旋转角度
			
			double  degree = osg::RadiansToDegrees(angle);  //将弧度值转换为角度值

- 1.3矩阵

		osg::Matrix   mat1;   //定义一个单位矩阵
		
		mat1.makeRotate(osg::Quat(osg::PI_2, osg::Vec3(1.0, 0.0, 0.0));     //旋转，沿x轴逆时针旋转90度
		
		mat1.preMultTranslate(osg::Vec3d(0.0,  1.0, 0.0 ));                     //沿y方向平移
		
		double   a11 =mat1 (1,1);  // 获取第二行和第二列的元素
		
		
		osg::Matrix   mat2; 
		mat2.makeScale(osg::Vec3d(1.0, 1.0, 2.0));  // 设置为缩放矩阵
		
		
		osg::Matrix   mat3; 
		mat3 = mat2 * mat1 ;    //    级联两个矩阵
		
		
		osg::Vec3d  vec(0.0, 0.0, 1.0);
		
		vec = vec * mat3;    //将矩阵用于向量的空间变换

	其最终的效果为几个动作叠加：先执行Z方向的放大，在执行X方向的旋转，最后执行Y方向的平移。

		osg::Matrix   mat3; 
		mat3 = osg::Matrixd::scale(osg::Vec3d(1.0, 1.0, 2.0)) *  osg::Matrixd::rotate(osg::Quat(osg::PI_2,osg::Vec3(1.0, 0.0, 0.0))  *   osg::Matrixd::translate(osg::Vec3d(0.0, 1.0, 0.0));
		
		 
		osg::Vec3d  vec(0.0, 0.0, 1.0);
		
		vec = vec * mat3; 

	这段代码和上面的代码作用是相同的，不同的是其书写方式，以及用到了新的类的函数，新类为osg::Matrixd
- 1.4包围体
	- OSG中支持两种类型的包围体，即包围球和轴对称包围盒，它们主要用于场景图形结点层次的实现。
	- 包围球和包围盒都是不和绘制的对象，它们值负责记录一些必要的属性信息（如中心，包围半径等），同时用于一些必要的数学运算，并且，包围体中心表达的往往不是世界坐标系下的物体中心，而是取决于它处于场景树中的哪一级局部坐标系。
	- 创建一个单精度的包围球：

			osg::BoundingSphere   bs(osg::Vec3(0.0, 0.0, 0.0), 1.0f)   //第一个获得中心点，第二个获得半径长度

	- 创建一个包围盒

			osg::BoundingBox  bb(osg::Vec3(0.0, 0.0, 0.0), osg::Vec3(1.0, 2.0, 3.0))  //第一个参数为最小端点，第二个参数为最大端点

#### 二、数组对象
- 2.1数据数组（基类为Array）
	- 这类数组数据类型为单精度或双精度的浮点数据，包括数值、多维向量等，主要用于OpenGL定点坐标，颜色，纹理坐标等属性数组的设置
	- 为了使Array真正具备保存多种类型的数据的能力，需要定义一个模板类并接受不同的模板参数，同时还需要使用`std:::vector`向量组来记录数组中的多个元素信息。
	- 下面快速构建一个Vec3类型的数据数组，并使用标准模板库向量组的操作方法对其进行各种操作

			//定义三维向量数组
			osg::Vec3Array*  array  = new  osg::Vec3Array;
			
			//向数组中传入数据
			array->push_back(osg;:Vec3(1.0,0.0,0.0));
			
			array->push_back(osg;:Vec3(1.0,-1.0,2.0));

			//这两种方法都可以获取数组的某个元素
			osg::Vec3&  element1 = (* array)[0];
			
			osg::Vec3   element2 = array->at(1);
			
			//使用迭代器遍历数组
			for(osg::Vec3Array::iterator  itr=array->begin(); itr!=array->end(); ++itr)
			{
			       osg::Vec3&  vec  =*itr:
			      ...
			}



- 2.2数据索引数组
	- 此类数组的元素一般是整数类型，索引数组在绘制OpenGL集合图元时尤为常见
	- 索引数组类派生自`Array`类，名为`IndexArray`,它除了继承`Array`类的所有成员函数之外还定义了自己的成员。
	- 其基本操作方法与数据数组的操作并无本质区别。
