## nohup
- 舍弃标准输出，将错误输出到nohup.out文件中

		nohup node bin/www >/dev/null 2>nohup.out &
- 错误信息也舍弃

		nohup node ./data_center >/dev/null 2>&1 &
- 0、1和2分别表示标准输入、标准输出和标准错误信息输出，可以用来指定需要重定向的标准输入或输出。
- 日志重定向

		nohup ./data_center  > /home/data/golog/data_center.log &
- https://www.cyberciti.biz/tips/nohup-execute-commands-after-you-exit-from-a-shell-prompt.html