## typedef  struct
- 示例

		typedef struct tagMyStruct
		{ 
		　int iNum;
		　long lLength;
		} MyStruct;
- 这语句实际上完成两个操作：
	- 1) 定义一个新的结构类型

			struct tagMyStruct
			{ 
			　int iNum; 
			　long lLength; 
			};
	- 2) typedef为这个新的结构起了一个名字，叫MyStruct。

			typedef struct tagMyStruct MyStruct;