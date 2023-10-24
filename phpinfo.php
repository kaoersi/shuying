<?php 

    ini_set('max_execution_time', '0');
	set_time_limit(0);

	do{
		
		if(0) die('已设置停止');
		//sleep(1);
		//echo date('h:i:s'). "<br>";

		$filepath = __DIR__."/123.txt";
		
        
		$str = date('h:i:s')."\r";

		// echo "用file_put_contents函数写入文件：";

		file_put_contents($filepath,$str,FILE_APPEND);

	}
	while(true);

?>