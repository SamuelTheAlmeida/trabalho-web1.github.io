<?php include("header.php");?>

<?php
	require "db_credentials.php";
	// require "db_functions.php";

	$conn = connect_db();



	// definir o número de resultados por página
	$results_per_page = 12;

	// descobrir o número de resultados no banco
	$sql = "SELECT usuarios.nickname, usuarios.telefone, usuarios.email, posts.idpost, posts.conteudopost, posts.datahorapost, categorias.nomecategoria FROM usuarios, posts, categorias WHERE usuarios.idusuario = posts.idusuario AND
	posts.idcategoria = categorias.idcategoria AND posts.aprovado = 0;";
	$result = mysqli_query($conn, $sql);
	$number_of_results = mysqli_num_rows($result);

	
?>

<div id="header">
	<br/><br/>
	<span id="siteName"><img src="images/heart-eye.png" class="logo">Spotted </span> 
	<div id="description">
		Mande uma cantada, desabafe ou apenas jogue papo fora!		
		
	</div> <!-- header div end -->
<div id="posts">
		<br/><br/>
		<span class="sub">Posts recentes</span>
		<br/><br/>
	<div id="grid" class="ui grid">
	<?php 
	
		$number_of_pages = ceil($number_of_results/$results_per_page);

		// determinar qual página o usuário está visualizando
		if (!isset($_GET["page"])) {
			$page = 1;
		} else {
			$page = $_GET["page"];
		}

		// determinar o número inicial de resultados para a condição LIMIT da query
		$this_page_first_result = ($page-1)*$results_per_page;

		// obter os resultados do banco e mostrar na página
			$sql = "SELECT usuarios.nickname, usuarios.telefone, usuarios.email, posts.idpost, posts.conteudopost, 
			DATE_FORMAT(posts.datahorapost, '%d/%c às %k:%i') AS 'datahorapost', categorias.nomecategoria, posts.aprovado FROM usuarios, posts, categorias WHERE usuarios.idusuario = posts.idusuario AND
	posts.idcategoria = categorias.idcategoria AND posts.aprovado = 1 ORDER BY posts.datahorapost DESC LIMIT " . $this_page_first_result . "," . $results_per_page . ";";
			$result = mysqli_query($conn, $sql);

			while ($row = $result->fetch_assoc()) { 
			echo "<div class='col four wide column'> <span class='idUserPost'>". $row["nickname"] . " - ". $row["telefone"] . "</span>";
			echo "<strong>".$row['nomecategoria'] . "</strong><br>";
			echo "<div class='rowPost'>". $row["conteudopost"] . "</div>";
			echo "<span class='dataHoraPost'>". $row["datahorapost"] . "</span></div>";
		}

	?>

	</div> <!-- grid div end -->
	</div> <!-- posts div end -->

	<div id="pages"><span>Páginas: </span>
	<?php 
		for ($page=1; $page<=$number_of_pages;$page++) {
			echo '<a class="numPage" href="index.php?page=' . $page . '">' . $page . '</a>';
		}

	?>
	</div>
</div>

<?php include("footer.php");?>
