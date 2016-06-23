


<?php

$conn = @mysql_connect('localhost', 'root', '');
mysql_query("SET CHARACTER SET utf8");
//mysql_query("SET NAMES utf8");
//mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci'"); // medida extrema, opcional

if (!$conn) {
    die('Could not connect: ' . mysql_error());
}

mysql_select_db("bd_emporio", $conn) or die(mysql_error());

?>

<?php

include("../kint/Kint.class.php");





if( $_SERVER['REQUEST_METHOD']=='POST')
{


$sql = "INSERT INTO estoque (identificacao,preco,cod_ingrediente,quantidade_total,quantidade) 
VALUES ('".$_POST['identificacao']."','".$_POST['preco']."', '".$_POST['cod_tipoingrediente']."',  '".$_POST['total']."', '".$_POST['QtdDeId']."') 
ON DUPLICATE KEY UPDATE quantidade_total = quantidade_total +'".$_POST['total']."'";

//ddd($sql);

    //echo $resultado;
      mysql_query ($sql, $conn);
     }
    
      header("Location: ../cadastrar_nova_compra.php");
  


?>
