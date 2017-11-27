<?php
require "authenticate.php";
require "db_functions.php";

if ($login) {
	$conn = connect_db();
	$sql = "SELECT * FROM usuarios WHERE usuarios.idusuario = '".$idusuario."' ;";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		$row = mysqli_fetch_assoc($result);
		if ($row["isAdmin"] == 0) {
			$href = "account.php";
		} else {
			$href = "admin.php";
		}
	} 
}








?>


<!DOCTYPE html>
<html>
<head>
	<title>Spotted</title>
	<meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Catamaran:400,700,800" rel="stylesheet">
	<link href="font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="grid.css">
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	
</head>
<body>

	<nav id="navbar">
		<a href="index.php" class="navlinks"><img class="home" src="images/home.png" alt=""></a>
		<div id="nav-left">
			<a href="newspotted.php" class="navlinks">NOVO SPOTTED</a>
			<a href="sobre.php" class="navlinks">SOBRE</a>
		</div>
		<div id="nav-right">
			<?php if(!($login)): ?>
				<span id="checkLogin"><a style="font-size: 15px; text-decoration: none" href="login.php">
				Login</a>|<a href="login.php" style="font-size: 15px; text-decoration: none">Cadastrar</a></span>
			<?php else: ?>
				<span id="checkLogin">Logado como: <a href= <?= $href ?> style="font-size: 15px;"><?= $nickname ?></a><a href="logout.php" style="font-size: 15px;">(Sair)</a></span><a href="account.php"><img class="config" src="images/config.png" alt=""></a>
			<?php endif; ?>
		</div>
	</nav>			
	<div class="siteContainer">