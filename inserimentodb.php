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

			$fonti= $_POST['Fonti']; 

			if ($_POST['Sistema'] == "N")
				$_POST['Sistema'] = "";
			
			unset($_POST['Fonti']); unset($_POST['NomeFonte']); unset($_POST['DescrizioneFonte']); 

			
			if (count($_POST) < 7) 
				header("location:aggiungiRequisito.php");

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
        				<li class="active"><a href="aggiungiRequisito.php">Aggiungi Requisito</a></li>
        				<li><a href="latex.php">Latex</a></li>
      				</ul>
    			</div>
  			</div>
		</nav>

		<div class="container">
			<h1>Aggiungi requisito <small>Crea il requisito &gt; Collega le fonti &gt; Inserimento nel database</small></h1> 
			<?php
				$con = dbconnect();


				//Inizia transazione
				$esito = mysqli_begin_transaction($con);

				//Creazione requisito
				
				if ($esito == false) {
					insertError($con, "Errore nell'avvio della transazione");
					exit;
				}

				$query = 'INSERT INTO Requisiti(NomeReq, CodiceReq, Sistema, Importanza, Tipo, Descrizione, Soddisfatto) VALUES ("'.$_POST["NomeReq"].'", "'.$_POST["CodiceReq"].'", "'.$_POST["Sistema"].'", "'.$_POST["Importanza"].'", "'.$_POST["Tipo"].'" ,"'.$_POST["Descrizione"].'", '.$_POST["Soddisfatto"].');';
				$esito = mysqli_query($con, $query);

				if ($esito == false) {
					insertError($con, "Errore nell'inserimento del requisito");
					exit;
				}					

				unset($_POST['CodiceReq']); unset($_POST['Sistema']); unset($_POST['Importanza']); 
				unset($_POST['Descrizione']); unset($_POST['Soddisfatto']); unset($_POST['Tipo']);

				//Creazione fonti

				if (count($_POST) > 1) {
					$query = "INSERT INTO Fonti VALUES ";
					$c = 0;
					foreach ($_POST as $key=>$value) {
						if ($key == "NomeReq")
							continue;
						if ($c == 0)
							$query = $query . '("' . $key . '", "' . $value . '")';
						else
							$query = $query . ', ("' . $key . '", "' . $value . '")';
						$c++;
					}

					$esito = mysqli_query($con, $query);
					if ($esito == false) {
						insertError($con, "Errore nell'inserimento delle fonti");
						exit;
					}		
				}	

				//Collegamento requisito-fonti
				$queryF = "";
				$query = 'INSERT INTO ReqFonti VALUES ';
				$element = '("' . $_POST["NomeReq"] . '", ';
				$c = 1;
				foreach ($fonti as $value) {
					if ($c == count($fonti))
						$query = $query . $element . '"' . $value . '");';
					else
						$query = $query . $element . '"' . $value . '"),';
					$c++;
				}

				$esito = mysqli_query($con, $query); 
				if ($esito == false) {
					insertError($con, "Errore nel collegamento requisito-fonti");
					exit;
				}	

				//Se sono qui è andato tutto bene
				mysqli_commit($con);
				mysqli_close($con);
			?>
			
			<div class="alert alert-success">Il requisito è stato inserito correttamente!</div>

		</div>



	</body>
</html>