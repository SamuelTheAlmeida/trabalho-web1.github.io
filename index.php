<!DOCTYPE html>
<html>
<head>
	<title>Spotted</title>
	<link href="https://fonts.googleapis.com/css?family=Catamaran:400,700,800" rel="stylesheet">
	<script src="https://use.fontawesome.com/681f10decb.js"></script>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

<div id="container">

<nav id="navbar">
	<a href="#">INÍCIO</a>
	<a href="#">SPOTTEDS</a>
	<a href="#">SOBRE</a>
	<div id="nav-right">
		<span id="checkLogin">Logado como: <span>não conectado</span></span>
	</div>
</nav>

	<div id="header">
		<span id="siteName"><i class="fa fa-eye" aria-hidden="true"></i> Spotted <i class="fa fa-eye" id="eye" 
		aria-hidden="true"> </i></span> 
		<div id="description">
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis aliquet dictum urna, a finibus sapien egestas congue. 
			Vestibulum mi tortor, mattis ac facilisis sollicitudin, consequat eget leo. Nam non nulla urna.
		</div>
		<hr>
	</div>

<div id="newPost">
<span>Publicar um novo post</span>
	
<form>
	<select>
		<option value="cantada">Viu aquela pessoa e quer mandar uma cantada</option>
		<option value="aleatoria">Coisas aleatórias que não são cantadas direcionadas</option>
		<option value="utilidade">Coisas de utilidade pública</option>
		<option value="achei">Achou ou perdeu alguma coisa?</option>
		<option value="carona">Pra vc que mora longe e precisa de uma carona pra ir pras aulas</option>
	</select> <br>
	<textarea placeholder="Não seja um troll" cols="30" rows="5"></textarea>
	<br>
	<input type="submit" class="submit"> </input>
</form>
	</div>
<hr>

<div class="sub posts">
	<span>Posts recentes</span>
</div>
</div>
</body>
</html>