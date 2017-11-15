 <?php
  include "funcoes.php";
  $link = DBConection();
  //Cadastrar aluno
  if(isset($_POST["cadastrar"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $passwordc = $_POST["password_c"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $enrollment = $_POST["enrollment"];
    $email = $_POST["email"];
    $registry_date = date("Y-m-d");
    $consulta = "SELECT * FROM `users` WHERE email = '$email' AND username = '$username' AND enrollment = '$enrollment' AND first_name = '$first_name' AND email = '$email'";
    $result = mysqli_query($link, $consulta);
    $retorna = mysqli_num_rows($result);
    $class = mysqli_query($link, $consulta);
    if ($retorna != 0 || $password !=$passwordc) { //todos esse são tratados igualmente
      $_SESSION['status'] = 1; //erro username ou email ou enrollment
    } else {
      $row = mysqli_fetch_array($class);
      $uid = $row['0'];
      $up = "UPDATE users SET password = '$password' WHERE uid='$uid'";
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
<html lang="pt-BR">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>UFFS - Scheduler</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="css/agency.min.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">UFFS SCHEDULER</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
               <div class="dropdown">
                  <a class="nav-link js-scroll-trigger" data-toggle="dropdown">Cadastros</a>
                  <span class="caret"></span></button>
                  <ul class="dropdown-menu">
                    <li><a href="cadastro_turma.php">Cadastrar Turma</a></li>
                    <li><a href="cadastro_ccr.php">Cadastrar CCR</a></li>
                  </ul>
                </div>
            </li>
            <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
               <div class="dropdown">
                  <a class="nav-link js-scroll-trigger" data-toggle="dropdown">Editar</a>
                  <span class="caret"></span></button>
                  <ul class="dropdown-menu">
                    <li><a href="editar_turma.php">Editar Turma</a></li>
                    <li><a href="editar_ccr.php">Editar CCR</a></li>
                  </ul>
                </div>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="index.php#portfolio">Portifolio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="index.php#about">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="index.php#contact">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="index.php#team">Team</a>
            </li>


              <?php if(isset($_SESSION['login'])){ echo '
            <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
               <div class="dropdown">
                  <a class="nav-link js-scroll-trigger" data-toggle="dropdown">'. $_SESSION['login'] .'</a>
                  <span class="caret"></span></button>
                  <ul class="dropdown-menu">
                    <li><a href="login.php">Fazer Login</a></li>
                  </ul>
                </div>
            </li>';}
            else echo'
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="login.php">Fazer Login</a>
            </li>';
            ?>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Header -->
    <header class="masthead">
    <div class="container" >
      <div class="row">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-6" style="position:relative; top:80px; left:0; right:0; bottom:0; opacity:1;">
          <form action = "login.php" class="form-horizontal" method="post" style="margin-top: -30px">
              <fieldset style="margin: 40px 20px 100px 20px">
                  <legend>Recuperação de Senha</legend>
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

            session_unset($_SESSION['status']);
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
                      <input type="submit" name ="cadastrar" value="Gravar" class="btn btn-success"/>
                      <input type="submit" name="novoCadastro" value="Novo Cadastro" class="btn btn-warning"/>
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
    </header>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Contact form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/agency.min.js"></script>

  </body>

</html>
