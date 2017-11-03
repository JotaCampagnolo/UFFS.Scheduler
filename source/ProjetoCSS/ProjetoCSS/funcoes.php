<?php
    // Faz a chamada de sessões
    session_start();

    //função de conexão ao banco
    function DBConection(){
        $host = "localhost";
        $user = "root";
        $pass = "Jq3hf!eH";
        $database = "uffsscheduler";
        $link = mysqli_connect($host, $user, $pass, $database);
        if (!$link) {
                echo "Error: Falha ao conectar-se com o banco de dados MySQL." . PHP_EOL;
                echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
                echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
                exit;
        }
        return $link;
    }
    // função da página de edição das turmas
    if(isset($_POST["change"])){
        $link = DBConection();
        $role = $_POST["role"];
        $sql  = "SELECT * FROM `classes` WHERE name = '$role'";
        $result = mysqli_query($link,$sql);
        $retorna=mysqli_num_rows($result);
    if($retorna!=0){
            $row = mysqli_fetch_array($result);
            $year = $_POST["year"];
            $semester = $_POST["semester"];
            $shift = $_POST["shift"];
            $period = $_POST["period"];
            $registry_date = date("Y-m-d");
            if(isset($_POST["name"])){
                    $name = $_POST["name"];
                }else{
                $name = "CC - ".$period." Fase - ".$shift." - ".$year."/".$semester;
                $up = "UPDATE classes SET year='$year', semester='$semester', shift='$shift',period='$period' WHERE $role=name";
                $result = mysqli_query($link,$up);
                $retorna=mysqli_num_rows($result);
                if($retorna == 1){
                    echo "Sucesso: Atualizado corretamente!";
                }else{
                    echo "Aviso: Não foi atualizado!";
                }
                }
            }
    }
        /*
        JardelAnton
        JardelAnton123
        */
        // Função de login
      if(isset($_POST['login'])){
        $link = DBConection();
        $user = $_POST['user'];
        unset($_SESSION['status']);
        $password = $_POST['password'];
        $sql  = "SELECT * FROM `users` WHERE email = '$user' OR username = '$user' OR enrollment = '$user'";
        $result = mysqli_query($link,$sql);
        $retorna=mysqli_num_rows($result);
        $row = mysqli_fetch_array($result);
        if($retorna==1){  // retornando uma tupla somente, existe somente um usuário com o login.
          $sql  = "SELECT * FROM `users` WHERE password = '$password' and uid = '$row[0]'";
          $result = mysqli_query($link,$sql);
          $retorna=mysqli_num_rows($result);
            $row = mysqli_fetch_array($result);
          if($retorna == 1){
            $_SESSION['login'] = $row[0];
            //$_SESSION['status'] = 2; //Sucesso username
            header("Location: index.html");
          }else{
            $_SESSION['status'] = 1; //erro password
            header("Location: login.php");
          }
        }else{
            $_SESSION['status'] = 1; //erro username
            echo "login".$retorna;
          }
      }
          else if(isset($_POST['novoCadastro'])){
            header("Location: cadastro.php");
          }

?>
