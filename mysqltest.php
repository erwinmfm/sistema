<?php
    $banco = "sistema";
    $usuario = "root";
    $senha = "";
    $hostname = "localhost";

    $conn = mysql_connect($hostname,$usuario,$senha); 
    mysql_select_db($banco) or die( "Não foi possível conectar ao banco MySQL");

if (!$conn) {echo "Não foi possível conectar ao banco MySQL.
    "; exit;}
else {echo "Parabéns!! A conexão ao banco de dados ocorreu normalmente!.
";}
    mysql_close();
?>
