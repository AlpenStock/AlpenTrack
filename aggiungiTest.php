<?php
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Aggiungi - AlpenStock </title>
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
		<h1>Aggiungi test <small>Crea il test</small></h1> 
		<p>Compila il form seguente per creare un test:</p> 
		<form role="form" class="form-horizontal">
			<div class="form-group" id="divCodTest">
				<label for="CodTest" class="control-label">
					Codice Test:
				</label>
				<div>
					<input type="text" class="form-control" name="CodTest" id="CodTest" placeholder="esempio: TU2" onchange="removeError('divCodTest')" autofocus required />
				</div>
			</div>
			<div class="form-group" id="divDescrizioneTest">
				<label for="DescrizioneTest" class="control-label">
					Descrizione:
				</label>
				<div>
					<input type="text" class="form-control" name="DescrizioneTest" id="DescrizioneTest" placeholder="Test di unità sulla classe NomeClasse" onchange="removeError('divDescrizioneTest')" />
				</div>
			</div>
			<div class="form-group">
 				<label for="Pass" class="control-label">
					Passato:
				</label>
				<label class="radio-inline">
     				<input type="radio" name="Pass" value="TRUE" />Sì
    			</label>
    			<label class="radio-inline">
      				<input type="radio" name="Pass" value="FALSE" />No
    			</label>
 			</div>
			
 			<div class="form-group">
      			<button type="submit" class="btn btn-success btn-block btn-lg" onclick="return validate();" formmethod="post" formaction="collegaTestComp.php">
 			         <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Crea
				</button>
  			</div>
		</form>	
	</div>
</body>
</html>