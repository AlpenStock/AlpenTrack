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
	<?php @require("php/util.php");
	   @require("php/dbconn.php");
	?> 
	<nav class="navbar navbar-inverse">
  		<div class="container-fluid">
    		<div class="navbar-header">
      			<a class="navbar-brand">AlpenTrack</a>
    		</div>
    		<div>
      			<ul class="nav navbar-nav navbar-right">
        			<li class="active"><a>Elenco Requisiti</a></li>
        			<li><a href="aggiungiRequisito.html">Aggiungi Requisito</a></li>
      			</ul>
    		</div>
  		</div>
	</nav>

	<div class="container-fluid">  
		<h1>I requisiti</h1>
		<p>Segue l'elenco dei requisiti presenti nel database. Per modificarne o eliminarne uno, cliccare sul relativo simbolo della chiave inglese.</p>
		<?php
			$con = dbconnect();
			$query = "SELECT NomeReq, CodiceReq, Sistema, Importanza, Tipo, Descrizione, Soddisfatto
					  FROM Requisiti";
			$results = mysqli_query($con, $query);

			if (empty($results))
				echo "<p>La ricerca non ha trovato requisiti</p>";
			else
				printTable($con, $results);

			mysqli_close($con);
		?>

	</div>

	</body>
</html>