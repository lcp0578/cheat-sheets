## VS环境变量
- 以美元符号$开头 + 一对括号
- 常用环境变量

	<table>
		<tr>
			<td>$(SolutionDir)</td><td>解决方案目录：即.sln文件所在路径</td></tr>
			<tr><td>$(ProjectDir)</td><td>项目根目录:, 即.vcxproj文件所在路径</td></tr>
			<tr><td>$(Configuration)</td><td>当前的编译配置名称，比如Debug，或Release</td></tr>
			<tr><td>$(ProjectName)</td><td>当前项目名称</td></tr>
			<tr><td>$(SolutionName)</td><td>解决方案名称</td></tr>
			<tr><td>$(OutDir)</td><td>项目输出文件目录</td></tr>
			<tr><td>$(TargetDir)</td><td>项目输出文件目录</td></tr>
			<tr><td>$(TargetName)</td><td>项目生成目标文件, 通常和$(ProjectName)同名, 如Game</td></tr>
			<tr><td>$(TargetExt)</td><td>项目生成文件后缀名，如.exe, .lib具体取决于工程设置</td></tr><tr><td>$(TargetFileName)</td><td>项目输出文件名字。比如Game.exe, 等于 (TargetName)+(TargetExt)</td></tr>
			<tr><td>$(ProjectExt)</td><td>工程文件后缀名，如.vcxproj</td>
		</tr>
	</table>