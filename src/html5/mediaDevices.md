## navigator.mediaDevices 访问媒体设备
- `navigator.mediaDevices` 接口提供访问连接媒体输入的设备，如照相机和麦克风，以及屏幕共享等。它可以使你取得任何硬件资源的媒体数据
- mediaDevices上提供了4个方法和一个监听事件
	- 方法：
		- `enumerateDevices`:  获取系统可用的媒体输入和输出设备
		- `getSupportedConstraints`： 返回一个输入设备可支持的约束属性
		- `getDisplayMedia`： 开启屏幕共享
		- `getUserMedia`： 开启媒体输入设备

	- 事件：
		- `devicechange`
- 来源：https://juejin.cn/post/6924563220657586184
