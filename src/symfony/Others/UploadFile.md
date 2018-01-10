## Upload File

- 图片的ajax上传

		 /**
	     * ajax upload file
	     *
	     * @param Request $request
	     * @return \Symfony\Component\HttpFoundation\JsonResponse
	     */
	    public function uploadAction(Request $request)
	    {
	      
	        /**
	         * @var $image \Symfony\Component\HttpFoundation\File\UploadedFile
	         */
	        $image = $request->files->get('upfile'); // 图片的name
	        if($image instanceof UploadedFile){
	            $name = $image->getClientOriginalName();
	            $size = $image->getSize();
	            $type = $image->guessClientExtension();
	            $result = $this->get('kit.file_uploader')->upload($image, 'image/' . date('Y/m'));
	            if($result['code'] == 1){
                    return $this->json([
                        "originalName" => $name,
                        "name" => $name,
                        "url" => '/'.$result['data'],
                        "size" => $size,
                        "type" => "." . $type,
                        "state" => "SUCCESS"
                    ]);
	            }else{
	                return $this->json([
	                    'state' => 'FAILD'
	                ]);
	            }
	        }else{
	            return $this->json([
	                "originalName" => '',
	                "name" => '',
	                "url" => '',
	                "size" => '',
	                "type" => '',
	                "state" => "图片不能为空"
	            ]);
	        }
	    }
- 表单图片上传
	- 编写图片上传service
	
			namespace KitBaseBundle\Service;

			use Symfony\Component\HttpFoundation\File\UploadedFile;
			
			class FileUploader
			{
			    private $targetDir;
			
			    public function __construct($targetDir)
			    {
			        $this->targetDir = $targetDir;
			    }
			    
			    public function upload(UploadedFile $file, $subDir = '')
			    {
			        $fileName = md5(uniqid()).'.'.$file->guessExtension();
			        $subDir = empty($subDir) ? '' : '/'. $subDir;
			        try {
			            $file->move($this->targetDir . $subDir, $fileName);
			            $file->getPath();
			        }catch (\Exception $e){
			            return [
			                'code' => 0,
			                'data' => $e->getCode() . $e->getMessage()
			            ];
			        }
			        
			        return [
			            'code' => 1,
			            'data' => 'uploads' .$subDir . '/' .$fileName
			        ];
			    }
			    
			}	
	- Entity上配置断言
	
			/**
		     * @var string
		     *
		     * @ORM\Column(name="thumb", type="string", length=255, nullable=true, options={"comment": "配图"})
		     * @Assert\File(
		     *              maxSize = "10M",
		     *              mimeTypes={ "image/png", "image/jpeg", "image/jpg", "image/gif" }, 
		     *              mimeTypesMessage = "图片格式不支持"
		     * )
		     */
		    private $thumb;
	- form builder
	
			>add('thumb', FileType::class, [
                'label' => '标题图片',
                'data_class' => null
            ])
	- 上传处理
	
			$form->handleRequest($request);
	        if ($form->isSubmitted()) {
	            if($form->isValid()){
	                /**
	                 * @var \KitNewsBundle\Entity\News $news 
	                 */
	                $news = $form->getData();
	                if(empty($news->getIntroduction())){
	                    $news->setIntroduction(mb_substr(strip_tags($news->getContent()), 0, 120));
	                }
	                $news->setHits(0);
	                $image = $news->getThumb();
	                if($image instanceof UploadedFile) {
	                    $fileName = $this->get('kit.file_uploader')->upload($image, 'image/' . date('Y/m'));
	                    if($fileName['code'] == 1){
	                        $news->setThumb($fileName['data']);
	                        $em->persist($news);
	                        $em->flush();
	                        return $this->msgResponse(0, '恭喜', '添加成功', 'kit_news_list');
	                    }else{
	                        $errors[] = '文件上传失败';
	                    }
	                }else{
	                    $em->persist($news);
	                    $em->flush();
	                    return $this->msgResponse(0, '恭喜', '添加成功', 'kit_news_list');
	                }
	                
	            }else{
	                $errors = $this->serializeFormErrors($form);
	            }
	        }