<?php
	function printTable($con, $results) {
		printTopTable();
		printBodyTable($con, $results);
		printBottomTable();
	}

	function printTopTable() {
		echo "
				<div class='table'>
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
			echo "<a href='modificaRequisito.html' class='glyphicon glyphicon-wrench' aria-hidden='true'>";
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

?>