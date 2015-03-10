<?php
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Requisiti - AlpenStock </title>
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
	</head>
<body>
	<?php
		if (isset($_SESSION['authenticate']) == false)
			header('location:login.php');
	?>

	<nav class="navbar navbar-inverse">
  		<div class="container-fluid">
    		<div class="navbar-header">
      			<a class="navbar-brand" href="index.php">AlpenTrack</a>
    		</div>
    		<div>
      			<ul class="nav navbar-nav navbar-right">
        			<li><a href="index.php">Elenco Requisiti</a></li>
        			<li><a href="aggiungiRequisito.php">Aggiungi Requisito</a></li>
        			<li class="active"><a>Latex</a></li>
      			</ul>
    		</div>
  		</div>
	</nav>

	<div class="container">
		<div class="jumbotron">
			<h1>Generazione delle tabelle in Latex</h1>
			<p>Da questa pagina è possibile scaricare le tabelle in Latex prodotte dal database. Per avviare il download, cliccare sul pulsante verde.</p>
			<a href="latexgen.php"><button type="submit" class="btn btn-success btn-lg">
	        	<span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> Genera e scarica le tabelle Latex
			</button></a>
		</div>
	</div>

</body>
</html>