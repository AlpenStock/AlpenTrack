<?php
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Fonti - Aggiungi - AlpenStock </title>
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

			if (count($_POST) < 5) 
				header("location:aggiungiRequisito.php");

			require "php/printFonti.php";
			require "php/dbconn.php";


			if ($_POST['Sistema'] == "N")
				$NomeReq = "R" . $_POST['Importanza'] . $_POST['Tipo'] . $_POST['CodiceReq'];
			else
				$NomeReq = "R" . $_POST['Sistema'] . $_POST['Importanza'] . $_POST['Tipo'] . $_POST['CodiceReq'];

			if (empty($_POST['Soddisfatto']))
				$_POST['Soddisfatto'] = "FALSE";
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
        				<li class="active"><a>Aggiungi Requisito</a></li>
        				<li><a href="aggiungiComponente.php">Aggiungi Componente</a></li>
        				<li><a href="aggiungiTest.php">Aggiungi Test</a></li>
        				<li><a href="latex.php">Latex</a></li>
      				</ul>
    			</div>
  			</div>
		</nav>

		<div class="container">
			<h1>Aggiungi requisito <small>Crea il requisito &gt; Collega le fonti</small></h1> 
			<?php
				echo '<p>Specifica le fonti del requisito "' . $NomeReq . '". Un requisito deve avere almeno una fonte.</p>';
				$con = dbconnect();
			?>
			<form role="form" class="form-horizontal" id="formFonti">
				<div class="form-group" id="divFonti">
					<label for="Fonti" class="control-label">
	  					Fonti:
	  				</label>
	  				<select class="form-control" name="Fonti[]" id="Fonti" size="5" onchange="removeError('divFonti');" required multiple>
	  					<?php printFonti($con); ?>
	 				</select>
				</div>
				<div class="form-group">
	  				<button type="button" id="btnAdd" class="btn btn-warning btn-block" onclick="showForm();">
  						La fonti che cerchi non sono presenti? Aggiungile tu!
  					</button>
  				</div>
  				<div id="visibility">
  					<div class="form-group" id="divNomeFonte">
  						<label for="NomeFonte" class="control-label">
  							Nome della fonte:
  						</label>
  						<input type="text" class="form-control" name="NomeFonte" id="NomeFonte" placeholder="es. UC1.2" onchange="removeError('divNomeFonte')" />
  					</div>
  					<div class="form-group">
	  					<label for="DescrizioneFonte" class="control-label">
  							Descrizione della fonte:
  						</label>
  						<input type="text" class="form-control" name="DescrizioneFonte" id="DescrizioneFonte" placeholder="Inserire una breve descrizione della fonte, se necessario." />
 	 				</div>
  					<div class="form-group">
  						<div class="col-sm-offset-5 col-sm-7">
  							<button type="button" class="btn btn-primary" onclick="addOption();">
  								<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Aggiungi fonte
  							</button>
  						</div>
  					</div>
  				</div>
  				<hr />
  				<?php
  					echo '<input type="hidden" name="NomeReq" value="' . $NomeReq . '">
  							<input type="hidden" name="CodiceReq" value="' . $_POST["CodiceReq"] .'">
  							<input type="hidden" name="Sistema" value="' . $_POST["Sistema"] . '">
  							<input type="hidden" name="Tipo" value="' . $_POST["Tipo"] . '">
  							<input type="hidden" name="Descrizione" value="' . $_POST["Descrizione"] . '">
  							<input type="hidden" name="Importanza" value="' . $_POST["Importanza"] . '">
  							<input type="hidden" name="Soddisfatto" value="' . $_POST["Soddisfatto"] . '">
	  						';

	  				mysqli_close($con);
	  			?>
	  			<div class="form-group">
  					<button type="submit" class="btn btn-success btn-block btn-lg" onclick="return validateFormFonti();" formmethod="post"
  							formaction="inserimentodb.php">
  						Inserisci il requisito nel database
  					</button>
  				</div>
  			</form>
		</div>
	</body>
</html>