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

	   @require("php/util.php");
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
        			<li><a href="aggiungiRequisito.php">Aggiungi Requisito</a></li>
        			<li><a href="latex.php">Latex</a></li>
      			</ul>
    		</div>
  		</div>
	</nav>

	<div class="container-fluid">  
		<h1>I requisiti</h1>
		<p>Segue l'elenco dei requisiti presenti nel database. Per modificarne o eliminarne uno, cliccare sul relativo simbolo della chiave inglese.</p>
		<hr />
		<div id="search">
			<form class="form-inline" role="form" >
    			
    			<div class="form-group">
      				<label for="Sistema">Sistema:</label>
      				<select class="form-control" id="Sistema" name="Sistema">
      					<option value="Sistema">Tutti</option>
        				<option value="'S'">Smartwatch</option>
       	 				<option value="'C'">Cloud</option>
  					</select>	
    			</div>
    			<div class="form-group">
      				<label for="Importanza">Importanza:</label>
      				<select class="form-control" id="Importanza" name="Importanza">
      					<option value="Importanza">Tutti</option>
        				<option value="'0'">Obbligatori</option>
       	 				<option value="'1'">Desiderabili</option>
       	 				<option value="'2'">Opzionali</option>
  					</select>	
    			</div>
    			<div class="form-group">
      				<label for="Tipo">Tipo:</label>
      				<select class="form-control" id="Tipo" name="Tipo">
      					<option value="Tipo">Tutti</option>
      					<option value="'F'">Funzionali</option>
        				<option value="'Q'">Qualità</option>
       	 				<option value="'P'">Prestazionali</option>
       	 				<option value="'V'">Vincolo</option>
  					</select>	
    			</div>
    			<button type="submit" class="btn btn-success" formmethod="post" formaction="index.php">OK</button>
  			</form>
  		</div>

  		<hr />

		<?php
			$con = dbconnect();

			echo $_GET['Sistema'];

			$sistema = isset($_GET['Sistema'])? $_GET['Sistema']:'Sistema';
			$importanza = isset($_GET['Importanza'])? $_GET['Importanza']:'Importanza';
			$tipo = isset($_GET['Tipo'])? $_GET['Tipo']:'Tipo';
			$query = "SELECT NomeReq, CodiceReq, Sistema, Importanza, Tipo, Descrizione, Soddisfatto
					  FROM Requisiti
					  WHERE Sistema = " . $sistema . " AND
					  		Importanza = " . $importanza . " AND
					  		Tipo = " . $tipo . ";";
			echo $query;
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