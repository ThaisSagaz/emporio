<?php
//echo '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>';

require 'conexao/database.php';

$cod_ingrediente = $_GET['cod_ingrediente'];


$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          //Select format(preco,2,'de_DE') as preco from estoquevenda
$preco = "Select i.nome ingrediente, i.valorunitario, m.nome unidademedida, m.cod_unidademedida from ingrediente i
		inner join unidademedida m on m.cod_unidademedida = i.cod_unidademedida
           WHERE cod_ingrediente = ?";

$q = $pdo->prepare($preco);
$q->execute(array($cod_ingrediente));
$data = $q->fetch(PDO::FETCH_ASSOC);
$preco_prod = $data['valorunitario'];


echo '{"ingrediente":"'.$data['ingrediente'].'","valor":'.$data['valorunitario'].', "unidadeMedida":"'.$data['unidademedida'].'","IdUnidademedida":'.$data['cod_unidademedida'].'}';
exit;
?>

