<?php
	function printTable($con, $results) {
		printTopTable();
		printBodyTable($con, $results);
		printBottomTable();
	}

	function printTopTable() {
		echo "
				<div class='table-responsive'>
					<table class='table table-striped table-bordered table-condensed'>
						<thead>
							<tr>
								<th>Stato</th>
								<th>Nome</th>
								<th>Codice</th>
								<th>Sistema</th>
								<th>Importanza</th>
								<th>Tipo</th>
								<th>Descrizione</th>
								<th>Fonti</th>
								<th>Modifica</th>
							</tr>
						</thead>
						<tbody>";
	}

	function printBodyTable($con, $results) {
		while ($row = mysqli_fetch_array($results)) {
			if ($row['Soddisfatto'] == true) {
				echo "<tr class='success'>";
				echo "<td><span class='glyphicon glyphicon-ok-circle' aria-hidden='true' /></td>";
			}
			else {
				echo "<tr>";
				echo "<td><span class='glyphicon glyphicon-remove-circle' aria-hidden='true' /></td>";
			}

			echo "<td>" . $row["NomeReq"] . "</td>";
			echo "<td>" . $row["CodiceReq"] . "</td>";
			echo "<td>";
			switch ($row["Sistema"]) {
				case 'C':
					echo "Cloud";
					break;
				case 'S':
					echo "Smartwatch";
					break;
				default:
					echo "Nessun sistema";
					break;
			}
			echo "</td><td>";
			switch ($row["Importanza"]) {
				case '0':
					echo "Obbligatorio";
					break;
				case '1':
					echo "Desiderabile";
					break;
				case '2':
					echo "Opzionale";
					break;
			}
			echo "</td><td>";
			switch ($row["Tipo"]) {
				case 'Q':
					echo "Qualità";
					break;
				case 'V':
					echo "Vincolo";
					break;
				case 'F':
					echo "Funzionale";
					break;
				case 'P':
					echo "Prestazionale";
					break;
			}
			echo "</td>";
			echo "<td>" . $row["Descrizione"] . "</td>";

			//FONTI
			echo "<td>";
			
			$query = 'SELECT NomeFonte
				    FROM ReqFonti
				    WHERE NomeReq = "' . $row["NomeReq"] . '"';
			$fonti = mysqli_query($con, $query);
			while ($rowF = mysqli_fetch_array($fonti)) {
				echo $rowF["NomeFonte"] . "<br />";
			}
			echo "</td>";
			echo "<td>";
			echo "<a href='modificaRequisito.php?NomeReq=" . $row['NomeReq'] . "' class='glyphicon glyphicon-wrench' aria-hidden='true'>";
			echo "</td>";
			echo "</tr>";
		}
	}

	function printBottomTable() {
		echo "
						</tbody>
					</table>
				</div>";
	}

	function insertError($con, $error) {
		mysqli_rollback($con);
		mysqli_close($con);
		echo "<p>" . $error . "</p>";
	}

	function printForm($con, $req) {
		echo '<form role="form" class="form-horizontal">';
		printFields($con, $req);
		printButtons($req);
		echo '</form>';
	}

	function printFields($con, $req) {
		$query = 'SELECT * FROM Requisiti WHERE NomeReq = "' . $req . '";';
		$result = mysqli_query($con, $query);
		if ($result == false) {
			echo "<p>Si è verificato un errore nel recupero del reqisito</p>";
			exit;
		}

		$row = mysqli_fetch_array($result);

		echo '<div class="form-group" id="divCodice">
				<label for="CodiceReq" class="control-label">
					Codice univoco:
				</label>
				<div>
					<input type="text" class="form-control" name="CodiceReq" id="CodiceReq" placeholder="esempio: 1.1.1" 
					onchange="removeError(\'divCodice\')" value="' . $row["CodiceReq"] . '" autofocus required />
				</div>
			  </div>';
		echo '<div class="form-group" id="divSistema">
				<label for="Sistema" class="control-label">
					Sistema:
				</label>';
		printCheckSistema($row['Sistema']);
		echo '</div>';
		printSelectImportanza($row['Importanza']);
		printSelectTipo($row['Tipo']);
		echo '<div class="form-group" id="divDesc">
				<label for="Descrizione" class="control-label">
					Descrizione:
				</label>
				<input type="text" name="Descrizione" id="Descrizione" class="form-control" placeholder="Inserire una breve descrizione del 
				requisito (massimo 200 caratteri)" maxlength="200" onchange="removeError(\'divDesc\')" required  
				value="' . $row["Descrizione"] . '" />
 			</div>';

 		printCheckSoddisfatto($row['Soddisfatto']);
	}

	function printCheckSistema($sistema) {
		if ($sistema == "S") {
			echo '<label class="radio-inline">
     				<input type="radio" name="Sistema" id="SistemaS" value="S" onchange="removeError(\'divSistema\')" checked/>Smartwatch
    			</label>
    			<label class="radio-inline">
      				<input type="radio" name="Sistema" id="SistemaC" value="C" onchange="removeError(\'divSistema\')" />Cloud
    			</label>
    			<label class="radio-inline">
    				<input type="radio" name="Sistema" id="SistemaN" value="N" onchange="removeError(\'divSistema\')" />Nessun sistema
     			</label>';
		}
		if ($sistema == "C") {
			echo '<label class="radio-inline">
     				<input type="radio" name="Sistema" id="SistemaS" value="S" onchange="removeError(\'divSistema\')" />Smartwatch
    			</label>
    			<label class="radio-inline">
      				<input type="radio" name="Sistema" id="SistemaC" value="C" onchange="removeError(\'divSistema\')" checked/>Cloud
    			</label>
    			<label class="radio-inline">
    				<input type="radio" name="Sistema" id="SistemaN" value="N" onchange="removeError(\'divSistema\')" />Nessun sistema
     			</label>';
		}
		if ($sistema == "") {
			echo '<label class="radio-inline">
     				<input type="radio" name="Sistema" id="SistemaS" value="S" onchange="removeError(\'divSistema\')" />Smartwatch
    			</label>
    			<label class="radio-inline">
      				<input type="radio" name="Sistema" id="SistemaC" value="C" onchange="removeError(\'divSistema\')" />Cloud
    			</label>
    			<label class="radio-inline">
    				<input type="radio" name="Sistema" id="SistemaN" value="N" onchange="removeError(\'divSistema\')" checked/>Nessun sistema
     			</label>';
		}

	}

	function printSelectImportanza($impo) {
		if ($impo == 0) {
			echo '<div class="form-group">
				<label for="Importanza" class="control-label">
					Importanza:
				</label>
				<select class="form-control" name="Importanza" required>
        			<option value="0" selected>Obbligatorio</option>
        			<option value="1">Desiderabile</option>
        			<option value="2">Opzionale</option>
      			</select>
			</div>';
		}
		if ($impo == 1) {
			echo '<div class="form-group">
				<label for="Importanza" class="control-label">
					Importanza:
				</label>
				<select class="form-control" name="Importanza" required>
        			<option value="0">Obbligatorio</option>
        			<option value="1" selected>Desiderabile</option>
        			<option value="2">Opzionale</option>
      			</select>
			</div>';
		}
		if ($impo == 2) {
			echo '<div class="form-group">
				<label for="Importanza" class="control-label">
					Importanza:
				</label>
				<select class="form-control" name="Importanza" required>
        			<option value="0">Obbligatorio</option>
        			<option value="1">Desiderabile</option>
        			<option value="2" selected>Opzionale</option>
      			</select>
			</div>';
		}
	}

	function printSelectTipo($tipo) {
		if ($tipo == "F") {
			echo '<div class="form-group">
				<label for="Tipo" class="control-label">
					Tipo:
				</label>
				<select class="form-control" name="Tipo" required>
        			<option value="F" selected>Funzionale</option>
        			<option value="Q">Qualità</option>
        			<option value="P">Prestazionale</option>
        			<option value="V">Vincolo</option>
      			</select>
			</div>';
		}
		if ($tipo == "Q") {
			echo '<div class="form-group">
				<label for="Tipo" class="control-label">
					Tipo:
				</label>
				<select class="form-control" name="Tipo" required>
        			<option value="F">Funzionale</option>
        			<option value="Q" selected>Qualità</option>
        			<option value="P">Prestazionale</option>
        			<option value="V">Vincolo</option>
      			</select>
			</div>';
		}
		if ($tipo == "P") {
			echo '<div class="form-group">
				<label for="Tipo" class="control-label">
					Tipo:
				</label>
				<select class="form-control" name="Tipo" required>
        			<option value="F">Funzionale</option>
        			<option value="Q">Qualità</option>
        			<option value="P"selected>Prestazionale</option>
        			<option value="V">Vincolo</option>
      			</select>
			</div>';
		}
		if ($tipo == "V") {
			echo '<div class="form-group">
				<label for="Tipo" class="control-label">
					Tipo:
				</label>
				<select class="form-control" name="Tipo" required>
        			<option value="F">Funzionale</option>
        			<option value="Q">Qualità</option>
        			<option value="P">Prestazionale</option>
        			<option value="V" selected>Vincolo</option>
      			</select>
			</div>';
		}
	}

	function printCheckSoddisfatto($sodd) {
		if ($sodd == 1) {
			echo '<div class="form-group">
 				<label for="Soddisfatto" class="control-label">
					Soddisfatto:
				</label>
				<label class="radio-inline">
     				<input type="radio" name="Soddisfatto" value="TRUE" checked />Sì
    			</label>
    			<label class="radio-inline">
      				<input type="radio" name="Soddisfatto" value="FALSE" />No
    			</label>
 			</div>';
		}
		else {
			echo '<div class="form-group">
 				<label for="Soddisfatto" class="control-label">
					Soddisfatto:
				</label>
				<label class="radio-inline">
     				<input type="radio" name="Soddisfatto" value="TRUE" />Sì
    			</label>
    			<label class="radio-inline">
      				<input type="radio" name="Soddisfatto" value="FALSE" checked />No
    			</label>
 			</div>';
		}
	}

	function printButtons($req) {
		echo '<div class="form-group">
 				<div class="col-md-6">
      				<button type="submit" class="btn btn-success btn-block btn-lg" onclick="return validate();" formmethod="post" formaction="opCompletata.php?NomeReq=' . $req . '&Op=mod" />
 			        	<span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> Modifica
					</button>
				</div>
				<div class="col-md-6">
      				<button type="submit" class="btn btn-danger btn-block btn-lg" onclick="return validate();" formmethod="post" formaction="opCompletata.php?NomeReq=' . $req . '&Op=delete" />
 			        	<span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span> Elimina
					</button>
				</div>
  			</div>';
	}

?>