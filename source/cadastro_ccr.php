 <?php
	include "funcoes.php";
	session_start();
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
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- As 3 meta tags acima *devem* vir em primeiro lugar dentro do `head`; qualquer outro conteúdo deve vir *após* essas tags -->
    <title>Cadastro de CCR</title>
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
    <!-- jQuery (obrigatório para plugins JavaScript do Bootstrap) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Inclui todos os plugins compilados (abaixo), ou inclua arquivos separadados se necessário -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
