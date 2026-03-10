## Mobile Image Upload
- 使用的插件[ajax-upload-image.mobile](https://github.com/lcp0578/ajax-upload-image.mobile)
- 服务端处理  
	PHP pure

		$uploaddir = 'file/upload/'.date('Ym/d/');
		is_dir(DT_ROOT.'/'.$uploaddir) or dir_create(DT_ROOT.'/'.$uploaddir);
		$filename = time().'_'.uniqid().'.png';
		file_put_contents('../'.$uploaddir.$filename, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', file_get_contents("php://input"))));
		
		die(json_encode(['picUrl' => DT_PATH.$uploaddir.$filename]));

	symfony
	
		public function uploadAction(Request $request)
	    {
	        /**
	         * 
	         * @var \Symfony\Component\Filesystem\Filesystem $filesystem
	         */
	        $filesystem = $this->get('filesystem');
	        $uploadsDir = 'uploads/' . date('Ym/d');
	        $filesystem->mkdir($uploadsDir);
	        $filename = time().'_'.uniqid().'.png';
	        file_put_contents($uploadsDir.$filename, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', file_get_contents("php://input"))));
	        return $this->json([
	            'picUrl' => 'http://' . $request->getHost(). '/' .$uploadsDir.$filename
	        ]);
	    }