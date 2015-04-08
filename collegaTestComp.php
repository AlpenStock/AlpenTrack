<?php
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>TestComp - Aggiungi - AlpenStock </title>
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

			
			require "php/utilComp.php";
			require "php/dbconn.php";

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
        				<li class="active"><a>Aggiungi Test</a></li>s
        				<li><a href="latex.php">Latex</a></li>
      				</ul>
    			</div>
  			</div>
		</nav>

		<div class="container">
			<h1>Aggiungi test <small>Crea il test &gt; Collega i moduli</small></h1> 
			<p>Specifica i moduli a cui è tracciato il test:</p>
			<form role="form" class="form-horizontal" id="formCompReq">
				<div class="form-group" id="divModuli">
					<label for="Moduli" class="control-label">
	  					Moduli:
	  				</label>
					<?php printCheckboxComp($results); ?>
    				<!--FARE UNA CHECK PER SELEZIONARE TUTTE LE CLASSI (UTILE PER I TEST DI SISTEMA) -->
    			</div>
				<?php
					echo "<input type=\"hidden\" name=\"CodTest\" value=\"" . $_POST["CodTest"] . "\"/>";
					echo "<input type=\"hidden\" name=\"DescrizioneTest\" value=\"" . $_POST["DescrizioneTest"] . "\"/>";
					echo "<input type=\"hidden\" name=\"Pass\" value=\"" . $_POST["Pass"] . "\"/>";
				?>	  				
	  			<div class="form-group">
  					<button type="submit" class="btn btn-success btn-block btn-lg" onclick="return validateFormFonti();" formmethod="post"
  							formaction="inserimentodbTest.php">
  						Inserisci il test nel database
  					</button>
  				</div>
  			</form>
		</div>
	</body>
</html>