<?php
//echo '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>';

require 'conexao/database.php';
include ('kint/Kint.class.php');
$codigo = $_GET['cod_produto'];


$pdo = Database::connect();

$sql = "Select nome, preco from produtos WHERE cod_produto = $codigo";



foreach ($pdo->query($sql) as $row) {
	echo '{"produtos":"'.$row['nome'].'","preco":"'.$row['preco'].'"}';
}


?>