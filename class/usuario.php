<?php

class usuario{
	private $idusuario;
	private $dessenha;
	private $deslogin;
	private $dtcadastro;

	public function getIdusuario(){
		return $this->idusuario;
	}
	public function setIdusuario($value){
		$this->idusuario = $value;
	}
	public function getDessenha(){
		return $this->dessenha;
	}
	public function setDessenha($value){
		$this->dessenha = $value;
	}
	public function getDeslogin(){
		return $this->deslogin;
	}
	public function setDeslogin($value){
		$this->deslogin = $value;
	}
	public function getDtcadastro(){
		return $this->dtcadastro;
	}
	public function setDtcadastro($value){
		$this->dtcadastro = $value;
	}


	public function loadById($id){		//=> metodo que carregua os dados pelo ID
		$sql = new Sql();				//=> instaciando a classe Sql

	//=> chamando o metodo select da classe sql
		$result = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario=:ID", array(	//=> ($rowQuery, $params)
			":ID"=>$id 		//=> :ID
		));		

		if(count($result)>0){		//=> se existe pelo meno 1 registro
			$row = $result[0];		//=> 

			$this->setIdusuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));

		}
	}

	public static function getList(){		// => metodo estatico que carrega varios dados - lista
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
	}

	public static function search($login){
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
			":SEARCH"=>"%".$login."%"
		));
	}

	public function login($login, $password){
		$sql = new Sql();				//=> instaciando a classe Sql

	//=> chamando o metodo select da classe sql
		$result = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin=:LOGIN AND dessenha=:PASSWORD" , array(	//=> ($rowQuery, $params)
			":LOGIN"=>$login, 		//=> :ID
			":PASSWORD"=>$password 		//=> :ID
		));		

		if(count($result)>0){		//=> se existe pelo meno 1 registro
			$row = $result[0];		//=> 

			$this->setIdusuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));

		}else{
			throw new Exception("Login e/ou Senha Invalidos.");
			
		}
	}
	

	public function __toString(){		//=> metodo que imprime os dados
		return json_encode(array(
			"idusuario"=>$this->getIdusuario(),
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y h:i:s")

		));

	}
}





?>