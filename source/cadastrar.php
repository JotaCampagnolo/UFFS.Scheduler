<?php
	include "funcoes.php";
	session_start();
	$link = DBConection();
	//Cadastrar aluno
	if(isset($_POST["cadastrar"])){
		$username = $_POST["username"];
		$password = $_POST["password"];
		$first_name = $_POST["first_name"];
		$last_name = $_POST["last_name"];
		$enrollment = $_POST["enrollment"];
		$email = $_POST["email"];
		$registry_date = date("Y-m-d");		
		$sql  = "SELECT * FROM `users` WHERE email = '$email' OR username = '$username' OR enrollment = '$enrollment'";
		$result = mysqli_query($link,$sql);
		$retorna=mysqli_num_rows($result);
		if($retorna!=0){
			$_SESSION['status'] = 1; //erro username
			$_SESSION['status'] = 2; //erro email
			$_SESSION['status'] = 3; //erro enrollment
			$_SESSION['erro'] ="Já existe um cadastro com esses dados";
			header("Location: cadastro.html");
		}else{	
			$insere = "INSERT INTO `users`(`username`, `password`, `first_name`,`last_name`, `enrollment`, `email`, `registry_date`, `ban_status`, `user_role_uid`) 
			VALUES ('$username', '$password', '$first_name','$last_name', '$enrollment', '$email', '$registry_date', 0, 1) ";
			$result = mysqli_query($link,$insere);// or die("Nao inserido.");
			if($result){
				$_SESSION['status'] = 0; //Sucesso
				$_SESSION['sucess'] ="Usuário criado com Sucesso";
				header("Location: cadastro.html"); 	
			}else{
				$_SESSION['status'] = 4; //erro geral
			}
		}
	}

		//Cadastrar Turma
	if(isset($_POST["cadastrar_t"])){
		$year = $_POST["year"];
		$semester = $_POST["semester"];
		$shift = $_POST["shift"];
		$period = $_POST["period"];
		$registry_date = date("Y-m-d");	
		if(isset($_POST["name"]){
			$name = $_POST["name"];
		}else	
			$name = "CC - ".$period." Fase - ".$shift." - ".$year."/".$semester;
	
		$sql  = "SELECT * FROM `classes` WHERE name = '$name'";
		$result = mysqli_query($link,$sql);
		$retorna=mysqli_num_rows($result);
		if($retorna!=0){
			$_SESSION['erro'] ="Já existe uma turma com esse nome";
			header("Location: cadastro_turma.html");
		}else{	
		$insere = "INSERT INTO `classes`(`name`, `year`, `semester`,`shift`, `period`, `registry_date`) 
		VALUES ('$name', '$year', '$semester','$shift', '$registry_date') ";
		mysqli_query($link,$insere);// or die("Nao inserido."); 	
		if($result){
				$_SESSION['sucess'] ="Usuário criado com Sucesso";
				header("Location: cadastro.html"); 	
		}
	}
	
?>
