<!DOCTYPE html>
<html>
<head>
	<title>Gym Max</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Sen&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<style type="text/css">
		form{
			max-width: 460px;
			width: calc(100% - 40px);
			padding: 20px;
			background: #fff;
			border-radius: 5px;
			margin: auto;
		}
		form h3{
			margin: 5px 0;
		}
		form input{
			padding: 7px 10px;
			width: calc(100% - 22px);
			margin-bottom: 10px;
		}
		form button{
			padding: 10px 15px;
			width: calc(100%);
			background: var(--main-red);
			border: none;
			color: #fff;
		}
		form p{
			margin: 0;
			margin-bottom: 5px;
			color: var(--main-red);
			font-size: 14px;
		}
	</style>
</head>
<body>
	<header>
		<div class="logo-place"><a href="index.php"><img src="assets/logo.png"></a></div>
	</header>
	<br>
	<div class="main-content">
		<div class="content-page">
			<div>
				<form action="servicios/validaAdmin.php" method="POST">
					<h3>Iniciar sesión</h3>
					<input type="text" name="cuenta" placeholder="Nombre de la cuenta">
					<input type="password" name="pass" placeholder="Contraseña">
					<?php
						if (isset($_GET['e'])) {
							switch ($_GET['e']) {
								case '1':
									echo '<p>Error de conexión</p>';
									break;	
								case '2':
									echo '<p>Cuenta Invalida</p>';
									break;	
								case '3':
									echo '<p>Contraseña incorrecta</p>';
									break;							
								default:
									break;
							}
						}
					?>
					<button type="submit">Ingresar</button>
				</form>	
			</div>
			</div>
	</div>
	<br><br>
	<br><br>
	<br><br>
	<br><br>
	<br><br>
</body>
<?php include("layouts/_footer.php"); ?>
</html>