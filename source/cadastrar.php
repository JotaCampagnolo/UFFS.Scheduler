<?php
	include "funcoes.php";
	session_start();
	uffs_conexao_bd();
	//Cadastrar aluno
	if(isset($_POST["cadastrar"])){
		$username = $_POST["username"];
		$password = $_POST["password"];
		$first_name = $_POST["first_name"];
		$last_name = $_POST["last_name"];
		$enrollment = $_POST["enrollment"];
		$email = $_POST["email"];
		$registry_date = date("Y-m-d");		
		$insere = "INSERT INTO `users`(`username`, `password`, `first_name`,`last_name`, `enrollment`, `email`, `registry_date`, `ban_status`, `user_role_id`) 
		VALUES ('$username', '$password', '$first_name','$last_name', '$enrollment', '$email', '$registry_date', 0, 0) ";
		mysqli_query($link,$insere);// or die("Nao inserido."); 	
	}
		//Cadastrar Turma
	if(isset($_POST["cadastrar_t"])){
		$username = $_POST["username"];
		$password = $_POST["password"];
		$first_name = $_POST["first_name"];
		$last_name = $_POST["last_name"];
		$enrollment = $_POST["enrollment"];
		$email = $_POST["email"];
		$registry_date = date("Y-m-d");		
		$insere = "INSERT INTO `users`(`username`, `password`, `first_name`,`last_name`, `enrollment`, `email`, `registry_date`, `ban_status`, `user_role_id`) 
		VALUES ('$username', '$password', '$first_name','$last_name', '$enrollment', '$email', '$registry_date', 0, 0) ";
		mysqli_query($link,$insere);// or die("Nao inserido."); 	
	}
	
?>
