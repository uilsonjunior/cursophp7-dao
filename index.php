<?php 

require_once("config.php");

/*$sql = new Sql(); usado anteriormente

$usuarios = $sql->select("SELECT * FROM TB_USUARIOS");

echo json_encode($usuarios);*/

$root = new Usuario();

$root->loadById(3);

echo $root;

 ?>