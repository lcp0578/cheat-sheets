## Qt 容器 
#### Qt 容器
- 简述
	- 这些类都是 **隐式共享** 和 **可重入** 的
		- 隐式共享：仅在被写入时才被拷贝；仅读数据时，多个变量共享一块空间
		- 可重入：首先它意味着这个函数可以被中断，其次意味着它除了使用自己栈上的变量以外不依赖于任何环境（包括static），这样的函数就是可重入，可以允许有多个该函数的副本在运行，由于它们使用的是分离的栈，所以不会互相干扰。反例：全局变量（如：static）
	- 且针对几个方面做了优化：
		- 速度，
		- 较低的内存占用
		- 尽可能少的内联代码，减少生成程序的体积。
	- 另外，在所有线程都以只读的方式访问容器时，这些类是线程安全的。
	- 要遍历容器中的元素，你可以使用两种风格迭代器：
		- Java 风格迭代器：有更好的易用性和更高级的函数，
		- STL 风格迭代器：在效率上会略有优势，并且可以用于 Qt 和 STL 提供的泛型算法中。
	- Qt 还提供了 `foreach` 关键字，可以方便地遍历容器。
- 容器分类
	- 顺序容器：`QList`，`QLinkedList`，`QVector`，`QStack` 和 `QQueue`
		- 对于大多数的应用，`QList` 是最适用的。虽然其基于数组实现，但支持在头部和尾部快速插入。
		- 如果确实需要一个基于链表的列表，你可以使用 `QLinkedList`。
		- 如果要求元素以连续内存的形式保存，那么可以使用 `QVector`。
		- `QStack` 和 `QQueue`提供了 LIFO 和 FIFO 语义的支持。

	- 关联容器：`QMap`，`QMultiMap`，`QHash`，`QMultiHash` 和 `QSet`
		- "Multi" 容器可以方便地支持键值一对多的情形。
		- “Hash” 容器提供了快速查找的能力，这是通过使用哈希函数代替对有序集合进行二分查找实现的。

- QT 各容器简述
	<table>
		<tr>
			<th>类</th>
			<th>综述</th>
		</tr>
		<tr>
			<td>QList</td>
			<td>
		这是目前使用最普遍的容器类，其保存了一个元素类型为T的列表，支持通过索引访问。QList 内部通过数组实现，以确保基于索引的访问足够快。
	元素可以通过 QList::append() 和 QList::prepend() 插入到首尾，也可以通过 QList::insert() 插入到列表中间，和其他容器类不同的是，QList 为生成尽可能少的代码做了高度优化。QStringList 继承于 QList<QString>。
	</td>
	</tr>
	<tr>
	<td>
	QLinkedList</td>
			<td>	这个类和 QList 很像，不同的是这个类使用迭代器进行而不是整形索引对元素进行访问。和 QList 相比，其在中间插入大型列表时其性能更优，而且其具有更好的迭代器语义。（在 QLinkedList 中，指向一个元素的迭代器只要该元素存在，则会一直保持有效，而在 QList 的迭代器则可能会在任意的元素插入或删除后失效。）
	</td>
	</tr>
	<tr>
	<td>
	QVector</td>
			<td>	这个类以数组的形式保存给定类型的元素，在内存中元素彼此相邻。在一个 vector 的头部或中部插入可能会相当慢，因为这可能会导致大量元素需要在内存中移动一个位置。
	</td>
	</tr>
	<tr>
	<td>
	QVarLengthArray<T, Prealloc>	</td>
			<td>这个类提供了一个底层的变长数组，在速度极其重要的情况下可以用来代替 QVector
	</td>
	</tr>
	<tr>
	<td>
	QStack	</td>
			<td>这个类继承于 QVector，用于为”后进，先出”（LIFO ）提供便捷的语义支持。其为 QVector 添加了以下方法：QVector::push()，pop() 和 top()
	</td>
	</tr>
	<tr>
	<td>
	QQueue</td>
			<td>	这个类继承于 QVector，用于为”先进，先出”（FIFO ）提供便捷的语义支持。其为 QVector 添加了以下方法：QList::enqueue()，dequeue() 和 head()
	</td>
	</tr>
	<tr>
	<td>
	QSet	</td>
			<td>这个类提供了一个单值数学集合，支持快速查找
	</td>
	</tr>
	<tr>
	<td>
	QMap<Key, T>	</td>
			<td>这个类提供了一个将类型为Key的键映射到类型为T的值的字典（关联数组）。通常情况下键值是一一对应的。QMap 根据Key进行排序，如果排序无关紧要，使用 QHash 代替速度会更快
	</td>
	</tr>
	<tr>
	<td>
	QMultiMap<Key, T>	</td>
			<td>这个类继承于 QMap，其为诸如键值一对多的多值映射提供了一个友好的接口
	</td>
	</tr>
	<tr>
	<td>
	QHash<Key, T></td>
			<td>	这个类几乎与 QMap 有完全一致的 API ，但查找效率会有明显的提高。QHash 的数据是无序的。
	</td>
	</tr>
	<tr>
	<td>
	QMultiHash</td>
			<td>	这个类继承于 QMap，其为多值映射提供了一个友好的接口
	</td>
	</tr>
	</table>

- 保存在容器内的值的类型限制
	- 通用限制：
		- 保存在各个容器中的值类型可以是任意 可复制数据类型。
		- 为了满足这一要求，该类型必须提供一个 复制构造函数 和一个 赋值运算符。
		- 某些操作可能还要求类型支持默认构造函数。
		- 对于大多数你想要在容器中保存的类型都满足这些要求，包括基本类型，如 int， double，指针类型，以及 Qt 数据类型，如 QString，QDate 和 QTime
		- 但并不包括 QObject 及其子类（QWidget，QDialog，QTimer 等）。
			- 如果你尝试实例化一个 QList<QWidget>，编译器将会抱怨道 QWidget 的复制构造函数和赋值运算符被禁用了。
			- 如果需要在容器中保存这些类型的元素，可以 保存其指针，如 QList<QWidget *>。
	- 个别容器 独有的限制：
		- 一些容器对它们所能保存的数据类型有额外的要求。
			- 如：QMap<Key, T> 的键类型 Key 必须提供 operator<() 方法。
		- 这些特殊要求在类的详细描述中有说明。在某些情况下，特定函数会有特定的要求，这在函数的描述中有说明。如果条件不满足，编译器将总是会报错。
		- Qt容器 提供了 operator<<() 和 operator>>()，因此这些类可以很方便地通过 QDataStream 进行读写。
		- 这意味着存储在容器中的元素类型也必须支持 operator<<() 和 operator>>()
#### 迭代器类
- Qt 容器类提供了两种风格迭代器：
	- Java 风格迭代器 和 STL 风格迭代器。
	- 注意：两种迭代器均会在容器中的数据 被修改 或 因调用非 const 成员函数，导致数据从 隐式共享 中分离后失效。
- Java 风格迭代器
	- 两种方法
		- 对于每一个容器类，同时提供了两种数据类型的 Java 风格迭代器：一种支持只读访问，另一种支持读写访问。
			<table>
				<tr>
					<th>容器</th>
					<th>只读迭代器</th>
					<th>读写迭代器</th>
				</tr>
				<tr>
				<td>	
				QList, QQueue </td><td>	QListIterator</td><td>	QMutableListIterator
				</td>
				</tr>
				<tr>
				<td>	
				QLinkedList	</td><td>QLinkedListIterator	</td><td>QMutableLinkedListIterator
				</td>
				</tr>
				<tr>
				<td>	
				QVector, QStack</td><td>	QVectorIterator	</td><td>QMutableVectorIterator
				</td>
				</tr>
				<tr>
				<td>	
				QSet	</td><td>QSetIterator	</td><td>QMutableSetIterator
				</td>
				</tr>
				<tr>
				<td>	
				QMap<Key, T>, QMultiMap<Key, T>	</td><td>QMapIterator<Key, T>	</td><td>QMutableMapIterator<Key, T>
				</td>
				</tr>
				<tr>
				<td>	
				QHash<Key, T>, QMultiHash<Key, T>	</td><td>QHashIterator<Key, T>	</td><td>QMutableHashIterator<Key, T>
				</td>
				</tr>	
			</table>
	- 与 STL 风格迭代器不同
		- Java 风格迭代器 指向 的是元素 间隙 而不是元素本身。
		- Java 风格迭代器：对 remove() 方法的调用 不会导致迭代器的失效
- STL 风格迭代器(比 Java 风格快)
	- 两种方法：
		- 对于每一个容器类，同时提供了两种类型的 STL 风格迭代器：一种支持只读访问，另一种支持读写访问。
			<table>
				<tr>
					<th>容器</th>
					<th>只读迭代器</th>
					<th>读写迭代器</th>
				</tr>
				<tr>
				<td>	
				QList, QQueue	</td><td>QList::const_iterator</td><td>	QList::iterator
				</td>
				</tr>
				<tr>
				<td>	
				QLinkedList</td><td>	QLinkedList::const_iterator</td><td>	QLinkedList::iterator
				</td>
				</tr>
				<tr>
				<td>	
				QVector, QStack</td><td>	QVector::const_iterator	</td><td>QVector::iterator
				</td>
				</tr>
				<tr>
				<td>	
				QSet</td><td>	QSet::const_iterator</td><td>	QSet::iterator
				</td>
				</tr>
				<tr>
				<td>	
				QMap<Key, T>, QMultiMap<Key, T>	</td><td>QMap<Key, T>::const_iterator	</td><td>QMap<Key, T>::iterator
				</td>
				</tr>
				<tr>
				<td>	
				QHash<Key, T>, QMultiHash<Key, T>	</td><td>QHash<Key, T>::const_iterator	</td><td>QHash<Key, T>::iterator
				</td>
				</tr>
		</table>
	- Java 风格迭代器不同
		- STL 风格迭代器 直接指向元素本身
		- 容器的 begin() 方法会返回一个指向容器第一个元素的迭代器，end() 方法返回的迭代器指向一个虚拟的元素，该元素位于容器最后一个元素的下一个位置。
		- end() 标记了一个非法的位置，永远不要对其解引用。其通常被用作循环的结束条件。
		- 对于空列表，begin() 和 end() 是相等的，因此我们永远不会执行循环。
#### 隐式共享
- 优势：
	- 正是因为隐式共享，调用一个返回容器的函数的开销不会很大 (容器间拷贝)。
	- Qt API 中包含几十个返回值为 QList 或 QStringList 的函数（例如 QSplitter::sizes() ）。
	- 如果需要通过 STL 迭代器遍历这些返回值，你应当总是将返回的容器复制一份然后迭代其副本。

			// 正确
			const QList<int> sizes = splitter->sizes();
			QList<int>::const_iterator i;
			for (i = sizes.begin(); i != sizes.end(); ++i)
			    ...
			 
			// 错误
			QList<int>::const_iterator i;
			for (i = splitter->sizes().begin();
			        i != splitter->sizes().end(); ++i)
			    ...
	如果函数返回的是一个容器的常量或非常量引用，那么是不存在这个问题的。

- 劣势 - 可能出现错误
	- 隐式共享给 STL 风格迭代器带来了另一个后果是：
		- 当一个容器的迭代器 在使用时 你应当避免复制该容器。
		- 迭代器指向了一个内部结构，当你复制容器时你需要特别小心的处理迭代器。