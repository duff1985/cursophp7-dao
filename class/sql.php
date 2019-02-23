<?php

class Sql extends PDO{

	private $conn;	//variavel de conexão

	public function __construct(){
		$this->conn = new PDO("mysql:host=localhost;dbname=dbphp7","admin","hsaobs58910409");
	}

	private function setParams($statment, $parameters = array()){
		foreach ($parameters as $key => $value) {
			$this->setParam($key, $value);
		}
	}

	private function setParam($statment, $key, $value){
		$statment->bindParam($key, $value);
	}

	public function query($rowQuery, $params = array()){
		$stmt = $this->conn->prepare($rowQuery);
		$this->setParams($stmt, $params);
		$stmt->execute();

		return $stmt;
	}

	public function select($rowQuery, $params = array()):array{
		$stmt = $this->query($rowQuery, $params);		//=> chamando a função query
		return $stmt->fetchALL(PDO::FETCH_ASSOC);


	}
}
?>