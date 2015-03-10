<?php
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Login - AlpenStock </title>
		<link href="css/styleLogin.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<?php
			session_unset();
			
			if (isset($_POST["psw"])) {
				require "php/dbconn.php";
				$con = dbconnect();
				$query = "SELECT Password FROM Credenziali WHERE Utente = 'Admin';";
				$result = mysqli_query($con, $query);
				$ps = mysqli_fetch_object($result);
				if ($_POST["psw"] == $ps->Password) {
					$_SESSION['authenticate'] = TRUE;
					mysqli_close($con);
					header("location:index.php");
				}
				mysqli_close($con);
			}
			//La Password o non è settata o non è corretta
		?>
		<section class="center">
			<img class="logo" src="img/logo.png" />
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
				<label>Password:</label> 
				<input type="password" name="psw" />
				<input type="submit" value="Login" /> 
			</form>
		</section>
	</body>
</html>
