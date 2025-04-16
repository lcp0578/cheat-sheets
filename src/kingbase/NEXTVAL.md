## NEXTVAL() 使用需要注意使用双引号
- 参数中的序列名未用双引号包裹，导致 Kingbase 按小写解析。

		CREATE SEQUENCE "public"."weather_data_station_id_SEQ"
		    START WITH 1
		    INCREMENT BY 1
		    NO MINVALUE
		    NO MAXVALUE
		    CACHE 1;
		
		
	- 正确的写法

			ALTER TABLE ONLY "public"."weather_data_station" ALTER COLUMN "id" SET DEFAULT NEXTVAL('public."weather_data_station_id_SEQ"'::REGCLASS);
	- 错误的写法

			ALTER TABLE ONLY "public"."weather_data_station" ALTER COLUMN "id" SET DEFAULT NEXTVAL('public.weather_data_station_id_SEQ'::REGCLASS);