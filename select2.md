## select2
Loading remote data

	$(function(){
		$(".notLayuiSelect").select2({
			  width: '550px',
			  language: 'zh-CN', // 注意选择非默认语言包，需要手动引入
			  placeholder: '请选择XXX',
			  ajax: {
			    url: "ajax-uri",
			    dataType: 'json',
			    delay: 250,
			    data: function (params) {
			      return {
			        q: params.term, // search term
			        page: params.page
			      };
			    },
			    processResults: function (data, params) {
			      // parse the results into the format expected by Select2
			      // since we are using custom formatting functions we do not need to
			      // alter the remote JSON data, except to indicate that infinite
			      // scrolling can be used
			      params.page = params.page || 1;
	
			      return {
			        results: data.items,
			        pagination: {
			          more: (params.page * 30) < data.total_count
			        }
			      };
			    },
			    cache: true
			  },
			  escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
			  minimumInputLength: 1,
			  templateResult: function(repo){
				  return repo.html;
			  }, 
			  templateSelection: function(repo){
				  console.log(repo.id);
				  return repo.id || repo.text; // 注意:repo.text代表的是placeholder的值
			  }
			});
	})

服务端相应：

	{
	    "total_count": 1316350,
	    "incomplete_results": false,
	    "items": [
	        {
	            "id": 1223,  // 返回id键的值，将被设为selected option的值
	            "html": "<div>test</div>"
	        },
	        {
	            "id": 12233,
	            "html": "<div>test2</div>"
	        },
	        {
	            "id": 12234,
	            "html": "<div>test3</div>"
	        },
	        {
	            "id": 12235,
	            "html": "<div>test4</div>"
	        }
	    ]
	}