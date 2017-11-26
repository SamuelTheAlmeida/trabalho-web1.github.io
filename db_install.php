<?php
require 'db_credentials.php';

// Criar conexao
$conn = mysqli_connect($servername, $db_username, $db_password);

// Checar conexao
if (!$conn) {
    die("Falha ao conectar com o banco: " . mysqli_connect_error());
}

// Criar banco
$sql = "CREATE DATABASE $db_name";
if (mysqli_query($conn, $sql)) {
    echo "<br>BD " . $db_name . " criado com sucesso<br>";
} else {
    echo "<br>Error creating database: " . mysqli_error($conn);
}

// Usar banco
$sql = "USE $db_name";
if (mysqli_query($conn, $sql)) {
    echo "<br>BD em uso alterado para " . $db_name ."<br>";
} else {
    echo "<br>Error changing database: " . mysqli_error($conn);
}

// Criar tabelas
$sql = "CREATE TABLE usuarios 
  ( 
     idusuario INT NOT NULL PRIMARY KEY auto_increment, 
     nickname  VARCHAR(20) NOT NULL, 
     senha     VARCHAR(32) NOT NULL, 
     telefone  VARCHAR(15), 
     email     VARCHAR(50) 
  );";

$senhaAdmin = md5("123");

$sql .= "INSERT INTO usuarios(nickname, senha, telefone, email) VALUES
          ('master', '".$senhaAdmin."', '41999990000', 'spotted@yahoo.com.br');";

$sql .= "CREATE TABLE categorias 
  ( 
     idcategoria   INT NOT NULL PRIMARY KEY auto_increment, 
     nomecategoria VARCHAR(20) 
  );";

$sql .= "INSERT INTO categorias(nomecategoria) VALUES ('Cantada'),('Coisas Aleatorias'),('Utilidade Pública'),('Achados e Perdidos'),('Caronas');";

$sql .= "CREATE TABLE posts 
  ( 
     idpost       INT NOT NULL PRIMARY KEY auto_increment, 
     idusuario    INT, 
     idcategoria  INT, 
     conteudopost VARCHAR(300) NOT NULL CHECK(CHAR_LENGTH(conteudopost) >= 13), 
     datahorapost DATETIME, 
     aprovado BOOLEAN NOT NULL DEFAULT 0,
     FOREIGN KEY (idcategoria) REFERENCES categorias(idcategoria), 
     FOREIGN KEY (idusuario) REFERENCES usuarios(idusuario) 
  );
";

if (mysqli_multi_query($conn, $sql)) {
    echo "<br>Tabelas criadas com sucesso<br>";
} else {
    echo "<br>Error creating database: " . mysqli_error($conn);
}

mysqli_close($conn);

?>
