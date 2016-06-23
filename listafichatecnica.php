<?php
//echo '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>';

require 'conexao/database.php';
include ('kint/Kint.class.php');
$codigo = $_GET['codigo'];


$pdo = Database::connect();

$sql = "Select c.nome categoriafichatecnica, f.nome FichaTecnica, f.valortotal, f.cod_fichaTecnica from categoriafichatecnica c inner join fichastecnicas f on f.categoriafichatecnica_codigo = c.codigo WHERE c.codigo = $codigo";

echo "{[";
foreach ($pdo->query($sql) as $row) {
	echo '{"categoriafichatecnica":"'.$row['categoriafichatecnica'].'","nome":'.$row['FichaTecnica'].', "valortotal":"'.$row['valortotal'].'", "cod_fichaTecnica":"'.$row['cod_fichaTecnica'].'"},';
}
echo "]}";

?>
