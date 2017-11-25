<?php
require "db_functions.php";
// require "authenticate.php";

include("header.php");

$error = false;
$success = false;
$loginerror = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST['submit'] == 'logar') {
     if (!empty($_POST["nicknameLogin"]) && !empty($_POST["senhaLogin"])) {

        $conn = connect_db();

        $nicknameLogin = mysqli_real_escape_string($conn,$_POST["nicknameLogin"]);
        $senhaLogin = mysqli_real_escape_string($conn,$_POST["senhaLogin"]);
        $senhaLogin = md5($senhaLogin);

        $sql = "SELECT * FROM usuarios
                WHERE nickname = '".$nicknameLogin."';";

        $result = mysqli_query($conn, $sql);
        if($result){
          if (mysqli_num_rows($result) > 0) {
            $usuario = mysqli_fetch_assoc($result);

            if ($usuario["senha"] == $senhaLogin) {

              $_SESSION["idusuario"] = $usuario["idusuario"];
              $_SESSION["senha"] = $usuario["senha"];
              $_SESSION["nickname"] = $usuario["nickname"];
              $_SESSION["telefone"] = $usuario["telefone"];
              $_SESSION["email"] = $usuario["email"];

              // $success = true;
              // $success_msg = "Login realizado com sucesso.";
              header("Location: " . dirname($_SERVER['SCRIPT_NAME']) . "/login.php");
              // exit();
            }
            else {
              $error_msg = "Senha incorreta!";
              $error = true;
            }
          }
          else{
            $error_msg = "Usuário não encontrado!";
            $error = true;
          }
        }
        else {
          $error_msg = mysqli_error($conn);
          $error = true;
        }
      }
      else {
        $error_msg = "Por favor, preencha todos os dados no login.";
        $error = true;
      }

  }
  else if ($_POST['submit'] == 'cadastrar') {
    if (!empty($_POST['nicknameCadastro']) && !empty($_POST['senhaCadastro']) && !empty($_POST['confirmSenhaCadastro'])) {
      $conn = connect_db();

      $nicknameCadastro = mysqli_real_escape_string($conn,$_POST["nicknameCadastro"]);
      $senhaCadastro = mysqli_real_escape_string($conn,$_POST["senhaCadastro"]);
      $confirmSenhaCadastro = mysqli_real_escape_string($conn,$_POST["confirmSenhaCadastro"]);
      if (isset($_POST["telefoneCadastro"])) {
        $telefone = mysqli_real_escape_string($conn,$_POST["telefoneCadastro"]);
      }
      if (isset($_POST["emailCadastro"])) {
        $email = mysqli_real_escape_string($conn,$_POST["emailCadastro"]);
      }

      if ($senhaCadastro == $confirmSenhaCadastro) {
        $senhaCadastro= md5($senhaCadastro);

        $sql = "INSERT INTO usuarios
                (nickname, senha, telefone, email) VALUES
                ('".$nicknameCadastro."', '".$senhaCadastro."', '".$telefone."', '".$email."');";

        if(mysqli_query($conn, $sql)){
          $success = true;
          $success_msg = "Usuario cadastrado com sucesso";
        }
        else {
          $error_msg = mysqli_error($conn);
          $error = true;
        }
      }
      else {
        $error_msg = "Senha não confere com a confirmação.";
        $error = true;
      }
    }
    else {
      $error_msg = "Por favor, preencha todos os dados obrigatórios.";
      $error = true;
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


  <div id="gridLogin">
    <div class="loginCol" id="leftCol">
      <span class="sub">Já possuo conta</span>
        

      <form id="loginForm" action="login.php" method="POST" class="loginForm">
      
        <input type="text" placeholder="Nickname" name="nicknameLogin" class="loginInputs"> <br>
       
        <input type="password" placeholder="senha" name="senhaLogin" class="loginInputs">
        <button id="logar" class="submit" name="submit" value="logar">Login</button>
      </form>
    </div>

    <div class="loginCol" id="rightCol">
      <span class="sub">Quero me cadastrar</span>
      <form id="signupForm" action="login.php" method="POST" class="loginForm">
      
        <input type="text" placeholder="Nickname desejado (3-20 caracteres)" name="nicknameCadastro" class="loginInputs"> <br>
        <input type="password" placeholder="Senha (8-32 caracteres)" name="senhaCadastro" class="loginInputs">
        <input type="password" placeholder="Confirme a senha" name="confirmSenhaCadastro" class="loginInputs">
        <input type="text" placeholder="Whatsapp (opcional)" name="telefoneCadastro" class="loginInputs">
        <input type="text" placeholder="Email (opcional)" name="emailCadastro" class="loginInputs">
        <button id="logar" class="submit" name="submit" value="cadastrar">Cadastrar</button>
      </form>
    </div>
  </div>
</div>

<?php include("footer.php");?>