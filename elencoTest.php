<?php
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Test - AlpenStock </title>
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

	   @require("php/utilTest.php");
	   @require("php/dbconn.php");
	?> 
	<nav class="navbar navbar-inverse">
  		<div class="container-fluid">
    		<div class="navbar-header">
      			<a class="navbar-brand">AlpenTrack</a>
    		</div>
    		<div>
      			<ul class="nav navbar-nav navbar-right">
        			<li><a href="index.php">Elenco Requisiti</a></li>
        			<li><a href="elencoComponenti.php">Elenco Componenti</a></li>
        			<li class="active"><a>Elenco Test</a></li>
        			<li><a href="aggiungiRequisito.php">Aggiungi Requisito</a></li>
        			<li><a href="aggiungiComponente.php">Aggiungi Componente</a></li>
        			<li><a href="aggiungiTest.php">Aggiungi Test</a></li>s
        			<li><a href="latex.php">Latex</a></li>
      			</ul>
    		</div>
  		</div>
	</nav>

	<div class="container-fluid">  
		<h1>I test</h1>
		<p>Segue l'elenco dei test presenti nel database. Per modificarne o eliminarne uno, cliccare sul relativo simbolo della chiave inglese.</p>
		<?php
			$con = dbconnect();
			$query = "SELECT CodTest, DescrizioneTest, Pass 
					  FROM Test
					  ORDER BY CodTest";
			$results = mysqli_query($con, $query);

			if (empty($results))
				echo "<p>La ricerca non ha trovato test</p>";
			else
				printTableTest($con, $results);

			mysqli_close($con);
		?>

	</div>

	</body>
</html>