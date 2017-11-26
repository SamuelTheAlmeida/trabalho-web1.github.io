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
		<a href="newspotted.php" class="navlinks">NOVO SPOTTED</a>
		<a href="sobre.php" class="navlinks">SOBRE</a>
		<div id="nav-right">
			<?php if(!($login)): ?>
			<span id="checkLogin"><a style="font-size: 15px; text-decoration: none" href="login.php">
			Login</a>|<a href="login.php" style="font-size: 15px; text-decoration: none">Cadastrar</a></span>
			<?php else: ?>
			<span id="checkLogin">Logado como: <a href="account.php" style="font-size: 15px;"><?= $nickname ?></a><a href="logout.php" style="font-size: 15px;">(Sair)</a>
			<?php endif; ?>
		</div>
</nav>		