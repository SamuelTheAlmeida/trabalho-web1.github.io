<?php include("header.php");?>

<?php
	require "db_credentials.php";
	// require "db_functions.php";

	$conn = connect_db();



	// definir o número de resultados por página
	$results_per_page = 5;

	// descobrir o número de resultados no banco
	$sql = "SELECT usuarios.nickname, usuarios.telefone, usuarios.email, posts.idpost, posts.conteudopost, posts.datahorapost, categorias.nomecategoria FROM usuarios, posts, categorias WHERE usuarios.idusuario = posts.idusuario AND
	posts.idcategoria = categorias.idcategoria;";
	$result = mysqli_query($conn, $sql);
	$number_of_results = mysqli_num_rows($result);

	
?>

	<div id="header">
		<span id="siteName"><i class="fa fa-eye" aria-hidden="true"></i> Spotted <i class="fa fa-eye" id="eye" 
		aria-hidden="true"> </i></span> 
		<div id="description">
			Mande uma cantada, desabafe ou apenas jogue papo fora!
		</div>
		<hr>
	</div> <!-- header div end -->
<div id="posts">
	<span class="sub">Posts recentes</span>
	<div id="grid">
	<?php 
	
		$number_of_pages = ceil($number_of_results/$results_per_page);

		// determinar qual página o usuário está visualizando
		if (!isset($_GET["page"])) {
			$page = 1;
		} else {
			$page = $_GET["page"];
		}

		// determine the SQL limit starting number for the results on the displaying page
		$this_page_first_result = ($page-1)*$results_per_page;

		// retrieve selected results from database and display them on the page
			$sql = "SELECT usuarios.nickname, usuarios.telefone, usuarios.email, posts.idpost, posts.conteudopost, posts.datahorapost, 
			categorias.nomecategoria FROM usuarios, posts, categorias WHERE usuarios.idusuario = posts.idusuario AND
	posts.idcategoria = categorias.idcategoria LIMIT " . $this_page_first_result . "," . $results_per_page . ";";
			$result = mysqli_query($conn, $sql);

			while ($row = $result->fetch_assoc()) { 
			echo "<div class='col'> <span class='idUserPost'>". $row["nickname"] . " - ". $row["telefone"] . "</span>";
			echo $row["conteudopost"] . "</div>";
		}

	?>
<!-- 		
		<div class="col">
			<span class="idUserPost"> 20matar70correr </span>
			Tongue do minim sausage, 
			bresaola dolor nulla qui tenderloin eiusmod ut tempor.
			Ham tempor in brisket, 
			flank leberkas chuck est in chicken rump eiusmod.
			Pastrami velit ut, shankle pork chop id capicola ex ipsum. 
			Lorem officia est meatball nulla meatloaf swine cupidatat tenderloin ut.
			Incididunt strip steak dolor turducken pork sirloin, 
			ball tip frankfurter et in. 
			Jowl voluptate in tri-tip ex anim doner sausage pancetta ball tip.
			Labore cupim lorem cupidatat sunt frankfurter beef ribs meatball enim est. 
		</div>

		<div class="col">
			<span class="idUserPost"> Anônimo</span>
			Andouille nisi enim fugiat ground round sirloin burgdoggen,
			tenderloin consectetur. Et tenderloin pig ut, 
			ut cillum bacon aute. Short loin shank andouille,
			excepteur turducken irure short ribs adipisicing ad tenderloin
			strip steak duis fugiat. Adipisicing prosciutto cupidatat pork belly.
		</div>

		<div class="col">
			<span class="idUserPost"> Donald Trump</span>
			Rump turducken minim, nostrud frankfurter fugiat elit.
			Kielbasa commodo ham fugiat beef ribs pork chop, 
			turkey short ribs shoulder. Magna cow cupim short ribs jowl,
			nostrud kielbasa fatback proident andouille. 
			In beef lorem tenderloin dolor tongue. 
			Consectetur exercitation pariatur meatloaf shank excepteur. 
		</div>	 -->

	</div> <!-- grid div end -->
	<?php 
		for ($page=1; $page<=$number_of_pages;$page++) {
			echo '<a href="index.php?page=' . $page . '">' . $page . '</a>';
		}

	?>
</div> <!-- posts div end -->

<?php include("footer.php");?>
