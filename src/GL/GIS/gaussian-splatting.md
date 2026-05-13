## gaussian-splatting: 3D Gaussian Splatting for Real-Time Radiance Field Rendering (Graphdeco 3DGS)

- https://github.com/graphdeco-inria/gaussian-splatting

- 安装 Graphdeco 3DGS

  进入安装目录：

  ```bash
  git clone https://github.com/graphdeco-inria/gaussian-splatting --recursive
  cd gaussian-splatting
  ```

  创建 Conda 环境：

  ```bash
  conda env create --file environment.yml
  conda activate gaussian_splatting
  ```

  确认 Python 和 CUDA 可用：

  ```bash
  python -c "import torch; print(torch.__version__); 	print(torch.cuda.is_available()); print(torch.cuda.get_device_name(0))"
  ```

    ```
    (gaussian_splatting) root@jichenggpu:/home/data/gaussian-splatting# python -c "import torch; print(torch.__version__); print(torch.cuda.is_available()); print(torch.cuda.get_device_name(0))"
    1.13.1+cu116
    True
    NVIDIA GeForce RTX 3090
    ```

