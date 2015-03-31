<?php

	function printTableTest($con, $results) {
		printTopTableTest();
		printBodyTableTest($con, $results);
		printBottomTableTest();
	}

	function printTopTableTest() {
		echo "
				<div class='table-responsive'>
					<table class='table table-striped table-bordered table-condensed'>
						<thead>
							<tr>
								<th>Passato</th>
								<th>Codice</th>
								<th>Descrizione</th>
								<th>Componenti</th>
								<th>Modifica</th>
							</tr>
						</thead>
						<tbody>";
	}

	function printBodyTableTest($con, $results) {
		while ($row = mysqli_fetch_array($results)) {
			if ($row['Pass'] == true) {
				echo "<tr class='success'>";
				echo "<td><span class='glyphicon glyphicon-ok-circle' aria-hidden='true' /></td>";
			}
			else {
				echo "<tr>";
				echo "<td><span class='glyphicon glyphicon-remove-circle' aria-hidden='true' /></td>";
			}

			echo "<td>" . $row["CodTest"] . "</td>";
			echo "<td>" . $row["DescrizioneTest"] . "</td>";

			//Componenti
			echo "<td>";
			
			$query = 'SELECT NomeComp
				    FROM TestComp
				    WHERE CodTest = "' . $row["CodTest"] . '"';
			$comp = mysqli_query($con, $query);
			while ($rowC = mysqli_fetch_array($comp)) {
				echo $rowC["NomeComp"] . "<br />";
			}
			echo "</td>";
			//
			
			echo "<td>";
			echo "<a href='' class='glyphicon glyphicon-wrench' aria-hidden='true'>";
			echo "</td>";
			echo "</tr>";
		}
	}