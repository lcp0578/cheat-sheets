## Qt6的一些变化
- 一般方法
	- 安装5.15版本，定位到报错的函数，切换到源码头文件，可以看到对应提示字样 QT_DEPRECATED_X("Use sizeInBytes") 和新函数。按照这个提示类修改就没错，一些函数是从Qt5.7 5.9 5.10等版本新增加的，可能你的项目还用的Qt4的方法，但是Qt6以前都兼容这些旧方法，到了Qt6就彻底需要用新方法了。
- `core`核心类变化
	- Qt6对core这个核心类进行了拆分，多出来core5compat，因此你需要在pro增加对应的模块已经代码中引入对应的头文件。

			greaterThan(QT_MAJOR_VERSION, 5): QT += core5compat
-  默认Qt6开启了高分屏支持，界面会变得很大，甚至字体发虚，很多人会不习惯，因为这种模式如果程序很多坐标计算没有采用devicePixelRatio进行运算的话，100%会出现奇奇怪怪的问题，因为坐标不准确了。要取消这种效果可以设置高分屏缩放因子。

		#if (QT_VERSION >= QT_VERSION_CHECK(6,0,0))
		    QGuiApplication::setHighDpiScaleFactorRoundingPolicy(Qt::HighDpiScaleFactorRoundingPolicy::Floor);
		#endif
- 原有的随机数函数提示用`QRandomGenerator`替代
- `QColor`的 `light` 改成 `lighter` ，`dark` 改成 `darker`
- `QFontMetricsF` 中的 `fm.width` 换成 `fm.horizontalAdvance` ，从5.11开始用新函数。
- `QPalette`调色板枚举值，`Foreground` 改成 `WindowText`, `Background` 改成 `Window`，类似的还有 `setTextColor` 改成了 `setForeground` 。
- `QWheelEvent`的 `delta()` 改成 `angleDelta().y()`，`pos()` 改成 `position()` 。
- svg模块拆分出来了`svgwidgets`，如果用到了该模块则需要在pro增加 `QT += svgwidgets` 。
- `qlayout`中的 `margin()` 函数换成 `contentsMargins().left()`，`类似的还有`setMargin`移除了，统统用`setContentsMargins`。
- 之前 `QChar c = 0xf105` 全部要改成强制转换 `QChar c = (QChar)0xf105`，不再有隐式转换，不然编译报错提示`error: conversion from 'int' to 'QChar' is ambiguous` 。
- `qSort`等一些函数用回c++的 `std::sort` 。

		#if (QT_VERSION >= QT_VERSION_CHECK(6,0,0))
		std::sort(ipv4s.begin(), ipv4s.end());
		#else
		qSort(ipv4s);
		#endif
- `Qt::WA_NoBackground` 改成 `Qt::WA_OpaquePaintEvent` 。
- `QMatrix` 类废弃了没有了，换成 `QTransform` ，函数功能基本一致，`QTransform` 类在Qt4就一直有。
- `QTime` 计时去掉了，需要改成 `QElapsedTimer` ，`QElapsedTimer` 类在Qt4就一直有。
- `QApplication::desktop()`废弃了， 换成了 `QApplication::primaryScreen()`。

		#if (QT_VERSION > QT_VERSION_CHECK(5,0,0))
		#include "qscreen.h"
		#define deskGeometry qApp->primaryScreen()->geometry()
		#define deskGeometry2 qApp->primaryScreen()->availableGeometry()
		#else
		#include "qdesktopwidget.h"
		#define deskGeometry qApp->desktop()->geometry()
		#define deskGeometry2 qApp->desktop()->availableGeometry()
		#endif
- 获取当前屏幕索引以及尺寸需要分别处理获取当前屏幕索引以及尺寸需要分别处理

		//获取当前屏幕索引
		int QUIHelper::getScreenIndex()
		{
		//需要对多个屏幕进行处理
		int screenIndex = 0;
		#if (QT_VERSION >= QT_VERSION_CHECK(5,0,0))
		int screenCount = qApp->screens().count();
		#else
		int screenCount = qApp->desktop()->screenCount();
		#endif
		
		if (screenCount > 1) {
		    //找到当前鼠标所在屏幕
		    QPoint pos = QCursor::pos();
		    for (int i = 0; i < screenCount; ++i) {
		#if (QT_VERSION >= QT_VERSION_CHECK(5,0,0))
		        if (qApp->screens().at(i)->geometry().contains(pos)) {
		#else
		        if (qApp->desktop()->screenGeometry(i).contains(pos)) {
		#endif
		            screenIndex = i;
		            break;
		        }
		    }
		}
		return screenIndex;
		}
- `QRegExp`类移到了`core5compat`模块，需要主动引入头文件 `#include <QRegExp>`。
- `QWheelEvent`构造参数和对应的计算方位函数变了。

		//模拟鼠标滚轮
		#if (QT_VERSION < QT_VERSION_CHECK(6,0,0))
		QWheelEvent wheelEvent(QPoint(0, 0), -scal, Qt::LeftButton, Qt::NoModifier);
		#else
		QWheelEvent wheelEvent(QPointF(0, 0), QPointF(0, 0), QPoint(0, 0), QPoint(0, -scal), Qt::LeftButton, Qt::NoModifier, Qt::ScrollBegin, false);
		#endif
		QApplication::sendEvent(widget, &wheelEvent);
		
		//鼠标滚轮直接修改值
		QWheelEvent *whellEvent = (QWheelEvent *)event;
		//滚动的角度,*8就是鼠标滚动的距离
		#if (QT_VERSION < QT_VERSION_CHECK(6,0,0))
		int degrees = whellEvent->delta() / 8;
		#else
		int degrees = whellEvent->angleDelta().x() / 8;
		#endif
		//滚动的步数,*15就是鼠标滚动的角度
		int steps = degrees / 15;
- `qVariantValue` 改成 `qvariant_cast` ，`qVariantSetValue(v, value) `改成了 `v.setValue(val)`。
- `QStyleOption`的`init`改成了`initFrom`。
- `QVariant::Type` 换成了 `QMetaType::Type`
- `QStyleOptionViewItemV2` `V3` `V4` 之类的全部没有了，暂时可以用 `QStyleOptionViewItem` 替代。
- `QFont`的 `resolve` 的一个重载函数换成了 `resolveMask`。
- `QSettings`的 `setIniCodec` 方法移除了，默认就是utf8，不需要设置。
- `qcombobox` 的 `activated(QString)` 和 `currentIndexChanged(QString)` 信号删除了，用int索引参数的那个，然后自己通过索引获取值。
- `qtscript`模块彻底没有了，尽管从Qt5时代的后期版本就提示为废弃模块，一致坚持到Qt6才正式废弃，各种json数据解析全部换成`qjson`类解析。
- `QByteArray` 的 `append` `indexOf` `lastIndexOf` 等众多方法的`QString`参数重载函数废弃了，要直接传 `QByteArray`，就在原来参数基础上加上 `.toUtf8()` 。
- `QDateTime`的时间转换函数 `toTime_t` + `setTime_t` 名字改了，对应改成了 `toSecsSinceEpoch` + `setSecsSinceEpoch` ，这两个方法在Qt5.8时候新增加的。
- `QLabel`的 `pixmap` 函数之前是指针 `*pixmap()` 现在换成了引用 `pixmap()`。
- `QTableWidget`的 `sortByColumn` 方法移除了默认升序的方法，必须要填入第二个参数表示升序还是降序。
- `qtnetwork`中的错误信号`error`换成了`errorOccurred`。
- `XmlPatterns`模块木有了，全部用`xml`模块重新解析。
- `nativeEvent`的参数类型变了。

		#if (QT_VERSION >= QT_VERSION_CHECK(6,0,0))
		bool nativeEvent(const QByteArray &eventType, void *message, qintptr *result);
		#else
		bool nativeEvent(const QByteArray &eventType, void *message, long *result);
		#endif