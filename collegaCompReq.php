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

			require "php/printFonti.php";
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
    	    			<li class="active"><a>Aggiungi Componente</a></li>
        				<li><a href="aggiungiTest.php">Aggiungi Test</a></li>s
        				<li><a href="latex.php">Latex</a></li>
      				</ul>
    			</div>
  			</div>
		</nav>

		<div class="container">
			<h1>Aggiungi componente <small>Crea il componente &gt; Collega i requisiti</small></h1> 
			<p>Specifica i requisiti a cui è tracciato il componente:</p>
			<form role="form" class="form-horizontal" id="formCompReq">
				<div class="form-group" id="divRequisiti">
					<label for="Requisiti" class="control-label">
	  					Requisiti:
	  				</label>
    				<?php 
    				$con = dbconnect();
    				printReq($con); 
    				?>
    			</div>
    			<hr />
  				<?php
  					echo '  <input type="hidden" name="NomeComp" value="' . $_POST["NomeComp"] .'">
  							<input type="hidden" name="DescrizioneComp" value="' . $_POST["DescrizioneComp"] . '">
	  						';

	  				mysqli_close($con);
	  			?>	
	  			<div class="form-group">
  					<button type="submit" class="btn btn-success btn-block btn-lg" onclick="return validateFormFonti();" formmethod="post"
  							formaction="inserimentodbComp.php">
  						Inserisci il componente nel database
  					</button>
  				</div>
  			</form>
		</div>
	</body>
</html>