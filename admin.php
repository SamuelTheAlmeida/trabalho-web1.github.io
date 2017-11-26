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
			$sql = "SELECT usuarios.nickname, usuarios.telefone, usuarios.email, posts.idpost, posts.conteudopost, 
			DATE_FORMAT(posts.datahorapost, '%d/%c às %k:%i') AS 'datahorapost', categorias.nomecategoria FROM usuarios, posts, categorias WHERE usuarios.idusuario = posts.idusuario AND
	posts.idcategoria = categorias.idcategoria ORDER BY posts.datahorapost DESC LIMIT " . $this_page_first_result . "," . $results_per_page . ";";
			$result = mysqli_query($conn, $sql);

			while ($row = $result->fetch_assoc()) { 
			echo "<div class='col'> <span class='idUserPost'>". $row["nickname"] . " - ". $row["telefone"] . "</span>";
			echo "<strong>".$row['nomecategoria'] . "</strong><br>";
			echo "<textarea value = " . $row["conteudopost"] . ">" . $row["conteudopost"] . "</textarea><br>";
			echo "<a href='#'> Aprovar </a>" . "<a href='#'> Alterar </a>" . "<a href='#'> Rejeitar </a>" . "<br>"; 
			echo $row["datahorapost"] . "</div>";
		}

	?>

	</div> <!-- grid div end -->
	<?php 
		for ($page=1; $page<=$number_of_pages;$page++) {
			echo '<a href="index.php?page=' . $page . '">' . $page . '</a>';
		}

	?>
</div> <!-- posts div end -->

<?php include("footer.php");?>
