<?php
// require "db_functions.php";
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
              header("Location: " . dirname($_SERVER['SCRIPT_NAME']) . "/index.php");
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
        $telefoneCadastro = mysqli_real_escape_string($conn,$_POST["telefoneCadastro"]);
      }
      if (isset($_POST["emailCadastro"])) {
        $emailCadastro = mysqli_real_escape_string($conn,$_POST["emailCadastro"]);
      }

      if ($senhaCadastro == $confirmSenhaCadastro) {
        $senhaCadastro= md5($senhaCadastro);

        $sql = "INSERT INTO usuarios
                (nickname, senha, telefone, email) VALUES
                ('".$nicknameCadastro."', '".$senhaCadastro."', '".$telefoneCadastro."', '".$emailCadastro."');";

        if(mysqli_query($conn, $sql)){
          $success = true;
          $success_msg = "Usuario cadastrado com sucesso.";
          $_SESSION["nickname"] = $nicknameCadastro;
          $_SESSION["senha"] = $senhaCadastro;
          if (!empty($emailCadastro)) {
            $_SESSION["email"] = $emailCadastro;
          }
          if (!empty($telefoneCadastro)) {
            $_SESSION["telefone"] = $telefoneCadastro;
          }
          

        $sql2 = "SELECT MAX(idusuario)  AS 'id' FROM usuarios;";
        $result = mysqli_query($conn, $sql2);
        $row = mysqli_fetch_assoc($result );
        $_SESSION["idusuario"] = $row['id'];

          
          sleep(3);
          header( "refresh:5;url=index.php" );
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


<div id="header">  

<div id="colsContainer">

    <?php if ($success): ?>
          <h3 style="color:lightgreen;"><?= $success_msg ?></h3>
        <?php endif; ?>

        <?php if ($error): ?>
          <h3 style="color:red;"><?php echo $error_msg; ?></h3>
        <?php endif; ?>

        
  <div id="gridLogin">
  <br/><br/>
    <div class="loginCol" id="leftCol">
      <span class="sub">Já possuo conta</span>
      <br/><br/> 
 <script type="text/javascript" src="validacaoTelefone.js"> </script>


      <form id="loginForm" action="login.php" method="POST" class="loginForm">
        <input type="text" placeholder="Nickname" name="nicknameLogin" class="loginInputs" required="required"> <br>
       
        <input type="password" placeholder="senha" name="senhaLogin" class="loginInputs" required="required">
        <button id="logar" class="submit" name="submit" value="logar">Login</button>
      </form>
    </div>

    <div class="loginCol" id="rightCol">
      <span class="sub">Quero me cadastrar</span>
      <br/><br/>
      <form id="signupForm" action="login.php" method="POST" class="loginForm">
      
        <input type="text" minlength="3" maxlength="20" placeholder="Nickname desejado (3-20 caracteres)" required="required" name="nicknameCadastro" class="loginInputs" 
        <?php if ($error): ?>
          value = <?= $_POST["nicknameCadastro"]; ?>
        <?php endif; ?>
        > <br>
        <input minlength="8" maxlength="32" required="required" type="password" placeholder="Senha (8-32 caracteres)" name="senhaCadastro" class="loginInputs">
        <input minlength="8" maxlength="32" required="required" type="password" placeholder="Confirme a senha" name="confirmSenhaCadastro" class="loginInputs">
        <input minlength="15" maxlength="15" id="telefoneCadastro" type="tel" pattern="^\(d{2})\d{4}-\d{4}$" placeholder="Whatsapp (opcional)" name="telefoneCadastro" class="loginInputs" 
<?php if ($error): ?>
        value = <?= $_POST["telefoneCadastro"]; ?>
<?php endif; ?>
        >
        <input minlength="3" maxlength="35" type="email" placeholder="Email (opcional)" name="emailCadastro" class="loginInputs" 
<?php if ($error): ?>
        value = <?= $_POST["emailCadastro"]; ?>
<?php endif; ?>
        >
        <button id="logar" class="submit" name="submit" value="cadastrar">Cadastrar</button>
      </div>
    </div>
  </div>
</div>

<?php include("footer.php");?>