## plupload 批量上传插件
官网 [plupload.com](http://www.plupload.com)

	$(document).ready(function()
	{
	    $("#fileupload").pluploadQueue(
	    {
	    	runtimes : 'html5,flash,silverlight,html4',
	        url: "{{ oneup_uploader_endpoint('gallery') }}",
	        // Maximum file size
	        max_file_size : '2mb',
	        // User can upload no more then 20 files in one go (sets multiple_queues to false)
			max_file_count: 2,
	        chunk_size: '1mb',
	 
	        // Resize images on clientside if we can
	        resize : {
	            width : 320,
	            height : 640,
	            quality : 90,
	            crop: true // crop to exact dimensions
	        },
	 
	        // Specify what files to browse for
	        filters : [
	            {title : "Image files", extensions : "jpg,gif,png"},
	            {title : "Zip files", extensions : "zip,avi,mp4"}
	        ],
	 
	        // Rename files by clicking on their titles
	        rename: true,
	         
	        // Sort files
	        sortable: true,
	 
	        // Enable ability to drag'n'drop files onto the widget (currently only HTML5 supports that)
	        dragdrop: true,
	 
	        // Views to activate
	        views: {
	            list: true,
	            thumbs: true, // Show thumbs
	            active: 'thumbs'
	        },
	        // Flash settings
	        flash_swf_url : "{{ asset('public/plupload/js/Moxie.swf') }}",
	     
	        // Silverlight settings
	        silverlight_xap_url : "{{ asset('public/plupload/js/Moxie.xap') }}"
	    });
	
	    var uploader = $("#fileupload").pluploadQueue();
	
	    uploader.bind('FileUploaded', function(upldr, file, object) {
	        var jsonStr = object.response;
	        var jsonObj = $.parseJSON(jsonStr); 
	        console.log(jsonObj.filename);
	        if(jsonObj.filename.indexOf('.png') > 0 || jsonObj.filename.indexOf('.jpg') > 0 || jsonObj.filename.indexOf('.jpeg') > 0){
	            $('#form_image').val(jsonObj.filename);
	        }else{
	        	$('#form_video').val(jsonObj.filename);
	        }
	    });
	
	    uploader.bind('FilesAdded', function(up, files) {
	        console.log(up.files.length);
	        var maxfiles = 2;
	        if(up.files.length > maxfiles){
	            return false;
	         }
	        if (up.files.length == maxfiles) {
	            $('#uploader_browse').hide("slow"); // provided there is only one #uploader_browse on page
	        }
	    });
	});