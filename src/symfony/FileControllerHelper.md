## File Controller Helper

	public function downloadAction(Request $request)
    {
        $id = $request->query->getInt('id');
        if(empty($id)){
            return $this->msgResponse(2, '出错啦', '请求出错啦', 'kit_doc_homepage');
        }
        $doc = $this->getDoctrine()->getRepository('KitDocBundle:FileManagement')->find($id);
        if(empty($doc)){
            return $this->msgResponse(2, '出错啦', '文档不存在或已被删除', 'kit_doc_homepage');
        }
        $docPath = 'uploads' . $doc->getDocPath();
        if(!file_exists($docPath)){
            return $this->msgResponse(2, '出错啦', '文件不存在或已被删除', 'kit_doc_homepage');
        }
        return $this->file($docPath, $doc->getDocName()); // 如果是pdf之类，直接显示而不是下载，需要设置第三个参数ResponseHeaderBag::DISPOSITION_INLINE
		// 还可以直接接受一个File或者UploadedFile实例
		//$samplePdf = new File('/sample.pdf');
		//return $this->file($samplePdf);
    }