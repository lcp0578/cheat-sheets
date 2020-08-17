## osgconv & obj2gltf
> osgconv is utility program for reading in 3d databases, apply basic operations to them, then saving out as a single 3d database.
> http://www.openscenegraph.org/index.php/documentation/user-guides/55-osgconv

- 示例：
    Convert cow.obj to equivilant IVE format file:

        osgconv cow.obj cow.ive
        osgconv demo.flt demo.ive
    Convert cow.obj to equivilant IVE format file and compress and automatically generate mipmapped textures:

        osgconv --compressed cow.obj cow.ive

- cesium官方提供了obj转gltf文件的工具，一个obj2gltf的库
	- 地址为https://github.com/AnalyticalGraphicsInc/obj2gltf
	- 下载后在命令行使用npm安装obj2gltf

			npm install --save obj2gltf
	- 执行下列语句即可成功转换,-i表示输入文件，-o表示输出文件

 			node bin\obj2gltf.js -i ./specs/data/box/box.obj -o box.gltf