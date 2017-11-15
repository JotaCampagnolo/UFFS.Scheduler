 <?php
  include "funcoes.php";
  $link = DBConection();
  //Cadastrar CCR
  if(isset($_POST["Cadastrar"])){
    $code = $_POST["code"];
    $name = $_POST["name"];
    $class_uid = $_POST["Class"];
    //pegar direto do servidor
    $registry_date = date("Y-m-d");

    $consulta = "SELECT * FROM `ccrs` WHERE code = '$code' AND class_uid = '$class_uid'";
    $result = mysqli_query($link, $consulta);
    $retorna = mysqli_num_rows($result);

    if ($retorna != 0) { //todos esse são tratados igualmente
      $_SESSION['status'] = 1; //erro já existe CCR
    } else {
      $insere = "INSERT INTO `ccrs`(`code`, `name`, `registry_date`, `class_uid`) VALUES  ('$code', '$name', '$registry_date','$class_uid') ";
      $result = mysqli_query($link, $insere); // or die("Nao inserido.");
      if ($result) {
        $_SESSION['status'] = 2; //sucesso
      } else {
        $_SESSION['status'] = 3; //erro geral
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
        <a class="navbar-brand js-scroll-trigger" href="index.php#page-top">UFFS SCHEDULER</a>
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
                    <li><a href="login.php">Fazer Logout</a></li>
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

          <form action = "cadastro_ccr.php" class="form-horizontal" method="post" style="margin-top: -30px">
              <fieldset style="margin: 40px 20px 40px 20px">
                  <legend>Cadastro de CCR</legend>
                   <?php
                    if(isset($_SESSION['status'])){
                  if($_SESSION['status'] == 2){
                    echo '<div class="form-group" style="margin-bottom: -5px">
                        <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                            <b>Sucesso!</b>
                            <i>Componente Curricular adicionado com sucesso!</i>
                        </div>
                    </div>';
                  }
                  if($_SESSION['status'] == 1){
                      echo '<div class="form-group" style="margin-bottom: -5px">
                          <div class="alert alert-danger" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                              <b>Erro!</b>
                              <i>Componente Curricular já esta cadastrado!</i>
                          </div>
                      </div>';
                  }if($_SESSION['status'] == 3){
                      echo '<div class="form-group" style="margin-bottom: -5px">
                          <div class="alert alert-danger" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                              <b>Erro!</b>
                              <i>Occorreu um erro, tente mais tarde ou verifique com o Administrador!</i>
                          </div>
                      </div>';
                  }
        }
                  ?>
                  <div class="form-group">
                      <span class="fa fa-barcode"></span>
                      <label>Código:</label>
                      <input type="text" name="code" placeholder="GEX000" maxlength="6" required class="form-control"/>
                  </div>
                  <div class="form-group">
                      <span class="fa fa-book"></span>
                      <label>Nome do CCR:</label>
                      <input type="text" name="name" placeholder="Nome da Disciplina" maxlength="50" required class="form-control"/>
                  </div>
                  <div class="form-group">
                      <span class="fa fa-graduation-cap"></span>
                      <label>Turma do CCR:</label>
                      <select id="class" name="Class" class="form-control">
                        <option disable select value style="display:none"> Selecione uma turma: </option>>
                          <?php
                              $class = mysqli_query($link, "SELECT * FROM classes");
                              while ($row = mysqli_fetch_array($class)){
                                  echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
                              }
                               unset($_SESSION['status']);
                          ?>
                      </select>
                  </div>
                  <div class="form-group text-center">
                      <button type="submit" class="btn btn-success" name="Cadastrar"value="Cadastrar" style="margin: 5px"><span class="fa fa-check" style="margin-right: 8px"></span>Cadastrar</button>
                      <button type="reset" class="btn btn-warning" value="Limpar" style="margin: 5px"><span class="fa fa-trash" style="margin-right: 8px"></span>Limpar</button>
                      <a class="btn btn-danger" href="index.php" type="button" style="margin: 5px">
                          <span class="fa fa-close" style="margin-right: 6px"></span>Cancelar
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
