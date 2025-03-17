## GPU 显卡相关操作
- 查看显卡型号

		# lspci | grep -i vga
		01:00.0 VGA compatible controller: NVIDIA Corporation GA102 [GeForce RTX 3090] (rev a1)
		07:00.0 VGA compatible controller: NVIDIA Corporation GA102 [GeForce RTX 3090] (rev a1)

- 安装nvidia工具集

		sudo apt install nvidia-utils-570-server
- 查看显卡信息

		# nvidia-smi //通信失败，修复显卡驱动
		NVIDIA-SMI has failed because it couldn't communicate with the NVIDIA driver. Make sure that the latest NVIDIA driver is installed and running.
- 显卡通信失败解决
	- 查看推荐驱动
	
			# ubuntu-drivers devices
			ERROR:root:aplay command not found
			== /sys/devices/pci0000:00/0000:00:1c.4/0000:07:00.0 ==
			modalias : pci:v000010DEd00002204sv00001458sd00004044bc03sc00i00
			vendor   : NVIDIA Corporation
			model    : GA102 [GeForce RTX 3090]
			driver   : nvidia-driver-535 - distro non-free
			driver   : nvidia-driver-535-server-open - distro non-free
			driver   : nvidia-driver-570-server - distro non-free
			driver   : nvidia-driver-550 - distro non-free recommended
			driver   : nvidia-driver-545 - distro non-free
			driver   : nvidia-driver-470-server - distro non-free
			driver   : nvidia-driver-550-open - distro non-free
			driver   : nvidia-driver-535-server - distro non-free
			driver   : nvidia-driver-470 - distro non-free
			driver   : nvidia-driver-535-open - distro non-free
			driver   : nvidia-driver-570-server-open - distro non-free
			driver   : nvidia-driver-545-open - distro non-free
			driver   : xserver-xorg-video-nouveau - distro free builtin
	- 安装推荐驱动
	
			apt install nvidia-driver-550
	- 禁用Nouveau开源驱动
		- 创建黑名单文件
	
				sudo vim /etc/modprobe.d/blacklist-nouveau.conf
				blacklist nouveau
				options nouveau modeset=0
		- 更新initramfs并重启
	
				sudo update-initramfs -u
				sudo reboot
	- 验证驱动加载情况
		- 检查NVIDIA模块

				lsmod | grep nvidia
		- 检查驱动版本

				# nvidia-smi
				Mon Mar 17 01:41:04 2025       
				+-----------------------------------------------------------------------------------------+
				| NVIDIA-SMI 550.120                Driver Version: 550.120        CUDA Version: 12.4     |
				|-----------------------------------------+------------------------+----------------------+
				| GPU  Name                 Persistence-M | Bus-Id          Disp.A | Volatile Uncorr. ECC |
				| Fan  Temp   Perf          Pwr:Usage/Cap |           Memory-Usage | GPU-Util  Compute M. |
				|                                         |                        |               MIG M. |
				|=========================================+========================+======================|
				|   0  NVIDIA GeForce RTX 3090        Off |   00000000:01:00.0 Off |                  N/A |
				| 68%   53C    P8             10W /  370W |       2MiB /  24576MiB |      0%      Default |
				|                                         |                        |                  N/A |
				+-----------------------------------------+------------------------+----------------------+
				|   1  NVIDIA GeForce RTX 3090        Off |   00000000:07:00.0 Off |                  N/A |
				|  0%   41C    P8             30W /  370W |       2MiB /  24576MiB |      0%      Default |
				|                                         |                        |                  N/A |
				+-----------------------------------------+------------------------+----------------------+
				                                                                                         
				+-----------------------------------------------------------------------------------------+
				| Processes:                                                                              |
				|  GPU   GI   CI        PID   Type   Process name                              GPU Memory |
				|        ID   ID                                                               Usage      |
				|=========================================================================================|
				|  No running processes found                                                             |
				+-----------------------------------------------------------------------------------------+

			- 输入结果说明
				- `GPU`：显卡编号，从0开始。
				- `Fan`：风扇转速，在0~100%之间变动。这个速度是计算机期望的风扇转速，实际情况下如果风扇堵转，可能就不会显示具体转速值。有的设备不会返回转速，因为它不依赖风扇冷却，而是通过其他外设保持低温，比如我们实验室的服务器是常年放在空掉房间里面的。
				- `Name`：显卡名，以上都是Tesla。
				- `Temp`：显卡内部的温度，以上分别是54、49、46、50、39摄氏度。
				- `Perf`：性能状态，从P0到P12，P0性能最大，P12最小 。
				- `Persistence-M`：持续模式的状态开关，持续模式虽然耗能大，但是在新的GPU应用启动时，花费的时间更少。以上都是Off的状态。
				- `Pwr`：能耗表示。
				- `Bus-Id`：涉及GPU总线的相关信息。
				- `Disp.A`：是Display Active的意思，表示GPU的显示是否初始化。
				- `Memory-Usag`e：显存的使用率。
				- `GPU-Util`：GPU的利用率。
				- `Compute M`.：计算模式。
				- 下面的`Process`显示每块GPU上每个进程所使用的显存情况,其中Type可选值：`G`代表图形进程，`C`代表计算进程，`G+C`代表混合进程。
