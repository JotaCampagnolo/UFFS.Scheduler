<?php
  error_reporting(-1);
  ini_set('display_errors', 'On');
    include "funcoes.php";
    $_SESSION['status'] = 0;
    $link = DBConection();

    if(isset($_POST["Gravar"])){
    $uid = $_POST["uid"];
    $code = $_POST["code"];
    $name = $_POST["name"];
    $class = $_POST["Class"];

     $sql  = "SELECT * FROM `ccrs` WHERE code='$code' AND name='$name' AND class_uid = '$class' AND uid <>'$uid'";
     $result = mysqli_query($link,$sql);
     $retorna=mysqli_num_rows($result);
     if($retorna==1){
     $_SESSION['status'] = 3; //erro
  }else{
      $uid = $_POST["uid"];
      $code = $_POST["code"];
      $name = $_POST["name"];
      $class = $_POST["Class"];
      $up = "UPDATE ccrs SET code = '$code', name='$name', class_uid ='$class' WHERE uid='$uid'";
      $retorna = mysqli_query($link,$up);
      if($retorna){
      $_SESSION['status'] = 1; //SUCESSO
      }else{
      $_SESSION['status'] = 2; //erro
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

        <form action = "editar_ccr.php" class="form-horizontal" method="post" style="margin-top: -30px">
              <fieldset style="margin: 40px 20px 40px 20px">
                  <legend>Edição de CCR</legend>
                    <?php
                    if(isset($_SESSION['status'])){
                      if($_SESSION['status'] == 1){
                        echo '<div class="form-group" style="margin-bottom: -5px">
                            <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                                <b>Sucesso!</b>
                                <i>CCR foi alterado com sucesso!</i>
                            </div>
                        </div>';
                      }
                      if($_SESSION['status'] == 2){
                          echo '<div class="form-group" style="margin-bottom: -5px">
                              <div class="alert alert-danger" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                                  <b>Erro!</b>
                                  <i>Ocorreu um erro ao tentar alterar o CCR!</i>
                              </div>
                          </div>';
                      }
                      if($_SESSION['status'] == 3){
                          echo '<div class="form-group" style="margin-bottom: -5px">
                              <div class="alert alert-danger" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                                  <b>Erro!</b>
                                  <i>Já existe esse CCR para esta turma!</i>
                              </div>
                          </div>';
                      }
                    }
                  ?>
                  <div class="form-group">
                      <span class="fa fa-graduation-cap"></span>
                      <label>CCR:</label>
                      <select id="ccr" name="uid" class="form-control">
                          <option selected >Selecione</option>
                          <?php
                              $class = mysqli_query($link, "SELECT * FROM ccrs cr JOIN classes cl  on cl.uid = cr.class_uid");
                              while ($row = mysqli_fetch_array($class)){
                                  echo '<option value="' . $row[0] . '">' . $row[1]. ' - '.$row[2] .' - '. $row[6] .'</option>';
                              }
                               unset($_SESSION['status']);
                          ?>
                      </select>
                  </div>
                 <div class="form-group">
                      <span class="fa fa-barcode"></span>
                      <label>Novo Código:</label>
                      <input type="text" name="code" placeholder="GEX000" maxlength="6" required class="form-control"/>
                  </div>
                  <div class="form-group">
                      <span class="fa fa-book"></span>
                      <label>Novo Nome do CCR:</label>
                      <input type="text" name="name" placeholder="Nome da Disciplina" maxlength="50" required class="form-control"/>
                  </div>
                   <div class="form-group">
                      <span class="fa fa-graduation-cap"></span>
                      <label>Nova Turma do CCR:</label>
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
                      <input type="submit" name="Gravar" value="Gravar" class="btn btn-success"/>
                      <input type="submit" value="Cancelar" class="btn btn-danger"/>
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
