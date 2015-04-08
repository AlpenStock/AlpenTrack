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
        				<li><a href="index.php">Elenco Requisiti</a></li>
	        			<li><a href="elencoComponenti.php">Elenco Componenti</a></li>
    	    			<li><a href="elencoTest.php">Elenco Test</a></li>
        				<li><a href="aggiungiRequisito.php">Aggiungi Requisito</a></li>
        				<li><a href="aggiungiComponente.php">Aggiungi Componente</a></li>
        				<li class="active"><a>Aggiungi Test</a></li>
        				<li><a href="latex.php">Latex</a></li>
      				</ul>
    			</div>
  			</div>
		</nav>

		<div class="container">
			<h1>Aggiungi test <small>Crea il test &gt; Collega i moduli &gt; Inserimento nel database</small></h1>
			<?php
				$con = dbconnect();


				//Inizia transazione
				$esito = mysqli_begin_transaction($con);

				//Creazione test
				
				if ($esito == false) {
					insertError($con, "Errore nell'avvio della transazione");
					exit;
				}

				$query = 'INSERT INTO Test(CodTest, DescrizioneTest, Pass) VALUES ("'.$_POST["CodTest"].'", "'.$_POST["DescrizioneTest"].'", "'.$_POST["Pass"].');';
				$esito = mysqli_query($con, $query);

				if ($esito == false) {
					insertError($con, "Errore nell'inserimento del requisito");
					exit;
				}

				//Collegamento Test-Componenti
				$queryF = "";
				$query = 'INSERT INTO TestComp(CodTest, NomeComp) VALUES ';
				$element = '("' . $_POST["CodTest"] . '", ';
				$c = 1;
				foreach ($_POST["NomeComp"] as $value) {
					if ($c == count($_POST["NomeComp"]))
						$query = $query . $element . '"' . $value . '");';
					else
						$query = $query . $element . '"' . $value . '"),';
					$c++;
				}

				$esito = mysqli_query($con, $query); 
				if ($esito == false) {
					insertError($con, "Errore nel collegamento test-componenti");
					exit;
				}	

				//Se sono qui è andato tutto bene
				mysqli_commit($con);
				mysqli_close($con);
			?>
			
			<div class="alert alert-success">Il test è stato inserito correttamente!</div>
		</div>
	</body>
</html>