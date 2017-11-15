<?php
    // Faz a chamada de sessões
    session_start();
    error_reporting(-1);
    ini_set('display_errors', 'On');

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
?>
