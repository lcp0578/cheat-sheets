

## osgb 转 3D tiles

- 使用Caddy 走HTTP 2

- 使用https://github.com/fanvanzh/3dtiles 将 osgb转成 3D tiles 1.0的b3dm格式

    ```
    /home/data/3dtiles/target/release/_3dtile -f osgb -i /home/156_share/沁水县河梅河倾斜模型/osgb -o /home/205_share/NVMe_data/qinshui_river/3DTiles_b3dm
    ```

- 使用@cesium/3d-tiles-tools 是 Cesium 官方工具，做 B3DM→GLB 的转换

    ```
    npx @cesium/3d-tiles-tools upgrade --input /home/205_share/NVMe_data/qinshui_river/3DTiles_b3dm --output /home/205_share/NVMe_data/qinshui_river/3DTiles_glb --targetVersion 1.1 
    ```