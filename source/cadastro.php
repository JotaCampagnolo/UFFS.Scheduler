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
		}else{	
			$insere = "INSERT INTO `users`(`username`, `password`, `first_name`,`last_name`, `enrollment`, `email`, `registry_date`, `ban_status`, `user_role_uid`) 
			VALUES ('$username', '$password', '$first_name','$last_name', '$enrollment', '$email', '$registry_date', 0, 1) ";
			$result = mysqli_query($link,$insere);// or die("Nao inserido.");
			if($result){
				$_SESSION['status'] = 0; //Sucesso
			}else{
				$_SESSION['status'] = 4; //erro geral
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
    <title>Página de Cadastro</title>
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
          <form action = "cadastro.php" class="form-horizontal" method="post" style="margin-top: -30px">
              <fieldset style="margin: 40px 20px 40px 20px">
                  <legend>Cadastro de Usuário</legend>
                  <?php
					if(isset($_SESSION['status'])){
						$a = $_SESSION['status'];
						switch($a){
							case (0):{
								echo 'teste';//aqui vai as div
								break;
							}
							case (1):{
								echo 'teste1';//aqui vai as div
								break;
							}
							case (2):{
								echo 'teste';//aqui vai as div
								break;
							}
							case (3):{
								echo 'teste';//aqui vai as div
								break;
							}
							case (4):{
								echo 'teste';//aqui vai as div
								break;
							}
						}
					}
                  ?>
                  <div class="form-group">
                      <span class="fa fa-user"></span>
                      <label>Nome:</label>
                      <input type="text" name="first_name" placeholder="Nome" maxlength="20" required class="form-control"/>
                  </div>
                  <div class="form-group">
                      <span class="fa fa-user"></span>
                      <label>Sobrenome:</label>
                      <input type="text" name="last_name" placeholder="Sobrenome" maxlength="20" required class="form-control"/>
                  </div>
                   <div class="form-group">
                      <span class="fa fa-user"></span>
                      <label>Nome de Usuário:</label>
                      <input type="text" name="username" placeholder="Nome de Usuário" maxlength="20" required class="form-control"/>
                  </div>
                   <div class="form-group">
                      <span class="fa fa-address-card"></span>
                      <label>Matricula:</label>
                      <input type="text" name="enrollment" placeholder="Matricula" maxlength="20"required class="form-control"/>
                  </div>
                  <div class="form-group">
                      <span class="fa fa-envelope"></span>
                      <label>Email:</label>
                      <input type="email" name="email" placeholder="email@dominio" maxlength="40" required class="form-control"/>
                  </div>
                  <div class="form-group">
                      <span class="fa fa-key"></span>
                      <label>Senha</label>
                      <input type="password" name="password" placeholder="**********" maxlength="20" required class="form-control"/>
                  </div>
                  <div class="form-group">
                      <span class="fa fa-key"></span>
                      <label>Confirme a Senha</label>
                      <input type="password" name="password_c" placeholder="**********" maxlength="20" required class="form-control"/>
                  </div>

                  <div class="form-group text-center">
                      <input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-success"/>
                      <input type="submit" value="Já tenho cadastro" class="btn btn-warning"/>
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
