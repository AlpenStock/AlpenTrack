<!DOCTYPE html>
<html>
	<head>
		<title>Login - AlpenStock </title>
		<link href="css/style.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<?php
			if (isset($_POST["psw"]))
				if ($_POST["psw"] == "alpenstockadmin")
					header("location:requisiti.html");
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
