<?php 

class Usuario {

	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	public function getIdUsuario(){
		return $this->idusuario;
	}

	public function setIdUsuario($value){
		$this->idusuario = $value;
	}

	public function getDeslogin(){
		return $this->deslogin;
	}

	public function setDeslogin($value){
		$this->deslogin = $value;
	}

	public function getDessenha(){
		return $this->dessenha;
	}

	public function setDessenha($value){
		$this->dessenha = $value;
	}

	public function getDtcastro(){
		return $this->dtcadastro;
	}

	public function setDtcastro($value){
		$this->dtcadastro = $value;
	}

	public function loadById($id){

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM TB_USUARIOS WHERE IDUSUARIO = :ID", array(
			":ID"=>$id
		));

		//if (isset($results)) {// 

		if (count($results) > 0 ){
			$this->setData($results[0]);
		}

	}

	public static function getList(){
		$sql = new Sql();

		return $sql->select("SELECT * FROM TB_USUARIOS ORDER BY deslogin");
	}

	public static function search($login){
		$sql = new Sql();

		return $sql->select("SELECT * FROM TB_USUARIOS WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
			":SEARCH"=>"%".$login."%"
		));
	}

	public function login($login, $senha){

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM TB_USUARIOS WHERE deslogin = :LOGIN AND dessenha = :SENHA", array(
			":LOGIN"=>$login,
			":SENHA"=>$senha
		));

		//if (isset($results)) {// 
	   if (count($results) > 0 ){
			
			$this->setData($results[0]);

		}else{
			throw new Exception("Login/senha incorretos!");
			
		}

	}

	public function setData($data){

		$this->setIdUsuario($data['idusuario']);
		$this->setDeslogin($data['deslogin']);
		$this->setDessenha($data['dessenha']);
		$this->setDtcastro(new DateTime($data['dtcadastro']));

	}

	public function insert(){

		$sql = new Sql();

		$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :SENHA)",array(
			':LOGIN'=>$this->getDeslogin(),
			':SENHA'=>$this->getDessenha()
		));

		if (count($results) > 0){
			$this->setData($results[0]);
		}


	}

	public function update($login,$senha){

		$this->setDeslogin($login);
		$this->setDessenha($senha);

		$sql = new Sql();

		$sql->query("UPDATE TB_USUARIOS SET deslogin = :LOGIN, dessenha = :SENHA WHERE idusuario = :ID",
			array(
				':LOGIN'=>$this->getDeslogin(),
				':SENHA'=>$this->getDessenha(),
				':ID'=>$this->getIdUsuario()
			)
		);

	}

	public function delete(){

		$sql = new Sql();

		$sql->query("DELETE FROM TB_USUARIOS WHERE IDUSUARIO = :ID", array(
			':ID'=>$this->getIdUsuario()
		));

		$this->limpaDadosUsuario();

	}

	public function limpaDadosUsuario(){

		$this->setIdUsuario(0);
		$this->setDeslogin("");
		$this->setDessenha("");
		$this->setDtcastro(new DateTime());
		//pode mudar tudo para nulo
	}

	public function __construct($login="", $senha=""){

		$this->setDeslogin($login);
		$this->setDessenha($senha);

	}

	public function __toString(){
		return json_encode(array(
			"idusuario"=>$this->getIdUsuario(),
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
			"dtcadastro"=>$this->getDtcastro()->format("d/m/Y H:i:s")
		));
	}

}

 ?>