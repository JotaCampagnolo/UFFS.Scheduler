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
		$consulta = "SELECT * FROM `users` WHERE email = '$email' OR username = '$username' OR enrollment = '$enrollment'";
		$result = mysqli_query($link, $consulta);
		$retorna = mysqli_num_rows($result);

		if ($retorna != 0) { //todos esse são tratados igualmente
			$_SESSION['status'] = 1; //erro username ou email ou enrollment
		} else {
			$insere = "INSERT INTO `users`(`username`, `password`, `first_name`,`last_name`, `enrollment`, `email`, `registry_date`, `ban_status`, `user_role_uid`)
			VALUES ('$username', '$password', '$first_name','$last_name', '$enrollment', '$email', '$registry_date', 0, 1) ";
			$result = mysqli_query($link, $insere); // or die("Nao inserido.");
			if ($result) {
				$_SESSION['status'] = 4; //sucesso
			} else {
				$_SESSION['status'] = 5; //erro geral
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
						$erro = $_SESSION['status'];
						switch ($erro) {
							case 1:
                                echo '
                                <div class="form-group" style="margin-bottom: -5px">
                                    <div class="alert alert-danger" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                        <b>Ops!</b>
                                        <i>Cadastro falhou. Usuário, Matrícula ou Email já está em uso!</i>
                                    </div>
                                </div>';
								break;
							case 4: // sucesso

								echo '
								<div class="form-group" style="margin-bottom: -5px">
									<div class="alert alert-success" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
										<i>Cadastro feito com sucesso!</i>
									</div>
								</div>';
								//$_SESSION['cadastro'];
								//header("Location: login.php");
								break;
							default:
								//echo 'post ainda não enviou nada';
								break;
						}
					}
					session_unset($_SESSION['status']);
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
                      <input type="text" name="enrollment" placeholder="Matricula" maxlength="10"required class="form-control"/>
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
                      <button type="submit" name="cadastrar" value="Cadastrar" class="btn btn-success" style="margin: 5px"><span class="fa fa-check" style="margin-right: 8px"></span>Cadastrar</button>
                      <a class="btn btn-primary" href="login.php" type="button" style="margin: 5px">
                          <span class="fa fa-sign-in" style="margin-right: 6px"></span>Já Tenho Cadastro
                      </a>
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
