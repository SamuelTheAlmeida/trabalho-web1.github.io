<?php
  session_start();

  if (isset($_SESSION["idusuario"]) && isset($_SESSION["nickname"]) && isset($_SESSION["senha"])) {
    $login = true;
    $idusuario = $_SESSION["idusuario"];
    $nickname = $_SESSION["nickname"];
    $senha = $_SESSION["senha"];
  }
  else{
    $login = false;
    $nickname = "não conectado";
  }

?>