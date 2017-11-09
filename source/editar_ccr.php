<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- As 3 meta tags acima *devem* vir em primeiro lugar dentro do `head`; qualquer outro conteúdo deve vir *após* essas tags -->
    <title>Edição de Turma</title>
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
    <?php
      //include "funcoes.php";
      //$link = DBConection();
    ?>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-6">
          <form action = "editar_turma.php" class="form-horizontal" method="post" style="margin-top: -30px">
              <fieldset style="margin: 40px 20px 40px 20px">
                  <legend>Edição de Turma</legend>
                    <?php
                    if(isset($_SESSION['status'])){
                      if($_SESSION['status'] == 1){
                        echo '<div class="form-group" style="margin-bottom: -5px">
                            <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                                <b>Sucesso!</b>
                                <i>A turma foi alterada com sucesso!</i>
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
                                  <i>Esta turma já esta cadastrada!</i>
                              </div>
                          </div>';
                      }
                    }
                  ?>
                  <div class="form-group">
                      <span class="fa fa-graduation-cap"></span>
                      <label>CCR:</label>
                      <select id="class" name="Class" class="form-control">
                          <option selected >Selecione</option>
                          <?php
                              $class = mysqli_query($link, "SELECT * FROM ccrs");
                              while ($row = mysqli_fetch_array($class)){
                                  echo '<option value="' . $row[0] . '">' . $row[1] ." - ". $row[2]'</option>';
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
                          <option selected >Selecione</option>
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


    <!-- jQuery (obrigatório para plugins JavaScript do Bootstrap) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Inclui todos os plugins compilados (abaixo), ou inclua arquivos separadados se necessário -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
  

