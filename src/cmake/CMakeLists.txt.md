## CMakeLists.txt配置文件

- 1.cmake verson，指定cmake版本 

        cmake_minimum_required(VERSION 3.5)
        add_compile_options(-std=c++11)
 
- 2.project name，指定项目的名称，一般和项目的文件夹名称对应

		PROJECT(TcpTool)
 
- 3.head file path，头文件目录

        INCLUDE_DIRECTORIES(
        include
        )
 
- 4.source directory，源文件目录

		AUX_SOURCE_DIRECTORY(src DIR_SRCS)
 
- 5.set environment variable，设置环境变量，编译用到的源文件全部都要放到这里，否则编译能够通过，但是执行的时候会出现各种问题，比如"symbol lookup error xxxxx , undefined symbol"

        SET(TEST_MATH
        ${DIR_SRCS}
        )
 
- 6.set output directory target file，设置库和可执行文件的输出文件
        SET(CMAKE_RUNTIME_OUTPUT_DIRECTORY ${CMAKE_BINARY_DIR}/bin)
        SET(CMAKE_LIBRARY_OUTPUT_DIRECTORY ${CMAKE_BINARY_DIR}/lib)
        SET(CMAKE_ARCHIVE_OUTPUT_DIRECTORY ${CMAKE_BINARY_DIR}/lib)
 
- 7.add executable file，添加要编译的可执行文件

		ADD_EXECUTABLE(${PROJECT_NAME} ${TEST_MATH})
 
- 8.add link library，添加可执行文件所需要的库，比如我们用到了libm.so（命名规则：lib+name+.so），就添加该库的名称

		TARGET_LINK_LIBRARIES(${PROJECT_NAME} m)
 
        #install(TARGETS ${PROJECT_NAME} DESTINATION bin)
        #add_executable(demo demo.cpp) # 生成可执行文件
        #add_library(common STATIC util.cpp) # 生成静态库
        #add_library(common SHARED util.cpp) # 生成动态库或共享库
- 常用语句
	- `add_definitions()` # 相当于visual studio项目属性中C/C++-预处理器-预处理器定义
	- `include_directories()` # 相当于visual studio项目属性中C/C++-常规-附加包含目录
	- `link_directories()` # 相当于visual studio项目属性中链接器-常规-附加库目录
	- `link_libraries()` # 相当于visual studio项目属性中链接器-输入-附加依赖项
	- `set(A B)` # 定义变量A内容为B
	- `${A}` # ${A}使用变量A,如上面${PROJECT_NAME}
	- `file(GLOB SRC_FILE *.c)` # 定义SRC_FILE为当前目录下后缀为c的文件列表
	- `aux_source_directory(./ SRC_FILES)` # 定义SRC_FILES为当前目录下的所有源文件列表，./ 表示当前目录， ../表示上级目录
	- `message(STATUS ${A})` #输出消息 内容为变量A的值