<?php

class db{
	
	private $host = '127.0.0.11';

	private $usuario = 'root';

	private $senha ='';

	//DB
	private $database = 'onlibrary';

	//---------------------------------------
	//Função que executará a conexão do PHP e MySQL

	public function conecta_mysql(){


		$conexao = mysqli_connect($this->host, $this->usuario, $this->senha, $this->database);
		//Agora a conexão já foi estabelecida!

		mysqli_set_charset($conexao, 'utf8');


		if(mysqli_connect_errno()) {
			echo 'Erro ao tentar conectar-se com o BD MySQL: '.mysqli_connect_error();
		}
		return $conexao;

	}

}


?>