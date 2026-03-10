## CMake语法规则
- 基础部分
	- 运行命令
	
    		command(arg1 arg2 ...)
	- 定义变量，或给已存在的变量赋值

			set(var_name var_value)
	- 使用变量

			command(arg1 ${var_name}
- 工程配置部分
	- CMake最低版本号要求
	
    		cmake_minimun_required(VERSION 3.0)
    - 项目名称
    
    		project(project_name)
    - 设定编译器版本，如 -std=c++11
    
    		set(CMAKE_CXX_FLAGS "XXX")
    - 设定编译模式，如Debug/Release
    
    		set(CMAKE_BUILD_TYPE "XXX")
- 依赖执行部分
	- 引入外部依赖
	
    		find_package(std_lib VERSION REQUIRE)
    - 生成库类型（动态、静态）
    
    		add_library(<name> [lib_type] source1)
    - 指定include路径，放在add_executable前面
    
    		include_directories(${std_lib_name_INCLUDE_DIRS})
    - 指定生成目标
    
    		add_executable(project_name XXX.cpp)
    - 指定libraries路径，放在add_executabl后面
    
    		target_link_libraries(${std_lib_name_LIBRARIES})
- 其他辅助部分
	- 定义一个函数
	
    		function(function_name arg)
    - 添加一个子目录
    
    		add_subdirectory(dir)
    - 查找当前目录所有文件，并保存到SRC_LIST变量中
    
    		AUX_SOURCE_DIRECTORY(. SRC_LIST)
    - 使用message进行打印
    
    		FOREACH(one_dir ${SRC_LIST})
            	MESSAGE($(one_dir))
            ENDFOREACH()