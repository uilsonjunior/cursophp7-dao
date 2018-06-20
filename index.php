<?php 

require_once("config.php");

/*$sql = new Sql(); usado anteriormente

$usuarios = $sql->select("SELECT * FROM TB_USUARIOS");

echo json_encode($usuarios);*/


// carrega um usuario 
//$root = new Usuario();
//$root->loadById(3);
//echo $root;

//carrega uma lista de usuarios

//$lista = Usuario::getList();

//echo json_encode($lista);

//carrega uma lista buscnado pelo login

//$busca = Usuario::search("us");

//echo json_encode($busca);

//carrega usuario usando o login e senha

//$usuario = new Usuario();
//$usuario->login("user","12345");

//echo $usuario;

// inserção de dados

//$aluno = new Usuario("aluno","senha");

//$aluno->insert();

//echo $aluno;

$usuario = new Usuario();

$usuario->loadById(6);

$usuario->update("professor","xavier");

echo $usuario;
 ?>