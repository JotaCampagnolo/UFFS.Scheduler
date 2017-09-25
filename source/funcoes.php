<?php
	function uffs_conexao_bd() {
		$servidor = 'localhost';
		$banco = 'mydb'; //nome do banco
		$usuario = 'root'; //usuario
		$senha = '123'; //senha
		$link = mysqli_conect($servidor, $usuario, $senha) or die(mysql_error());
		$db = mysqli_select_db($banco,$link) or die(mysql_error());
		/*
		if(!$link) {
			echo "erro ao conectar ao banco de dados!";
			exit();
		}
		*/
	}
	
	function uffs_login_user() {
		
		
	}
?>
