<?php
require "authenticate.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Spotted</title>
	<meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Catamaran:400,700,800" rel="stylesheet">
	<link href="font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="styles.css">
	
</head>
<body>


<nav id="navbar"> 
	
		<a href="index.php" class="navlinks"><i class="fa fa-home" aria-hidden="true"></i></a>
		<a href="spotteds.php" class="navlinks">SPOTTEDS</a>
		<a href="sobre.php" class="navlinks">SOBRE</a>
		<div id="nav-right">
			<span id="checkLogin">Logado como: <?= $nickname ?> <a href="logout.php" style="font-size: 15px;">(Sair)</a> <a style="font-size: 15px; text-decoration: none" href="login.php">Login</a>|<a href="login.php" style="font-size: 15px; text-decoration: none">Cadastrar</a></span>
		</div>
</nav>
