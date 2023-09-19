## 对数组进行排序
- 排序相关函数
<table>
	<tr>
		<th>函数名称</th><th>	排序依据</th><th>	数组索引键保持</th><th>	排序的顺序</th><th>	相关函数</th>
	</tr>
	<tr>
		<td> array_multisort() </td><td>	值</td><td>	string 键保持不变，int 键重新索引</td><td>	第一个数组或者由选项指定</td><td>	array_walk()</td>
	</tr><tr>
		<td>asort()	</td><td>值	</td><td>是	</td><td>升序</td><td>	arsort()</td>
	</tr><tr>
	</tr><tr>
		<td>arsort()	</td><td>值</td><td>	是</td><td>	降序</td><td>	asort()</td>
	</tr><tr>
	</tr><tr>
		<td>krsort()	</td><td>键</td><td>	是</td><td>	降序</td><td>	ksort()</td>
	</tr><tr>
	</tr><tr>
		<td>ksort()	</td><td>键</td><td>	是</td><td>	升序</td><td>	krsort()</td>
	</tr><tr>
	</tr><tr>
		<td>natcasesort()	</td><td>值	</td><td>是</td><td>	自然排序，大小写不敏感	</td><td>natsort()</td>
	</tr><tr>
	</tr><tr>
		<td>natsort()	</td><td>值</td><td>	是</td><td>	自然排序</td><td>	natcasesort()</td>
	</tr><tr>
	</tr><tr>
		<td>rsort()	</td><td>值</td><td>	否</td><td>	降序</td><td>	sort()</td>
	</tr><tr>
	</tr><tr>
		<td>shuffle()</td><td>	值</td><td>	否</td><td>	随机</td><td>	array_rand()</td>
	</tr><tr>
	</tr><tr>
		<td>sort()	</td><td>值	</td><td>否</td><td>	升序</td><td>	rsort()</td>
	</tr><tr>
	</tr><tr>
		<td>uasort()</td><td>	值	</td><td>是	</td><td>由用户定义</td><td>	uksort()</td>
	</tr><tr>
	</tr><tr>
		<td>uksort()</td><td>	键</td><td>	是</td><td>	由用户定义</td><td>	uasort()</td>
	</tr><tr>
	</tr><tr>
		<td>usort()</td><td>	值</td><td>	否</td><td>	由用户定义</td><td>	uasort()</td>
	</tr><tr>
	</tr>
- https://www.php.net/manual/zh/array.sorting.php