<?php

$conn = @mysql_connect('localhost', 'root', '');
if (!$conn) {
    die('Could not connect: ' . mysql_error());
}

mysql_select_db("bd_emporio", $conn) or die(mysql_error());

?>

<?php

include("../kint/Kint.class.php");





if( $_SERVER['REQUEST_METHOD']=='POST')
{


$sql = "INSERT INTO fichastecnicas (nome,categoriafichatecnica_codigo,Tamanho,valortotal) VALUES ('".$_POST['nome']."','".$_POST["categoria"]."', '".$_POST['tamanho']."',  '".$_POST['total']."')";


    //echo $resultado;
      mysql_query ($sql, $conn);
      $id_ficha = mysql_insert_id();


    $totalIngredientes = $_POST['totalDeIngredientes'];
//d($_POST,$totalIngredientes);
    for( $i=0; $i < $totalIngredientes; $i++ ) {

        $sql2 = "INSERT INTO ingrediente_has_fichastecnicas (ingrediente_cod_ingrediente,quantidade,fichaTecnica_cod_fichaTecnica,preco,custo)
         VALUES  (".$_POST["ingredientes_$i"].", '".str_replace(",",".",$_POST["qtd_$i"])."', ".$id_ficha.",  '".$_POST["idPrecoUnitario_$i"]."', '".str_replace(",",".",$_POST["precototal_$i"])."' )";

              mysql_query ($sql2, $conn);
    }
    
      header("Location: ../ficha_tecnica.php");
  }


?>
