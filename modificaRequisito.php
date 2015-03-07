<!DOCTYPE html>
<html>
	<head>
		<title>Modifica - Requisiti - AlpenStock </title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

		<meta charset="utf-8" />	
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- BOOTSTRAP -->
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" />
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<!-- Latest compiled JavaScript -->	
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

		<!-- Include JavaScript for form control -->
		<script type="text/javascript" src="js/validate.js"></script>
	</head>
<body>
	
	<?php
		require "php/dbconn.php";
		require "php/util.php";
		if (isset($_GET['NomeReq'])) {
			$req = $_GET['NomeReq'];
			$con = dbconnect();
		}
		else
			header("location:requisiti.php");
	?>

	<nav class="navbar navbar-inverse">
  		<div class="container-fluid">
    		<div class="navbar-header">
      			<a class="navbar-brand" href="requisiti.php">AlpenTrack</a>
    		</div>
    		<div>
      			<ul class="nav navbar-nav navbar-right">
        			<li class="active"><a href="requisiti.php">Elenco Requisiti</a></li>
        			<li><a href="aggiungiRequisito.html">Aggiungi Requisito</a></li>
        			<li><a href="latex.html">Latex</a></li>
      			</ul>
    		</div>
  		</div>
	</nav>

	<div class="container">
		<h1>Modifica requisito</h1> 
		<p>Dal form seguente è possibile modificare il requisito.</p> 
		<?php printForm($con, $req); ?>
	</div>

	<?php
		mysqli_close($con);
	?>
</body>
</html>