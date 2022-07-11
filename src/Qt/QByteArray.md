## QByteArray
- QByteArray -> QString

		QString::fromUtf8(const QByteArray &str)
		QString::QString(const QByteArray &ba)
- QString -> QByteArray

		QString::toUtf8()