<?php
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Inserimento DB - Aggiungi - AlpenStock </title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

		<meta charset="utf-8" />	
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link href="css/style.css" rel="stylesheet" type="text/css" />

		<!-- BOOTSTRAP -->
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" />
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<!-- Latest compiled JavaScript -->	
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

		<!-- Include JavaScript -->
		<script type="text/javascript" src="js/util.js"></script>
		<script type="text/javascript" src="js/validate.js"></script>
	</head>
	<body>
		<?php

			if (isset($_SESSION['authenticate']) == false)
			header('location:login.php');

			if ($_POST['Sistema'] == "N")
				$_POST['Sistema'] = "";

			if (empty($_POST['Soddisfatto']))
				$_POST['Soddisfatto'] = "FALSE";

			if (count($_POST) < 5) 
				header("location:requisiti.php");

			require "php/dbconn.php";
			require "php/util.php";
		?>

		<nav class="navbar navbar-inverse">
  			<div class="container-fluid">
    			<div class="navbar-header">
      				<a class="navbar-brand" href="index.php">AlpenTrack</a>
    			</div>
    			<div>
      				<ul class="nav navbar-nav navbar-right">
        				<li class="active"><a href="index.php">Elenco Requisiti</a></li>
        				<li><a href="aggiungiRequisito.php">Aggiungi Requisito</a></li>
        				<li><a href="latex.php">Latex</a></li>
      				</ul>
    			</div>
  			</div>
		</nav>

		<div class="container">
			<?php
				$con = dbconnect();


				//Modifica

				$nuovoNome = "R" . $_POST['Sistema'] . $_POST['Importanza'] . $_POST['Tipo'] . $_POST['CodiceReq'];

				if ($_GET['Op'] == 'mod') {
					$query = 'UPDATE Requisiti 
							  SET NomeReq="'.$nuovoNome.'", CodiceReq="'.$_POST["CodiceReq"].'", Sistema="'.$_POST["Sistema"].'", 
							  	  Importanza="'.$_POST["Importanza"].'", Tipo="'.$_POST["Tipo"].'", Descrizione="'.$_POST["Descrizione"].'", 
							  	  Soddisfatto='.$_POST["Soddisfatto"].' 
							  WHERE NomeReq="'.$_GET["NomeReq"].'";'; 
					$esito = mysqli_query($con, $query);

					if ($esito == false) {
						echo '<div class="alert alert-danger">Si sono riscontrati dei problemi durante la modifica del requisito.</div>';
					}
					else
						echo '<div class="alert alert-success">Il requisito è stato modificato correttamente!</div>';					
				}


				//Eliminazione
				if ($_GET['Op'] == 'delete') {
					$query = 'DELETE FROM Requisiti WHERE NomeReq = "' . $_GET["NomeReq"] . '";'; 
					$esito = mysqli_query($con, $query);

					if ($esito == false) {
						echo '<div class="alert alert-danger">Si sono riscontrati dei problemi durante la rimozione del requisito.</div>';
					}
					else
						echo '<div class="alert alert-success">Il requisito è stato eliminato correttamente!</div>';					
				}

				mysqli_close($con);


				
				
			?>
		</div>
	</body>
</html>