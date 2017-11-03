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
     <?php
      include "funcoes.php";
      $link = DBConection();
    ?>
     <div class="container">
      <div class="row">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-6">
          <form action = "funcoes.php" class="form-horizontal" method="post" style="margin-top: -30px">
              <fieldset style="margin: 40px 20px 40px 20px">
                  <legend>Edição de Turma</legend>
                   <?php
                  if(isset($_SESSION['status']) == 1){
                    echo '<div class="form-group" style="margin-bottom: -5px">
                      <div class="alert alert-success" role="alert">
                        <b>Sucesso!</b>
                        <i>A Turma foi editada com sucesso!</i>
                      </div>
                    </div>';
                  }
                  if(isset($_SESSION['status']) == 2){
                    echo '<div class="form-group" style="margin-bottom: -5px">
                      <div class="alert alert-danger" role="alert">
                        <b>Ops!</b>
                        <i>Edição falhou. Já existe turma com esse nome!</i>
                      </div>
                    </div>';
                  }
                  ?>
                  <div class="form-group">
                      <span class="fa fa-graduation-cap"></span>
                      <label>Selecione a Turma:</label>
                      <select id="image_selection" name="role" class="form-control">
                          <?php
                              $class = mysqli_query($link, "SELECT * FROM classes");
                              while ($row = mysqli_fetch_array($class)){
                                  echo "<option>" . $row[1] . "</option>";
                              }
                          ?>
                      </select>
                  </div>
                  <div class="form-group">
                      <span class="fa fa-graduation-cap"></span>
                      <label>Novo Nome da Turma:</label>
                      <input type="text" id="name" name="name" placeholder="CC - 1 Fase - Matutino - 2017/2" maxlength="20" class="form-control"/>
                      <div class="text-center" style="margin-top: 5px">
                        <i>Deixe em branco para que seja criado um nome automaticamente.</i>
                      <!-- "CC 1 Fase - Matutino - 2017/2" -->
                      </div>
                  </div>
                  <div class="form-group">
                      <span class="fa fa-calendar"></span>
                      <label>Ano de Ingresso:</label>
                      <input type="number" name="year" placeholder="2017" required class="form-control"/>
                  </div>
                   <div class="form-group">
                      <span class="fa fa-calendar"></span>
                      <label>Semestre de Ingresso:</label><i id="sem" style="margin-left: 5px">1</i>
                      <input type="range" name="semester"  onchange="document.getElementById('sem').innerHTML = this.value" min="1" max="2" value ="1" required />
                  </div>
                  <div class="form-group">
                     <span class="fa fa-clock-o"></span>
                     <label>Turno:</label>
                     <select multiple class="form-control" size="3" id="semester">
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
                      <input type="submit" name="change" value="Gravar" class="btn btn-success"/>
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
