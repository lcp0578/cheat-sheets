## preg_match VS preg_match_all

	$html = '<html><title>This is title </title><body><p>aaa</p><p>bbb</p><p>ccc</p></body></html>';
	if(preg_match('/<title>(.*)<\/title>/', $html, $match)){
		print_r($match);
	}
	
	$html = '<html><title>This is title </title><body><p>aaa</p><p>bbb</p><p>ccc</p></body></html>';
	if(preg_match_all('/<p>(.*)<\/p>/', $html, $matchAll)){
		print_r($matchAll);
	}
	if(preg_match_all('/<p>(.*)<\/p>/U', $html, $matchAllU)){
		print_r($matchAllU);
	}

	//output
	Array
	(
	    [0] => <title>This is title </title>
	    [1] => This is title 
	)
	Array
	(
	    [0] => Array
	        (
	            [0] => <p>aaa</p><p>bbb</p><p>ccc</p>
	        )
	
	    [1] => Array
	        (
	            [0] => aaa</p><p>bbb</p><p>ccc
	        )
	
	)
	Array
	(
	    [0] => Array
	        (
	            [0] => <p>aaa</p>
	            [1] => <p>bbb</p>
	            [2] => <p>ccc</p>
	        )
	
	    [1] => Array
	        (
	            [0] => aaa
	            [1] => bbb
	            [2] => ccc
	        )
	
	)
