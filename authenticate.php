<?php
  session_start();

  if (isset($_SESSION["nickname"]) && isset($_SESSION["senha"])) {
    $login = true;
    $nickname = $_SESSION["nickname"];
    $idusuario = $_SESSION["idusuario"];
    $senha = $_SESSION["senha"];
    if (!empty($_SESSION["email"])) {
      $email = $_SESSION["email"];
    }
    if (!empty($_SESSION["telefone"])) {
      $telefone = $_SESSION["telefone"];
    }
  }
  else{
    $login = false;
    $nickname = "não conectado";
  }

?>