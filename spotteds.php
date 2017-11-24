<?php include("header.php");?>
<div id="newPost">
	<span class="sub">Publicar um novo post</span>
	<form id="submitPost" method="POST" action="lista_de_spotteds.php">
		<select>
			<option value="cantada">Viu aquela pessoa e quer mandar uma cantada</option>
			<option value="aleatoria">Coisas aleatórias que não são cantadas direcionadas</option>
			<option value="utilidade">Coisas de utilidade pública</option>
			<option value="achei">Achou ou perdeu alguma coisa?</option>
			<option value="carona">Pra vc que mora longe e precisa de uma carona pra ir pras aulas</option>
		</select> <br>
		<textarea name="postText" placeholder="Não seja um troll" cols="30" rows="5"></textarea>
		<br>
		<input type="submit" class="submit"></input>
	</form>
</div> <!-- newPost div end -->
<?php include("footer.php");?>