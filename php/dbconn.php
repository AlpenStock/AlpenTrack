<?php

	function dbconnect(){
		$host="eu-cdbr-west-01.cleardb.com";
		$usr="b7e5116895234e";
		$pwd="834065b2";
		$db="heroku_8abffb77c8b9d93";
		$link = mysqli_connect($host, $usr, $pwd, $db);
		/* check connection */
		if (mysqli_connect_errno()) {
    		printf("Connect failed: %s\n", mysqli_connect_error());
    		exit();
		}
		return $link;
		//$result = mysqli_query($link,$query);
		//return $result;
		//$result andrebbe mysqli_free_result($result);
		//mysqli_close($link);
		//mysqli_fetch_row($result);
	}

?>