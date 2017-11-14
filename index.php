<!DOCTYPE html>
<html>
<head>
	<title>Spotted</title>
	<link href="https://fonts.googleapis.com/css?family=Catamaran:400,700,800" rel="stylesheet">
	<script src="https://use.fontawesome.com/681f10decb.js"></script>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/components/grid.css">
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
<span class="sub">Publicar um novo post</span>
	
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

<div id="posts">
	<span class="sub">Posts recentes</span>
	<div class="ui grid">
  		<div class="three wide column posts">Spare ribs jowl velit beef meatloaf. Beef ham capicola elit incididunt tempor, duis ground round nulla nostrud ut. Chuck short ribs ipsum consectetur tenderloin. Dolore t-bone drumstick ex ut eu. Beef ribs meatball est turkey deserunt swine in tongue shank capicola. Tenderloin hamburger labore bresaola in nostrud prosciutto porchetta leberkas. Et aliqua jerky, nostrud in porchetta in ut labore commodo venison flank short ribs.</div>
  		<div class="three wide column">Tongue do minim sausage, bresaola dolor nulla qui tenderloin eiusmod ut tempor. Ham tempor in brisket, flank leberkas chuck est in chicken rump eiusmod. Pastrami velit ut, shankle pork chop id capicola ex ipsum. Lorem officia est meatball nulla meatloaf swine cupidatat tenderloin ut. Incididunt strip steak dolor turducken pork sirloin, ball tip frankfurter et in. Jowl voluptate in tri-tip ex anim doner sausage pancetta ball tip. Labore cupim lorem cupidatat sunt frankfurter beef ribs meatball enim est.</div>
  		<div class="three wide column">Andouille nisi enim fugiat ground round sirloin burgdoggen, tenderloin consectetur. Et tenderloin pig ut, ut cillum bacon aute. Short loin shank andouille, excepteur turducken irure short ribs adipisicing ad tenderloin strip steak duis fugiat. Adipisicing prosciutto cupidatat pork belly.</div>
  		<div class="three wide column">Rump turducken minim, nostrud frankfurter fugiat elit. Kielbasa commodo ham fugiat beef ribs pork chop, turkey short ribs shoulder. Magna cow cupim short ribs jowl, nostrud kielbasa fatback proident andouille. In beef lorem tenderloin dolor tongue. Consectetur exercitation pariatur meatloaf shank excepteur.</div>
	</div>
</div>
</div>
</body>
</html>