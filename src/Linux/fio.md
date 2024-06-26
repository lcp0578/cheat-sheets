## fio -- Linux测试磁盘IO性能（随机读写）
#### 一、安装
- 下载并安装

		wget http://brick.kernel.dk/snaps/fio-2.2.5.tar.gz
		yum install libaio-devel gcc  -y
		tar -zxvf fio-2.2.5.tar.gz
		cd fio-2.2.5
		make
		make install

 

#### 二、FIO参数
- 随机读：

		# fio -filename=/tmp/test_randread -direct=1 -iodepth 1 -thread -rw=randread -ioengine=psync -bs=16k -size=30G -numjobs=10 -runtime=60 -group_reporting -name=mytest

	- 说明：

			filename=/dev/sdb1       测试文件名称，通常选择需要测试的盘的data目录。
			direct=1                 测试过程绕过机器自带的buffer。使测试结果更真实。
			rw=randwrite             测试随机写的I/O
			rw=randrw                测试随机写和读的I/O
			bs=16k                   单次io的块文件大小为16k
			bsrange=512-2048         同上，提定数据块的大小范围
			size=5g    本次的测试文件大小为5g，以每次4k的io进行测试。
			numjobs=30               本次的测试线程为30.
			runtime=1000             测试时间为1000秒，如果不写则一直将5g文件分4k每次写完为止。
			ioengine=psync           io引擎使用pync方式
			rwmixwrite=30            在混合读写的模式下，写占30%
			group_reporting          关于显示结果的，汇总每个进程的信息。
			
			此外
			lockmem=1g               只使用1g内存进行测试。
			zero_buffers             用0初始化系统buffer。
 

#### 三、常用测试命令
- 随机读

		# fio -filename=/tmp/test_randread -direct=1 -iodepth 1 -thread -rw=randread -ioengine=psync -bs=16k -size=30G -numjobs=10 -runtime=600 -group_reporting -name=mytest

 

- 随机写

		# fio -filename=/tmp/test_randwrite -direct=1 -iodepth 1 -thread -rw=randwrite -ioengine=psync -bs=16k -size=30G -numjobs=10 -runtime=600 -group_reporting -name=mytest

 

- 顺序写

		# fio -filename=/data/test_randread -direct=1 -iodepth 1 -thread -rw=write -ioengine=psync -bs=16k -size=30G -numjobs=10 -runtime=600 -group_reporting -name=mytest

 

- 顺序读

		# fio -filename=/tmp/test_randread -direct=1 -iodepth 1 -thread -rw=read -ioengine=psync -bs=16k -size=30G -numjobs=10 -runtime=60 -group_reporting -name=mytest

 

- 混合随机读写

		# fio -filename=/tmp/test_randread -direct=1 -iodepth 1 -thread -rw=randrw -rwmixread=70 -ioengine=psync -bs=16k -size=30G -numjobs=10 -runtime=600 -group_reporting -name=mytest -ioscheduler=noop

 

#### 四、读懂结果
- 这里以直接写操作为例。 我们用10个线程，向磁盘写一个30G文件，块大小为16K，时长10分钟。

- 主要关注这部分，写速度为347058KB/s，iops为21691。更多测试结果，可以在底部的红色部分看到，包含平均写速度、最小最大速度等等。

		write: io=20336MB, bw=347058KB/s, iops=21691 , runt= 60001msec

		# fio -filename=/tmp/test_randread  -direct=1 -iodepth 1 -thread -rw=write -ioengine=psync -bs=16k -size=30G -numjobs=10 -runtime=60 -group_reporting -name=mytest  
		mytest: (g=0): rw=write, bs=16K-16K/16K-16K, ioengine=psync, iodepth=1
		...
		mytest: (g=0): rw=write, bs=16K-16K/16K-16K, ioengine=psync, iodepth=1
		fio 2.0.7
		Starting 10 threads
		Jobs: 10 (f=10): [WWWWWWWWWW] [100.0% done] [0K/364.3M /s] [0 /22.3K iops] [eta 00m:00s]
		mytest: (groupid=0, jobs=10): err= 0: pid=74873
		  write: <span style="color: #ff0000;"><strong>io=20336MB, bw=347058KB/s, iops=21</strong>691 ,</span> runt= 60001msec
		    clat (usec): min=28 , max=203809 , avg=459.64, stdev=3726.22
		     lat (usec): min=29 , max=203810 , avg=460.27, stdev=3726.26
		    clat percentiles (usec):
		     |  1.00th=[   30],  5.00th=[   31], 10.00th=[   34], 20.00th=[   35],
		     | 30.00th=[   36], 40.00th=[   37], 50.00th=[   38], 60.00th=[   40],
		     | 70.00th=[   43], 80.00th=[   46], 90.00th=[  620], 95.00th=[ 1144],
		     | 99.00th=[ 8512], 99.50th=[22912], 99.90th=[58624], 99.95th=[75264],
		     | 99.99th=[110080]
		    bw (KB/s)  : min=  265, max=396352, per=10.16%, avg=35260.37, stdev=80519.69
		    lat (usec) : 50=82.89%, 100=6.31%, 250=0.31%, 500=0.02%, 750=1.73%
		    lat (usec) : 1000=2.50%
		    lat (msec) : 2=4.37%, 4=0.57%, 10=0.37%, 20=0.36%, 50=0.42%
		    lat (msec) : 100=0.14%, 250=0.01%
		  cpu          : usr=5.67%, sys=24.37%, ctx=26086439, majf=0, minf=12681
		  IO depths    : 1=100.0%, 2=0.0%, 4=0.0%, 8=0.0%, 16=0.0%, 32=0.0%, >=64=0.0%
		     submit    : 0=0.0%, 4=100.0%, 8=0.0%, 16=0.0%, 32=0.0%, 64=0.0%, >=64=0.0%
		     complete  : 0=0.0%, 4=100.0%, 8=0.0%, 16=0.0%, 32=0.0%, 64=0.0%, >=64=0.0%
		     issued    : total=r=0/w=1301489/d=0, short=r=0/w=0/d=0
		 
		Run status group 0 (all jobs):
		 <strong> <span style="color: #ff0000;">WRITE: io=20336MB, aggrb=347057KB/s, minb=347057KB/s, maxb=347057KB/s, mint=60001msec, maxt=60001msec
		</span></strong>
		Disk stats (read/write):
		  sda: ios=0/1300195, merge=0/12, ticks=0/46837, in_queue=46516, util=77.53%
#### 五、SSD与机械硬盘性能比对
- SSD在随机读写性能方面完爆机械硬盘。而机械硬盘的顺序写性能远优于SSD；不过，SSD和机械硬盘的顺序度性能几乎持平。

