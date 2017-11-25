<?php
require "db_credentials.php";

function connect_db(){
  global $servername, $db_username, $db_password, $db_name;
  $conn = mysqli_connect($servername, $db_username, $db_password, $db_name);

  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  return($conn);
}

function disconnect_db($conn){
  mysqli_close($conn);
}

?>
