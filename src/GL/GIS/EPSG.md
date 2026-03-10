## EPSG码与常见的我国投影坐标系对应关系
#### 1.EPSG码简介
- EPSG，全称The European Petroleum Survey Group即欧洲石油调查组织。该组织维护了几乎全球各种空间参考系统的数据，并对这些参考系统进行了编码。
- 查询EPSG码、坐标系名称。
	- EPSG.io网站是围绕OGP地理信息委员会维护的官方EPSG数据库建立的。该数据库包括来自各种来源和权威机构的非常详细的大地测量参数。EPSG.io简化了对数千个空间参考系统(SRS)、变换和转换、基准面、椭球面、子午线、单位等精确参数的访问。
	- 该网站还可以导出所查询的参考系统的其他格式描述如WKT。例如，可以从`https://epsg.io/4534`查看WKT格式的`CGCS2000 / 3-degree Gauss-Kruger CM 135E`坐标系统定义。
	- 此外，网站提供了粗略的坐标拾取功能，由maptiler提供服务。

#### 2.常见投影坐标系的EPSG码与中央经线计算
- CGCS2000+高斯克吕格6度带
	- 高斯克吕格投影坐标分为两类，X坐标加500000m的基础上，一类在X坐标前加上带号*1000000，一类不加。例如，

			23263541.74 4987192.76
			263541.74 4987192.76

	- 投影坐标加带号：
		<table>
			<tr>
				<th>EPSG码</th><th>参考坐标系名称</th>
			</tr>
			<tr>
				<td>4491</td><td>CGCS2000 / Gauss-Kruger zone 13</td>
			</tr>
			<tr>
				<td>4501</td><td>CGCS2000 / Gauss-Kruger zone 23</td>
			</tr>
		</table>
	- 投影坐标不加带号：

		<table>
			<tr>
				<th>EPSG码</th><th>参考坐标系名称</th>
			</tr>
			<tr>
				<td>4502</td><td>	CGCS2000 / Gauss-Kruger CM 75E</td>
				<td>4512</td><td>	CGCS2000 / Gauss-Kruger CM 135E</td>
			</tr>
		</table>
	- EPSG码每增加1，中央经线增加6°；因此X坐标加带号的编码范围为4491-4501
	- 不加带号的编码范围为4502-4512。
	- 中央经线计算方法即，Central Meridian = (code-起始带号)*6+75

- CGCS2000+高斯克吕格3度带
	- 由于中国国土的经线范围在75-135之间，因此对我国境内的投影坐标系编号仅涉及该范围。以75E为中央经线的投影带的EPSG码为4513或4534。EPSG码每增加1，中央经线增加3°；

	- 投影坐标加带号：

		<table>
			<tr>
				<th>EPSG码</th><th>参考坐标系名称</th>
			</tr>
			<tr>
				<td>4513</td><td>CGCS2000 / Gauss-Kruger zone 25</td>
			</tr>
			<tr>
				<td>4533</td><td>CGCS2000 / Gauss-Kruger zone 45</td>
			</tr>
		</table>
	- 投影坐标不加带号：

		<table>
			<tr>
				<th>EPSG码</th><th>参考坐标系名称</th>
			</tr>
			<tr>
				<td>4534</td><td>	CGCS2000 / Gauss-Kruger CM 75E</td>
				<td>4554</td><td>	CGCS2000 / Gauss-Kruger CM 135E</td>
			</tr>
		</table>

	- 中央经线计算方法即，Central Meridian = (code-起始带号)*3+75

#### 北半球 WGS 84下的UTM投影
- 通常所说的UTM投影适用于赤道到北纬84°之间的地区。
- UTM投影只有6度带，没有3度带，并且东偏移统一为500000m，不像高斯克吕格投影一样复杂。
- EPSG码范围从32601开始，UTM北半球划分了60个投影带，到32660结束，中央经线也从117W逐步增加到117E。
- 通过EPSG码计算带号的公式为：

		Central Meridian = (code-32601)*6-117
	- 其中计算为负值的表示西经，正值表示东经。