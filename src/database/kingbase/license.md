## license 授权文件

- <https://www.kingbase.com.cn/sqwjxz/index.htm>
- 查看license过期时间

```sql
kingbase@ubuntu:/home/main_data/Kingbase/ES/V8R6C9$ ./Server/bin/ksql -p 54369  -U system -d test
Password for user system: 
Type "help" for help.

test=# select get_license_validdays();
 get_license_validdays 
-----------------------
                    90
(1 row)

test=# exit

```

- 授权文件所在位置

```shell
kingbase@ubuntu:/home/main_data/Kingbase/ES/V8R6C9/KESRealPro/V008R006C009B0014$ ll
total 48
drwxrwxr-x 10 kingbase kingbase 4096 Mar 18 09:44 ./
drwxrwxr-x  3 kingbase kingbase 4096 Nov 28 14:22 ../
drwxr-x---  7 kingbase kingbase 4096 Nov 28 14:22 ClientTools/
-rw-------  1 kingbase kingbase  108 Mar 18 09:44 control.so
drwxrwxr-x 10 kingbase kingbase 4096 Nov 28 14:22 doc/
drwxrwxr-x  7 kingbase kingbase 4096 Nov 28 14:22 install/
drwxrwxr-x 17 kingbase kingbase 4096 Nov 28 14:22 Interface/
drwxrwxr-x 16 kingbase kingbase 4096 Nov 28 14:22 KingbaseHA/
-rw-r--r--  1 kingbase kingbase 3596 Mar 18 09:44 license.dat
drwxrwxr-x  6 kingbase kingbase 4096 Nov 28 14:22 Server/
drwxr-xr-x  7 kingbase kingbase 4096 Nov 28 14:22 SupTools/
drwxr-x---  5 kingbase kingbase 4096 Nov 28 14:27 Uninstall/
kingbase@ubuntu:/home/main_data/Kingbase/ES/V8R6C9/KESRealPro/V008R006C009B0014$ 

```

