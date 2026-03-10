## V8R3的sql导入到V8R6需要注意的点
- 默认工作空间修改：`PUBLIC` -> `public`
- 创建表结构修改
	- V8R3

			CREATE TABLE "weather_data_station" (
			    "id" INTEGER NOT NULL,
			    "type" INTEGER NOT NULL,
			    "area_name" CHARACTER VARYING(20 char),
			    "area_code" INTEGER,
			    "level" INTEGER,
			    "station_name" CHARACTER VARYING(30 char),
			    "station_code" CHARACTER VARYING(20 char),
			    "lon" CHARACTER VARYING(12 char),
			    "lat" CHARACTER VARYING(12 char),
			    "value" CHARACTER VARYING(10 char),
			    "three_value" CHARACTER VARYING(10 char),
			    "twelve_value" CHARACTER VARYING(10 char),
			    "twenty_four_value" CHARACTER VARYING(10 char),
			    "seventy_two_value" CHARACTER VARYING(10 char),
			    "max_value" CHARACTER VARYING(10 char),
			    "min_value" CHARACTER VARYING(10 char),
			    "direction" CHARACTER VARYING(10 char),
			    "report_date" CHARACTER VARYING(20 char),
			    "type_zoom" SMALLINT,
			    "create_at" TIMESTAMP WITHOUT TIME ZONE NOT NULL,
			    "update_at" TIMESTAMP WITHOUT TIME ZONE NOT NULL,
			    "create_time" CHARACTER VARYING(19 char) NOT NULL,
			    "update_time" CHARACTER VARYING(19 char) NOT NULL,
			    "source" SMALLINT,
			    "county_name" CHARACTER VARYING(20 char),
			    "county_code" CHARACTER VARYING(12 char) DEFAULT NULL::CHARACTER VARYING
			);
	- V8R6

			CREATE TABLE public.weather_data_station (
			    id INTEGER NOT NULL,
			    type INTEGER NOT NULL,
			    area_name VARCHAR(20),
			    area_code INTEGER,
			    "level" INTEGER,                  
			    station_name VARCHAR(30),
			    station_code VARCHAR(20),
			    lon VARCHAR(12),
			    lat VARCHAR(12),
			    value VARCHAR(10),
			    three_value VARCHAR(10),
			    twelve_value VARCHAR(10),
			    twenty_four_value VARCHAR(10),
			    seventy_two_value VARCHAR(10),
			    max_value VARCHAR(10),
			    min_value VARCHAR(10),
			    direction VARCHAR(10),
			    report_date VARCHAR(20),
			    type_zoom SMALLINT,
			    create_at TIMESTAMP NOT NULL,       
			    update_at TIMESTAMP NOT NULL,
			    create_time VARCHAR(19) NOT NULL,
			    update_time VARCHAR(19) NOT NULL,
			    "source" SMALLINT,                 
			    county_name VARCHAR(20),
			    county_code VARCHAR(12) DEFAULT NULL
			);
- `NEXTVAL()`函数的使用
	- V8R3

			ALTER TABLE ONLY "public"."weather_data_station" ALTER COLUMN "id" SET DEFAULT NEXTVAL('public.weather_data_station_id_SEQ'::REGCLASS);
	- V8R6

			ALTER TABLE ONLY "public"."weather_data_station" ALTER COLUMN "id" SET DEFAULT NEXTVAL('public."weather_data_station_id_SEQ"'::REGCLASS);

- `setval()`函数修改
	- V8R3

			SELECT sys_catalog.setval('"public"."weather_data_station_id_SEQ"', 8330, true);
	- V8R6

			SELECT setval('"public"."weather_data_station_id_SEQ"', 8330, true);