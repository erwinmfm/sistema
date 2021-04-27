<?php 

session_start();
if(isset($_SESSION['usuario'])){

	require_once "../../classes/conexao.php";
	require_once "../../classes/vendas.php";

	$objv= new vendas();


	$c= new conectar();
	$conexao=$c->conexao();
	$idvenda=$_GET['idvenda'];

 $sql="SELECT ve.id_venda,
		ve.dataCompra,
		ve.id_cliente,
		pro.nome,
        pro.preco,
        pro.descricao
	from vendas  as ve 
	inner join produtos as pro
	on ve.id_produto=pro.id_produto
	and ve.id_venda='$idvenda'";

$result=mysqli_query($conexao,$sql);

	$ver=mysqli_fetch_row($result);

	$comp=$ver[0];
	$data=$ver[1];
	$idcliente=$ver[2];

 ?>

<!DOCTYPE html>
<html lang="pt-BR" dir="ltr">

<head>
    <title>RELATORIO</title>

    <script src="lib/jquery-3.2.1.min.js"></script>
    <script src="js/funcoes.js"></script>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="../../lib/bootstrap/css/bootstrap.css">
    
    <style>
        *{
            font-family: sans-serif;
        }
    </style>
    
</head>

<body>

    <table>
        <tr>
            <td>
                <img src="../../img/phpoo.png" width="100" height="100">
            </td>
            <td><h2>Relatório de Vendas</h2></td>
        </tr>
    </table>

    <hr>

    <br>

    <table class="table">
        <tr>
            <td>Data:
                <?php echo date("d/m/Y", strtotime($data)) ?>
            </td>
        </tr>
        <tr>
            <td>Comprovante: <?php echo $comp ?></td>
        </tr>
        <tr>
            <td>Cliente: <?php echo $objv->nomeCliente($idcliente); ?></td>
        </tr>
    </table>


    <table class="table">
        <tr>
            <td>Produto</td>
            <td>Preco</td>
            <td>Quantidade</td>
            <td>Descricao</td>
        </tr>

        <?php 
 			$sql="SELECT ve.id_venda,
						ve.dataCompra,
						ve.id_cliente,
						pro.nome,
				        pro.preco,
				        pro.descricao,
				        ve.quantidade,
				        ve.total_venda
					from vendas  as ve 
					inner join produtos as pro
					on ve.id_produto=pro.id_produto
					and ve.id_venda='$idvenda'";

			$result=mysqli_query($conexao,$sql);
			$total=0;
			while($mostrar=mysqli_fetch_row($result)):
 			 ?>

        <tr>
            <td><?php echo $mostrar[3]; ?></td>
            <td><?php echo "R$ ".$mostrar[4]; ?></td>
            <!--<td><//?php echo "R$ ".$mostrar[4].",00"; ?></td> -->
            <td><?php echo $mostrar[6]; ?></td>
            <td><?php echo $mostrar[5]; ?></td>
        </tr>
        <?php 
 				$total=$total + $mostrar[7];
 			endwhile;
 			 ?>
        <tr>
            <td>Total= <?php echo "R$ ".$total; ?></td>
            <!--<td>Total=  <//?php echo "R$ ".$total.",00"; ?></td> -->
        </tr>
    </table>

    <p>Gerado dia <?php $hoje = date('d/m/Y'); echo $hoje; ?> </p>
</body>

</html>


<?php
}else{
	header("location:../index.php");
}
?>