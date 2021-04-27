
<?php 
    require_once "../classes/conexao.php";
	require_once "../classes/vendas.php";
	session_start();
	if(isset($_SESSION['usuario'])){


 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Início</title>

	<?php require_once "menu.php" ?>
</head>
<body>
<br><br><br>
    <center><img src="../img/phpoo.png"></center>
    
</body>
</html>


<?php 
} else{
	header("location:../index.php");
}

 ?>
