<?php
	function dbconnect(){
		$url=parse_url(getenv("CLEARDB_DATABASE_URL"));
		$host=$url["host"];
		$usr=$url["user"];
		$pwd=$url["pass"];
		$db=substr($url["path"], 1);
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