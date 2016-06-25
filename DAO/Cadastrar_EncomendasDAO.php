<?php




$conn = @mysql_connect('localhost', 'root', '');
mysql_query("SET CHARACTER SET utf8");
//mysql_query("SET NAMES utf8");
//mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci'"); // medida extrema, opcional

if (!$conn) {
    die('Could not connect: ' . mysql_error());
}

mysql_select_db("bd_emporio", $conn) or die(mysql_error());



include("../kint/Kint.class.php");





if( $_SERVER['REQUEST_METHOD']=='POST')
{
    if(isset($_POST['pago'])){

      $pago = $_POST['pago'];

    }else{
      $pago = 0;
    }



$sql = "INSERT INTO encomendas (cod_cliente,dtpedido,dtentrega,Valor,totalpago) VALUES (".$_POST["nome"].",'".$_POST["dtpedido"]."', '".$_POST['dtentrega']."',  '".str_replace(",",".",$_POST["total"])."', '".str_replace(",",".",$pago)."')";

//ddd($sql);
    //echo $resultado;
      mysql_query ($sql, $conn);
      $id_encomenda = mysql_insert_id();


    $totalprodutos = $_POST['totalDeproduto'];
//d($_POST,$totalprodutos);
    for( $i=0; $i < $totalprodutos; $i++ ) {

       $sql2 = "INSERT INTO produtos_has_encomedas (Produtos_cod_Produto,quantidade,Encomedas_cod_Encomenda) VALUES (".$_POST["produto_$i"].",  '".str_replace(",",".",$_POST["qtd_$i"])."', ".$id_encomenda.")";

//ddd($sql2);
              mysql_query ($sql2, $conn);


    }

  }
header("Location: ../encomendas.php");

?>
