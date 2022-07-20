## Qt的操作堆栈
- `QUndoCommand`
	- `QUndoCommand(const QString &text, QUndoCommand *parent = nullptr)`
	- 该类就是堆栈中的操作元，我们在用的时候需要创建该类的子类，重写该类的一些方法，并将操作的具体实现放到继承的子类中，通常需要重写`redo`、`undo`、`mergeWith`、`id`等方法
	- `redo`
		- 该方法是操作的具体实现，也就是做和重做时所调用的方法
	- `undo`
		- 该方法是操作的反操作，也就是执行撤销时候的操作
	- `mergeWith`和`id`
		- 这两个方法不是必须重写的，如果想将多个操作合并成一个，则需要重写这两个方法。
		- 对于需要合并的操作，需要重写id方法返回相同的值，该值需要大于0，然后在mergeWith方法中进行数据合并的操作，合并成功返回true，合并失败返回false，基本实现框架大概像这样：

				int SubCommand::id() const
				{
				    return SubCommandId;
				}
				
				bool SubCommand::mergeWith(const QUndoCommand *command)
				{
					// 先判断是否是需要合并的id
				    if (command->id() != SubCommandId)
				        return false;
				        
					// 具体的数据合并
				    return true;
				}
	- `setText`
		- 该方法不需要重写，用来设置QUndoView中对操作堆栈中的每个操作的显示字符串

- `QUndoStack`
	- 存放操作的堆栈，主要用到的方法有push、canRedo、redo、canUndo、undo，
	- 在需要执行操作的位置，首先new一个SubCommand的实例，然后以该实例为参数调用QUndoStack的push方法，在push方法内会调用SubCommand的redo方法执行具体才操作。
	- 使用方法大致如下：

			// 需要执行操作的位置
			m_undoStack->push(new SubCommand();
			
			// 撤销动作
			if (m_undoStack->canUndo())
					m_undoStack->undo();
			
			// 重做动作
			if (m_undoStack->canRedo())
					m_undoStack->redo(); 

- `QUndoGroup`
	- 该类主要用于多文档程序，用于管理`QUndoStack`，每个文档有一个`QUndoStack`，然后添加到`QUndoGroup`中进行管理。

- `QUndoView`
	- 该类用于显示执行的堆栈
	- 这个用法很简单，new出来直接show就行了，
	- 通常在调试中使用。
	- 如果想要显示操作堆栈的内容，需要在SubCommand的构造函数中使用setText方法来设置每个SubCommand在QUndoView中的描述字符串