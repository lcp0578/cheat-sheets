## Qt 常用函数
- 查找ui部件

		findChild<QLineEdit *>(name)
- `QString`与`string` / `char*` / `num` / `float`转换

		char* QString2char(QString data) //QString转char*
		{
			QByteArray* byte = new QByteArray(data.toLocal8Bit());
			char* charData = byte->data();
			return charData;
		
		}
		QString::number()//number转QString
		QString.toStdString()//QString转string
		template<typename outT, typename inT> //string转其它类型
		outT string2num(const inT in)
		{
			stringstream  ss;
			outT out;
			ss << in;
			ss >> out;
			return out;
		};
		//单个字符转num-ascII码值
		string2num<unsigned char>(字符)
		//单个字符转num-转为数字
		(unsigned char)string2num<unsigned short>(字符)
- QString比较

		objectname_qstring.compare("xxxxx") == 0
- 正则表达式

		//检查ip和port
		QString device_ip = ui.device_ip->text();
		QString device_port = ui.device_port->text();
		QString ip_pattern("([0-9]{1,3}\.){3}[0-9]{1,3}");
		QString port_pattern("[0-9]+");
		QRegExp ip_rx(ip_pattern);
		QRegExp port_rx(port_pattern);
		bool ip_device_match = ip_rx.exactMatch(device_ip);
		bool port_device_match = port_rx.exactMatch(device_port);
		if (!ip_device_match || !port_device_match)
		{
			return;
		}
- 获取按名字查找控件的值（QString类型的值）

		QString qtanalysis::get_para_value_qstring(QString name, int type) {
			if (type == SPINBOX) //spinbox
			{
				return QString::number(findChild<QSpinBox *>(name)->value());
			}
			else if (type == RADIOGROUP) //radiogroup
			{
				QRadioButton *radioButton = qobject_cast<QRadioButton *>(findChild<QButtonGroup *>(name)->checkedButton());
				QString objectname_qstring= radioButton->objectName();
				char* objectname = QString2char(objectname_qstring);
				Uint8 indexofcheckbox = objectname[strlen(objectname)-1]-'0'-1; //返回0开始索引
				//qDebug() << "radiogroup  "<< objectname<< "  "<<indexofcheckbox;
				return QString::number(indexofcheckbox);
			}
			else if (type == LINEEDIT) //lineedit
			{
				return findChild<QLineEdit *>(name)->text();
			}
			else if (type == CHECKBOXGROUP) //checkboxgroup
			{
				QWidget *widget = findChild<QWidget *>(name);
				QList<QCheckBox *> checkboxlist = widget->findChildren<QCheckBox*>();
				Uint8 checkboxgourp_value = 0;
				for (int i = 0; i < checkboxlist.size(); i++)
				{
					QCheckBox* checkbox = checkboxlist.at(i);
					char* objectname = QString2char(checkbox->objectName());
					Uint8 indexofcheckbox = objectname[strlen(objectname) - 1] - '0' - 1;
					Uint8 checkvalue = checkbox->isChecked();
					checkboxgourp_value = checkboxgourp_value | (checkvalue << indexofcheckbox);
				}
				return QString::number(checkboxgourp_value);
			}
			else if (type == SLIDER) //slider
			{
				return QString::number(findChild<QSlider *>(name)->value());
			}
			else if (type == DOUBLESPIN) //doublespin
			{
				return QString::number(findChild<QDoubleSpinBox *>(name)->value(), 10, 2);
			}
			else if (type == COMBOBOX) //combobox
			{
				return findChild<QComboBox *>(name)->currentText();
			}
			else if (type ==TIMEEDIT_HOUR) //timeedit_h
			{
				return QString::number(findChild<QTimeEdit *>(name)->time().hour());
			}
			else if (type == TIMEEDIT_MINUTE) //timeedit_m
			{
				return QString::number(findChild<QTimeEdit *>(name)->time().minute());
			}
			else if (type == TIMEEDIT_SECOND) //timeedit_s
			{
				return QString::number(findChild<QTimeEdit *>(name)->time().second());
			}
		}
- 槽函数中获取发送者

		QPushButton *button = qobject_cast<QPushButton*>(sender());
- 跨线程信号和槽

		Qt::AutoConnection： 默认值，使用这个值则连接类型会在信号发送时决定。如果接收者和发送者在同一个线程，则自动使用Qt::DirectConnection类型。如果接收者和发送者不在一个线程，则自动使用Qt::QueuedConnection类型。
		Qt::DirectConnection：槽函数会在信号发送的时候直接被调用，槽函数运行于信号发送者所在线程。效果看上去就像是直接在信号发送位置调用了槽函数。这个在多线程环境下比较危险，可能会造成奔溃。
		Qt::QueuedConnection：槽函数在控制回到接收者所在线程的事件循环时被调用，槽函数运行于信号接收者所在线程。发送信号之后，槽函数不会立刻被调用，等到接收者的当前函数执行完，进入事件循环之后，槽函数才会被调用。多线程环境下一般用这个。
		Qt::BlockingQueuedConnection：槽函数的调用时机与Qt::QueuedConnection一致，不过发送完信号后发送者所在线程会阻塞，直到槽函数运行完。接收者和发送者绝对不能在一个线程，否则程序会死锁。在多线程间需要同步的场合可能需要这个。


