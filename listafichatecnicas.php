
<?php
//echo '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>';

require 'conexao/database.php';
include ('kint/Kint.class.php');
$cod_ficha = $_GET['cod_fichaTecnica'];


$pdo = Database::connect();

$sql = "Select nome,valortotal from fichastecnicas where cod_fichaTecnica = $cod_ficha";



foreach ($pdo->query($sql) as $row) {
	echo '{"ficha":"'.$row['nome'].'","valortotal":"'.$row['valortotal'].'"}';
}


?>
