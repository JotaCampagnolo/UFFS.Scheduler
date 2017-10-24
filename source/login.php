<?php //17/10 - 07:55  to 8:29
	include "funcoes.php";
	session_start();
	$link = DBConection();
	
	$_SESSION['status'] = 0;
	if(isset($_POST['login'])){
		$user = $_POST['user'];
		//$password = md5($_POST['password']); implementar em 
		$password = $_POST['password'];
		$sql  = "SELECT * FROM `users` WHERE email = '$user' OR username = '$user' OR enrollment = '$user'";
		$result = mysqli_query($link,$sql);
		$retorna=mysqli_num_rows($result);
		$row = mysqli_fetch_array($result);
		if($retorna == 1){	// retornando uma tupla somente, existe somente um usuário com o login.
			$sql  = "SELECT * FROM `users` WHERE password = '$password' and uid = '$row[1]'";
			$result = mysqli_query($link,$sql);
			$retorna=mysqli_num_rows($result);
			if($retorna == 1){
				$_SESSION['login'] = $row['1'];
				header("Location: home.php");
			}else{
				$_SESSION['status'] = 1; //erro username
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- As 3 meta tags acima *devem* vir em primeiro lugar dentro do `head`; qualquer outro conteúdo deve vir *após* essas tags -->
    <title>Login</title>

	   <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- HTML5 shim e Respond.js para suporte no IE8 de elementos HTML5 e media queries -->
    <!-- ALERTA: Respond.js não funciona se você visualizar uma página file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <div class="container">
      <div class="row">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-6">
          <form action = "login.php" class="form-horizontal" method="post" style="margin-top: -30px">
              <fieldset style="margin: 40px 20px 40px 20px">
                  <legend>Login</legend>
                  <?php
                  if(isset($_SESSION['status']) == 1){
                    echo '<div class="form-group" style="margin-bottom: -5px">
                      <div class="alert alert-danger" role="alert">
                        <b>Ops!</b>
                        <i>Login falhou. Verifique os dados inseridos!</i>
                      </div>
                    </div>';
                  }
                  ?>
                  <div class="form-group">
                      <span class="fa fa-user"></span>
                      <label>Usuário | Matricula | E-mail:</label>
                      <input type="text" name="user" placeholder="Usuário | Matricula | E-mail" maxlength="20" required class="form-control"/>
                  </div>
                  <div class="form-group">
                      <span class="fa fa-key"></span>
                      <label>Senha:</label>
                      <input type="password" name="password" placeholder="**********" maxlength="20" required class="form-control"/>
                  </div>
                  <div class="form-group text-center">
                      <input type="submit" name ="login" value="Entrar" class="btn btn-success"/>
                      <input type="submit" value="Novo Cadastro" class="btn btn-warning"/>
                  </div>
                  <div class="form-group text-center">
                      <a href="recov.html">Esqueci Minha Senha</a>
                  </div>
          </fieldset>
          </form>
        </div>
        <div class="col-sm-3">

        </div>
      </div>
      <div class="row">

      </div>
    </div>


    <!-- jQuery (obrigatório para plugins JavaScript do Bootstrap) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Inclui todos os plugins compilados (abaixo), ou inclua arquivos separadados se necessário -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
