<?php
// require "db_functions.php";
// require "authenticate.php";

include("header.php");

$error = false;
$success = false;
$loginerror = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
     if (!empty($_POST["nicknameLogin"]) && !empty($_POST["senhaLogin"]) && !empty($_POST["novaSenhaLogin"])) {

        $conn = connect_db();

        $nicknameLogin = mysqli_real_escape_string($conn,$_POST["nicknameLogin"]);
        $senhaLogin = mysqli_real_escape_string($conn,$_POST["senhaLogin"]);
        $novaSenhaLogin = mysqli_real_escape_string($conn,$_POST["novaSenhaLogin"]);

        if ($senhaLogin == $novaSenhaLogin) {
          $error = true;
          $error_msg = "A nova senha não pode ser igual à senha atual.";
        } else {
            $senhaLogin = md5($senhaLogin);
            $novaSenhaLogin = md5($novaSenhaLogin);

            $sql = "SELECT usuarios.senha FROM usuarios
            WHERE nickname = '".$nicknameLogin."';";

            $result = mysqli_query($conn, $sql);

            if($result) {
              $row = mysqli_fetch_assoc($result);
              if ($row["senha"] == $senhaLogin) {
                $query = "UPDATE usuarios SET senha = '".$novaSenhaLogin."' WHERE nickname = '".$nicknameLogin."' ; ";
                $result = mysqli_query($conn, $query);
                if ($result) {
                  $success = true;
                  $success_msg = "Senha alterada com sucesso";
                } else {
                  $error = true;
                  $error_msg = "Não foi possível alterar a senha.";
                }
              } else {
                $error = true;
                $error_msg = "Senha atual incorreta.";
              }
            } 
        }
      }
  }
        
        
        

?>
<?php if ($success): ?>
    <h3 style="color:lightgreen;"><?= $success_msg ?></h3>
    <?php endif; ?>
    <?php if ($error): ?>
        <h3 style="color:red;"><?php echo $error_msg; ?></h3>
    <?php endif; ?>


<div id="colsContainer">
    <div class="changeInfo" id="borders">
      <span class="sub">Bem vindo <?= $nickname ?></span><br>
      
	  <span>Informações da conta:</span><br>
	  <span>Nickname: <?= $nickname ?></span><br>
    <?php if (isset($email)): ?>
	   <span>E-mail: <?= $email ?></span><br>
   <?php endif; ?>
   <?php if (isset($telefone)): ?>
	  <span>Telefone: <?= $telefone ?></span><br>
  <?php endif; ?>
	  
	  <form id="loginForm" action="account.php" method="POST" class="loginForm">
      <input  minlength="3" maxlength="20" type="text" placeholder="Nickname" name="nicknameLogin" class="loginInputs"> <br>
      <input minlength="8" maxlength="32" required="required" type="password" type="password" placeholder="senha" name="senhaLogin" class="loginInputs">
  		<input minlength="8" maxlength="32" required="required" type="password" type="password" placeholder="senha" name="novaSenhaLogin" class="loginInputs">
      <button id="alterar" class="submit" name="submit" value="alterar">Alterar</button>
		<span><br></span><br>
    </form>
    </div>
</div>

<?php include("footer.php");?>