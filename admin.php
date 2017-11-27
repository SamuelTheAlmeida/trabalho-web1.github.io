<?php include("header.php");?>

<?php
	require "db_credentials.php";
	$conn = connect_db();

	// definir o número de resultados por página
	$results_per_page = 12;

	// descobrir o número de resultados no banco
	$sql = "SELECT usuarios.nickname, usuarios.telefone, usuarios.email, posts.idpost, posts.conteudopost, posts.aprovado, posts.datahorapost, categorias.nomecategoria FROM usuarios, posts, categorias WHERE usuarios.idusuario = posts.idusuario AND
	posts.idcategoria = categorias.idcategoria AND posts.aprovado = 0;";
	$result = mysqli_query($conn, $sql);
	$number_of_results = mysqli_num_rows($result);

	

	$error = false;
	$success = false;

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$postNewText = $_POST['postNewText'];
		if (isset($_POST['idpost'])) {
			$idpost = $_POST['idpost'];
		}
		switch($_POST["submit"]) {
			case 'rejeitar':
				$query = "DELETE FROM posts WHERE idpost = '".$idpost."';";
				break;
			case 'aprovar':
				$query = "UPDATE posts SET aprovado = 1 WHERE idpost = '".$idpost."';";
				break;
			case 'modificar':
				$query = "UPDATE posts SET conteudopost = '".$postNewText."' WHERE idpost = '".$idpost."';"; 
				break;
		}
			$result = mysqli_query($conn, $query);
			if ($result) {
				$success = true;
				$success_msg = "Ação realizada com sucesso";
			} else {
				$error = true;
				$error_msg = "Não foi possivel realizar a ação";
			}
	
	}

	
?>
<div id="header">
	<br/><br/>
	    <?php if ($success): ?>
          <h3 style="color:lightgreen;"><?= $success_msg ?></h3>
        <?php endif; ?>

        <?php if ($error): ?>
          <h3 style="color:red;"><?php echo $error_msg; ?></h3>
        <?php endif; ?>

	<span id="siteName"><img src="images/heart-eye.png" class="logo">Spotted </span> 
	<div id="description">
		Mande uma cantada, desabafe ou apenas jogue papo fora!		
		
	</div> <!-- header div end -->
<div id="posts">
		<br/><br/>
		<span class="sub">Posts pendentes de aprovação</span>
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
	posts.idcategoria = categorias.idcategoria AND posts.aprovado = 0 ORDER BY posts.datahorapost DESC LIMIT " . $this_page_first_result . "," . $results_per_page . ";";
			$result = mysqli_query($conn, $sql);

			while ($row = $result->fetch_assoc()) { 

				echo "<div class='adminCol five wide column'>";
				echo "<form method='POST' action='admin.php'><span class='idUserPost'>". $row["nickname"] . " - ". $row["telefone"] . "</span>";
				echo "<strong>".$row['nomecategoria'] . "</strong><br>";
				echo "<textarea name='postNewText' cols=18 rows=4 value = " . $row["conteudopost"] . ">" . $row["conteudopost"] . "</textarea><br>";
				echo "<input readonly type='hidden' name='idpost' value='". $row["idpost"] . "'</input>";
				echo "<button name='submit' value='aprovar' class='admActions' id='aprovar'> Aprovar </button>"; 
				echo "<button name='submit' value='modificar' class='admActions' id='modificar'> Modificar </button>"; 
				echo "<button name='submit' value='rejeitar' class='admActions' id='rejeitar'> Rejeitar </button><br>"; 
				echo $row["datahorapost"] . "</form></div>";
		}

	?>

	</div> <!-- grid div end -->
	</div>



	<div class="adminPages"><span>Páginas: </span>
	<?php 
		for ($page=1; $page<=$number_of_pages;$page++) {
			echo '<a class="adminNumPage" href="admin.php?page=' . $page . '">' . $page . '</a>';
		}

	?>
	</div>
</div>

<?php include("footer.php");?>
