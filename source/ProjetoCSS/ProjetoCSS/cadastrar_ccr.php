 <?php
  include "funcoes.php";
  session_start();
  $link = DBConection();
  //Cadastrar turma
  if(isset($_POST["cadastrar_turma"])){
    $name = $_POST["name"];
    $year = $_POST["year"];
    $semester = $_POST["semester"];
    $shift = $_POST["shift"];
    $period = $_POST["period"];
    $registry_date = date("Y-m-d");

    if($_POST["name"] == '') { //cria um nome se o usuário nao digitou um
      $name = "CC - ".$period." Fase - ".$shift." - ".$year."/".$semester;
    }

    $consulta = "SELECT * FROM `classes` WHERE name = '$name' AND
          year = '$year' AND semester = '$semester' AND shift = '$shift' AND period = '$period'"; //pesquisa no banco se o nome ja existe
    $result = mysqli_query($link, $consulta);
    $retorna = mysqli_num_rows($result);

    if ($retorna != 0) {
      $_SESSION['status'] = 1; //nome da turma já existe

    } else {
      $insere = "INSERT INTO `classes`(`name`, `year`, `semester`,`shift`, `period`, `registry_date`)
            VALUES ('$name', '$year', '$semester','$shift', '$period',  '$registry_date') ";
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
          <form action = "cadastro_turma.php" class="form-horizontal" method="post" style="margin-top: -30px">
              <fieldset style="margin: 40px 20px 40px 20px">
                  <legend>Cadastro de Turma</legend>
          <?php
          if(isset($_SESSION['status'])){
            $erro = $_SESSION['status'];
            switch ($erro) {
              case 1: //turma já existe
                echo '
                  <div class="form-group" style="margin-bottom: -5px">
                    <div class="alert alert-danger" role="alert">
                      <b>Ops!</b>
                      <i>Sua inserção falhou. A Turma já está cadastrada!</i>
                    </div>
                  </div>';
                                break;
              case 4: //sucesso
                echo '
                  <div class="form-group" style="margin-bottom: -5px">
                    <div class="alert alert-success" role="alert">
                      <b>Sucesso!</b>
                      <i>A ultima Turma foi cadastrada com sucesso!</i>
                    </div>
                  </div>';
                break;
              default:
                break;
            }
          }
          session_unset($_SESSION['status']);
                  ?>
                  <div class="form-group">
                      <span class="fa fa-graduation-cap"></span>
                      <label>Nome da Turma:</label>
                      <input type="text" name="name" placeholder="CC - 1 Fase - Matutino - 2017/2" maxlength="50" class="form-control"/>
                      <div class="text-center" style="margin-top: 5px">
                        <i>Deixe em branco para que seja criado um nome automaticamente.</i>
                      <!-- "CC 1 Fase - Matutino - 2017/2" -->
                      </div>
                  </div>
                  <div class="form-group">
                      <span class="fa fa-calendar"></span>
                      <label>Ano de Ingresso</label>
                      <input type="number" name="year" value="2017" required class="form-control"/>
                  </div>
                  <div class="form-group">
                      <span class="fa fa-calendar"></span>
                      <label>Semestre de Ingresso:</label><i id="sem" style="margin-left: 5px">1</i>
                      <input type="range" name="semester"  onchange="document.getElementById('sem').innerHTML = this.value" min="1" max="2" value ="1" required />
                  </div>
                   <div class="form-group">
                     <span class="fa fa-clock-o"></span>
                     <label>Turno:</label>
                     <select required multiple class="form-control" name="shift" size="3" id="shift">
                       <option>Matutino</option>
                       <option>Vespertino</option>
                       <option>Noturno</option>
                     </select>
                 </div>
                  <div class="form-group">
                      <span class="fa fa-calendar"></span>
                      <label>Período:</label><i id="per" style="margin-left: 5px">1</i>
                      <input type="range" name="period"  onchange="document.getElementById('per').innerHTML = this.value" min="1" max="10" value="1" required />
                  </div>
                  <div class="form-group text-center">
                      <input type="submit" name="cadastrar_turma" value="Cadastrar" class="btn btn-success"/>
                      <input type="submit" name="alterar_turma" value="alterar" class="btn btn-warning"/>
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
