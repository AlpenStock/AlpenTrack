<?php
	function printFonti($con) {
		$query = "SELECT NomeFonte, DescrizioneFonte
				  FROM Fonti";
		$results = mysqli_query($con, $query);
		if (empty($results))
			return;

		while ($row = mysqli_fetch_array($results)) 
			echo '<option value="' . $row["NomeFonte"] . '">' . $row["NomeFonte"] . ' - ' . $row["DescrizioneFonte"] . '</option>';
	}
?>