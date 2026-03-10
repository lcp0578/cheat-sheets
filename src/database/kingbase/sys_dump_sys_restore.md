## `sys_dump` 与 `sys_restore`
- 恢复`.dmp`数据

		sys_restore -h 127.0.0.1  -p 54323 -U SYSTEM -W -d infra_facility  -Fc .\infra_facility_all_bck_DB_2023-09-16_16_20_09.dmp
		"D:\Program Files\Kingbase\ES\V8R3\Server\bin\sys_restore.exe" -h 127.0.0.1  -p 54323 -U SYSTEM -Wlcp0578 -d infra_facility  -Fc .\infra_facility_all_bck_DB_2023-09-16_16_20_09.dmp