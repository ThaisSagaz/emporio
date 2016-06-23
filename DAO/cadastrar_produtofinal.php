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


$sql = "INSERT INTO produtofinal (nome,tamanho,valortotal,valorvenda) VALUES ('".$_POST['nome']."', '".$_POST['tamanho']."',  '".$_POST['total']."',  '".str_replace(",",".",$_POST["totalvenda"])."')";

//ddd($sql);
    //echo $resultado;
      mysql_query ($sql, $conn);
      $id_ficha = mysql_insert_id();


    $totalIngredientes = $_POST['totalDeficha'];
//d($_POST,$totalIngredientes);
    for( $i=0; $i < $totalIngredientes; $i++ ) {

        $sql2 = "INSERT INTO fichastecnicas_has_produtofinal (produtofinal_cod_produtofinal, fichaTecnica_cod_fichaTecnica, quantidade, precounitario, custo) 
         VALUES (".$id_ficha.",".$_POST["ficha_$i"].", '".str_replace(",",".",$_POST["qtd_$i"])."',  '".str_replace(",",".",$_POST["valor_$i"])."', '".str_replace(",",".",$_POST["precototal_$i"])."')";
              mysql_query ($sql2, $conn);
    }
      header("Location: ../produto_final.php");
  }


?>
