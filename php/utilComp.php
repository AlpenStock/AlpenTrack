<?php
	function printTableComp($con, $results) {
		printTopTableComp();
		printBodyTableComp($con, $results);
		printBottomTableComp();
	}

	function printTopTableComp() {
		echo "
				<div class='table-responsive'>
					<table class='table table-striped table-bordered table-condensed'>
						<thead>
							<tr>
								<th>Nome</th>
								<th>Descrizione</th>
								<th>Requisiti</th>
								<th>Test</th>
								<th>Modifica</th>
							</tr>
						</thead>
						<tbody>";
	}

	function printBodyTableComp($con, $results) {
		while ($row = mysqli_fetch_array($results)) {
			echo "<td>" . $row["NomeComp"] . "</td>";
			echo "<td>" . $row["DescrizioneComp"] . "</td>";

			//Requisiti
			echo "<td>";
			
			$query = 'SELECT NomeReq
				    FROM ReqComp
				    WHERE NomeComp = "' . $row["NomeComp"] . '"';
			$req = mysqli_query($con, $query);
			while ($rowR = mysqli_fetch_array($req)) {
				echo $rowR["NomeReq"] . "<br />";
			}
			echo "</td>";

			//Test
			echo "<td>";
			
			$query = 'SELECT CodTest
				    FROM TestComp
				    WHERE NomeComp = "' . $row["NomeComp"] . '"';
			$test = mysqli_query($con, $query);
			while ($rowT = mysqli_fetch_array($test)) {
				echo $rowT["CodTest"] . "<br />";
			}
			echo "</td>";
			//
			echo "<td>";
			echo "<a href='' class='glyphicon glyphicon-wrench' aria-hidden='true'>";
			echo "</td>";
			echo "</tr>";
		}
	}

?>