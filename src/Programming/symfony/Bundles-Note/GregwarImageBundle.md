## GregwarImageBundle
- usage

		/**
         * 
         * @var \Gregwar\ImageBundle\Services\ImageHandling $handing
         */
        $handing = $this->get('image.handling');
        $handing->open($filepath)->zoomCrop(64, 64)->save($result['data'] . '.thumb.png');