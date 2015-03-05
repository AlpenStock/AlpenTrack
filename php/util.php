<?php
	function printTable() {
		printTopTable();
		printBodyTable();
		printBottomTable();
	}

	function printTopTable() {
		echo "
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-condensed">
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

	function printBodyTable($results) {
		while ($row = mysqli_fetch_array($results)) {
			foreach ($results as $key => $value) {
				if ($key == "Soddisfatto") {
					$satisfy = $row["Soddisfatto"];
					if ($satisfy == true)
						echo "<tr class='success'>";
					else
						echo "<tr>";
					echo "<td>";
					if (satisfy == true) 
						echo "<span class='glyphicon glyphicon-ok-circle' aria-hidden='true'>";
					else
						echo "<span class='glyphicon glyphicon-remove-circle' aria-hidden='true'>";
					echo "</td>";
				}

				echo "<td>";
				echo $value;
				echo "</td>";
			}
			//MANCA DA STAMPARE LE FONTI
			echo "<td>";
			echo "<a href='modificaRequisito.html' class='glyphicon glyphicon-wrench' aria-hidden='true'>"
			echo "</td>";
			echo "</tr>"
		}
	}

	function printBottomTable() {
		echo "
						</tbody>
					</table>
				</div>";
	}

?>