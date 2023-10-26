## git push 上传大文件卡住
- Total 564 (delta 6), reused 0 (delta 0), pack-reused 0
	- 修改配置

			git config --global sendpack.sideband false
			git config --local sendpack.sideband false
			git config --global http.postBuffer 524288000
			git config --global https.postbuffer 524288000