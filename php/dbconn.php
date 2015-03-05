<?php

	function dbconnect($query=''){
		$host="localhost";
		$usr="alpenstock";
		$pwd="alpenstock";
		$db="alpentrack";
		$link = mysqli_connect($host, $usr, $pwd, $db);
		/* check connection */
		if (mysqli_connect_errno()) {
    		printf("Connect failed: %s\n", mysqli_connect_error());
    		exit();
		}
		$result = mysqli_query($link,$query);
		return $result;
		//$result andrebbe mysqli_free_result($result);
		//mysqli_close($link);
		//mysqli_fetch_row($result);
	}

?>