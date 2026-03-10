## 使用arcpy进行投影转换
- 切到类似目录
	- C:\Python27\ArcGIS10.8
- 执行`./python.exe project.py`

		# project.py
		import os
		import arcpy
		 
		arcpy.env.workspace = 'D:/data/'
		
		if __name__ ==  "__main__":
		    raster = './data/dem.tif'
		    out_raster = './data/out_dem.tif'
		    projecttype = 'PROJCS["CGCS2000_3_Degree_GK_CM_120E",GEOGCS["GCS_China_Geodetic_Coordinate_System_2000",DATUM["D_China_2000",SPHEROID["CGCS2000",6378137.0,298.257222101]],PRIMEM["Greenwich",0.0],UNIT["Degree",0.0174532925199433]],PROJECTION["Gauss_Kruger"],PARAMETER["False_Easting",500000.0],PARAMETER["False_Northing",0.0],PARAMETER["Central_Meridian",120.0],PARAMETER["Scale_Factor",1.0],PARAMETER["Latitude_Of_Origin",0.0],UNIT["Meter",1.0]]'
		    arcpy.ProjectRaster_management(raster,out_raster, projecttype, "NEAREST","#" , "#", "#","#")