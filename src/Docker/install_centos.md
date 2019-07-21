## 在CentOS上安装Docker CE
- OS requirements 系统要求
	- To install Docker CE, you need a maintained version of CentOS 7. Archived versions aren’t supported or tested.
	- The `centos-extras` repository must be enabled. This repository is enabled by default, but if you have disabled it, you need to re-enable it.
	- The `overlay2` storage driver is recommended.
- Install using the repository 使用仓库安装
	- SET UP THE REPOSITORY 配置仓库
		- Install required packages. 安装依赖包
		
        		# yum install -y yum-utils device-mapper-persistent-data lvm2
        - Use the following command to set up the stable repository.
        
        		# yum-config-manager --add-repo https://download.docker.com/linux/centos/docker-ce.repo
	- INSTALL DOCKER CE
		- Install the latest version of Docker CE and containerd 安装最新版本
		
        		# yum install docker-ce docker-ce-cli containerd.io
        - To install a specific version of Docker CE, list the available versions in the repo, then select and install 安装指定版本
        	- 查看版本列表
        	
            		# yum list docker-ce --showduplicates | sort -r
			- install specific version
			
            		# sudo yum install docker-ce-<VERSION_STRING> docker-ce-cli-<VERSION_STRING> containerd.io
		- Docker is installed but not started. The `docker` group is created, but no users are added to the group.
	- Start Docker.

			# sudo systemctl start docker
    - Verify that Docker CE is installed correctly by running the hello-world image.

			#  docker run hello-world
            Unable to find image 'hello-world:latest' locally
            latest: Pulling from library/hello-world
            1b930d010525: Pull complete 
            Digest: sha256:6540fc08ee6e6b7b63468dc3317e3303aae178cb8a45ed3123180328bcc1d20f
            Status: Downloaded newer image for hello-world:latest

            Hello from Docker!
            This message shows that your installation appears to be working correctly.

            To generate this message, Docker took the following steps:
             1. The Docker client contacted the Docker daemon.
             2. The Docker daemon pulled the "hello-world" image from the Docker Hub.
                (amd64)
             3. The Docker daemon created a new container from that image which runs the
                executable that produces the output you are currently reading.
             4. The Docker daemon streamed that output to the Docker client, which sent it
                to your terminal.

            To try something more ambitious, you can run an Ubuntu container with:
             $ docker run -it ubuntu bash

            Share images, automate workflows, and more with a free Docker ID:
             https://hub.docker.com/

            For more examples and ideas, visit:
             https://docs.docker.com/get-started/
