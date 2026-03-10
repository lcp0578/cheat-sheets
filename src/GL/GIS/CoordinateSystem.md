## 坐标系ECEF、WGS-84、东北天坐标系（ENU）
#### ECEF坐标系
- 也叫地心地固直角坐标系。其原点为地球的质心，x轴延伸通过本初子午线（0度经度）和赤道（0deglatitude）的交点。 z轴延伸通过的北极（即，与地球旋转轴重合）。 y轴完成右手坐标系，穿过赤道和90度经度。

#### WGS-84坐标
- 也就是也叫经纬高坐标系(经度(longitude)，纬度(latitude)和高度(altitude)LLA坐标系)。，全球地理坐标系、大地坐标系。可以说是最为广泛应用的一个地球坐标系，它给出一点的大地纬度、大地经度和大地高程而更加直观地告诉我们该点在地球中的位置，故又被称作纬经高坐标系。WGS-84坐标系的X轴指向BIH(国际时间服务机构)1984.0定义的零子午面(Greenwich)和协议地球极(CTP)赤道的交点。Z轴指向CTP方向。Y轴与X、Z轴构成右手坐标系。
- 一句话解释就是：把前面提到的ECEF坐标系用在GPS中，就是WGS-84坐标系。
- 其中：
	-（1）：大地纬度是过用户点P的基准椭球面法线与赤道面的夹角。纬度值在-90°到+90°之间。北半球为正，南半球为负。

	-（2）：大地经度是过用户点P的子午面与本初子午线之间的夹角。经度值在-180°到+180°之间。

	-（3）：大地高度h是过用户点P到基准椭球面的法线距离，基准椭球面以内为负，以外为正
#### 东北天坐标系（ENU）
- 也叫站心坐标系以用户所在位置P为坐标原点。
- 坐标系定义为： X轴：指向东边 Y轴：指向北边 Z轴：指向天顶
- ENU局部坐标系采用三维直角坐标系来描述地球表面，实际应用较为困难，因此一般使用简化后的二维投影坐标系来描述。在众多二维投影坐标系中，统一横轴墨卡托（The Universal Transverse Mercator ，UTM）坐标系是一种应用较为广泛的一种。UTM 坐标系统使用基于网格的方法表示坐标，它将地球分为 60 个经度区，每个区包含6度的经度范围，每个区内的坐标均基于横轴墨卡托投影

#### 参考文档
- https://www.cnblogs.com/long5683/p/13831605.html
- https://blog.csdn.net/qq_59068750/article/details/130959388
- https://blog.csdn.net/qq_41441896/article/details/104525296
- https://blog.csdn.net/ununie/article/details/97375143
- https://blog.csdn.net/dou3516/article/details/105789634
- https://www.cnblogs.com/E7868A/p/11460865.html
- https://blog.csdn.net/qq_41204464/article/details/104543636

#### 常用EPSG编码
- EPSG:32649
	- 坐标系定义和参数如下：
	-  WGS_1984_UTM_Zone_49N
	-  WKID: 32649 Authority: EPSG
	-  Projection: Transverse_Mercator
	-   False_Easting: 500000.0
	-    False_Northing: 0.0
	-  Central_Meridian: 111.0
	-   Scale_Factor: 0.9996
	-    Latitude_Of_Origin: 0.0
	-     Linear Unit: Meter (1.0)
- EPSG:4326
	- 大地坐标系，WGS84

- EPSG:4490
	- 大地坐标系，cgcs2000

- EPSG:3857
	- 投影坐标系，墨卡托投影