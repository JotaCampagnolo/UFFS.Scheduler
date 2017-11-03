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
              <a class="nav-link js-scroll-trigger" href="#services">Cadastros</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#portfolio">Portifolio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#about">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#team">Team</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Header -->
    <header class="masthead">
    <div class="container">
      <div class="row">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-6">
          <form action = "funcoes.php" class="form-horizontal" method="post" style="margin-top: -30px">
              <fieldset style="margin: 40px 20px 40px 20px">
                  <legend>Login</legend>
                  <?php
                  if(isset($_SESSION['status']) && $_SESSION['status']== 1){
                    echo '<div class="form-group" style="margin-bottom: -5px">
                      <div class="alert alert-danger" role="alert">
                        <b>Ops!</b>
                        <i>Login falhou. Verifique os dados inseridos!</i>
                      </div>
                    </div>';
                  }
                  if(isset($_SESSION['status']) && $_SESSION['status'] == 2){
                    echo '<div class="form-group" style="margin-bottom: -5px">
                      <div class="alert alert-success" role="alert">
                        <b>Uhull!</b>
                        <i>Login Perfeito. Vai timão!</i>
                      </div>
                    </div>';
                  }
                  unset($_SESSION['status']);
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
                      <input type="submit" name="novoCadastro" value="Novo Cadastro" class="btn btn-warning"/>
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
