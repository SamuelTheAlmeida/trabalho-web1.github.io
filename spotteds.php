<?php
 require "db_functions.php";
 require "authenticate.php";
 
 include("header.php");
 
 $error = false;
 $success = false;
 $loginerror = false;
 
 
 
 if ($login && $_SERVER["REQUEST_METHOD"] == "POST") {
   if (isset($_POST["tag"]) && isset($_POST["postText"])) {
 
     $conn = connect_db();
 
     $tag = mysqli_real_escape_string($conn, $_POST["tag"]);
    $postContent = mysqli_real_escape_string($conn, $_POST["postText"]);
 
       $sql = "INSERT INTO posts(idusuario, idcategoria, conteudopost, datahorapost)
               VALUES
               (1, '".$tag."', '".$postContent."', NOW());";
 
       if(mysqli_query($conn, $sql)){
         $success = true;
       }
       else {
         $error_msg = mysqli_error($conn);
         $error = true;
       }
   }
   else {
     $error_msg = "Por favor, preencha todos os dados.";
     $error = true;
   }
 } else {
   $loginerror = true;
 }
 ?>
<div id="newPost">
  <span class="sub">Publicar um novo post</span>
 
 <?php if ($success): ?>
   <h3 style="color:lightgreen;">Spotted enviado com sucesso! Aguarde a aprovação de um admin</h3>
 <?php endif; ?>
 
 <?php if ($loginerror): ?>
   <h3 style="color:white; background-color: DarkRed">Usuario não logado. Faça login ou cadastre-se. </h3>
 <?php endif; ?>
 
 <?php if ($error): ?>
   <h3 style="color:red;"><?php echo $error_msg; ?></h3>
 <?php endif; ?>
 
 
   <form id="submitPost" method="POST" action="spotteds.php">
     <select name="tag">
       <option value="1">Viu aquela pessoa e quer mandar uma cantada</option>
       <option value="2">Coisas aleatórias que não são cantadas direcionadas</option>
       <option value="3">Coisas de utilidade pública</option>
       <option value="4">Achou ou perdeu alguma coisa?</option>
       <option value="5">Pra vc que mora longe e precisa de uma carona pra ir pras aulas</option>
     </select> <br>
     <textarea name="postText" placeholder="Não seja um troll" cols="30" rows="5"></textarea>
     <br>
     <input type="submit" class="submit"></input>
   </form>
  </div> <!-- newPost div end -->
<?php include("footer.php");?>