<?php
  error_reporting(-1);
  ini_set('display_errors', 'On');

    session_start();
    include "funcoes.php";
    $_SESSION['status'] = 0;
    $link = DBConection();

    if(isset($_POST["Gravar"])){
     $role = $_POST["role"];

     $sql  = "SELECT * FROM `classes` WHERE uid = '$role'";
     $result = mysqli_query($link,$sql);
     $retorna=mysqli_num_rows($result);
     if($retorna==1){
       $row = mysqli_fetch_array($result);
       $uid= $row[0];
       $year1 = $row[2];
       $semester1 = $row[3];
       $shift1 = $row[4];
       $period1 = $row[5];
       //alteração
       $year = $_POST["year"];
       $semester = $_POST["semester"];
       $shift = $_POST["shift"];
       $period = $_POST["period"];
       $registry_date = date("Y-m-d");
       if(isset($_POST["name"]) && $_POST["name"]){
         $name = $_POST["name"];
       }else{
         $name = "CC - ".$period." Fase - ".$shift." - ".$year."/".$semester;
       }
         $up = "UPDATE classes SET name='$name', year='$year', semester='$semester', shift='$shift',period='$period' WHERE '$uid'=uid";
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
                      <label>Selecione a Turma:</label>
                      <select id="image_selection" name="role" class="form-control">
                          <?php
                              $class = mysqli_query($link, "SELECT * FROM classes");
                              while ($row = mysqli_fetch_array($class)){
                                  echo "<option value=\"$row[0]\">" . $row[1] . "</option>";
                              }
                          ?>
                      </select>
                  </div>
                  <div class="form-group">
                      <span class="fa fa-graduation-cap"></span>
                      <label>Novo Nome da Turma:</label>
                      <input type="text" id="name" name="name" placeholder="CC - 1 Fase - Matutino - 2017/2" maxlength="40" class="form-control"/>
                      <div class="text-center" style="margin-top: 5px">
                        <i>Deixe em branco para que seja criado um nome automaticamente.</i>
                      <!-- "CC 1 Fase - Matutino - 2017/2" -->
                      </div>
                  </div>
                  <div class="form-group">
                      <span class="fa fa-calendar"></span>
                      <label>Ano de Ingresso:</label>
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
                     <select multiple class="form-control" name="shift" required size="3" id="semester">
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
                      <button type="submit" class="btn btn-success" name="Gravar" value="Gravar" style="margin: 5px"><span class="fa fa-check" style="margin-right: 8px"></span>Gravar Alteração</button>
                      <button type="reset" class="btn btn-warning" name="Limpar" value="Limpar" style="margin: 5px"><span class="fa fa-trash" style="margin-right: 8px"></span>Limpar</button>
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


    <!-- jQuery (obrigatório para plugins JavaScript do Bootstrap) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Inclui todos os plugins compilados (abaixo), ou inclua arquivos separadados se necessário -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
