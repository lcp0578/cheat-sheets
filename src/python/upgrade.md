## CentOS 6 升级Python 2.6到3.6
- 升级到 3.6
	- 查看版本
	
    		$ python -V
    - 安装python 3.6
    
    		$ wget https://www.python.org/ftp/python/3.6.1/Python-3.6.1.tar.xz 
            $ tar xvf Python-3.6.1.tar.xz
			$ cd ./Python-3.6.1 
            $ mkdir /usr/local/python3
			$ ./configure --prefix=/usr/local/python3
			$ make && make install
            //备份旧版本
            $ mv /usr/bin/python /usr/bin/python_old
            // 建立软链接
            $ ln -s /usr/local/python3/bin/python3 /usr/bin/python
            $ python -V
- 解决yum异常
	- yum报错
	
            $ yum search
            File "/usr/bin/yum", line 30
                except KeyboardInterrupt, e:
                                        ^
            SyntaxError: invalid syntax
    - 修改`/usr/bin/yum`
    
    		 vi /usr/bin/yum
			#!/usr/bin/python    改成：    #!/usr/bin/python_old
- pip报错
	- pip install报错
	
    		pip install pymysql
            Traceback (most recent call last):
              File "/usr/local/python3/lib/python3.6/site-packages/pkg_resources/__init__.py", line 659, in _build_master
                ws.require(__requires__)
              File "/usr/local/python3/lib/python3.6/site-packages/pkg_resources/__init__.py", line 967, in require
                needed = self.resolve(parse_requirements(requirements))
              File "/usr/local/python3/lib/python3.6/site-packages/pkg_resources/__init__.py", line 858, in resolve
                raise VersionConflict(dist, req).with_context(dependent_req)
            pkg_resources.VersionConflict: (pip 19.1.1 (/usr/local/python3/lib/python3.6/site-packages), Requirement.parse('pip==7.1.0'))

            During handling of the above exception, another exception occurred:

            Traceback (most recent call last):
              File "/usr/bin/pip", line 5, in <module>
                from pkg_resources import load_entry_point
	- 修改pip命令
	
    		$ ln -s /usr/local/python3/bin/pip3 /usr/bin/pip