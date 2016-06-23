<?php

require 'conexao/database.php';

$cod_produto = $_GET['cod_produto'];


$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$$preco = "Select format(preco,2,'de_DE') as preco from produtos
           WHERE cod_Produto = ?";
$q = $pdo->prepare($preco);
$q->execute(array($cod_Produto));
$data = $q->fetch(PDO::FETCH_ASSOC);
$preco = $data['preco'];



echo '{"produto":"'.$data['produtos'].'","valor":'.$data['preco'].'}';

exit;
?>
