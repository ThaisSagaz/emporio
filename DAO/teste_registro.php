<?php

  if (!isset($_SESSION)) session_start();  // Verifica se não há a variável da sessão que identifica o usuário if (!isset($_SESSION['UsuarioID'])) {     // Destrói a sessão por segurança     session_destroy();     // Redireciona o visitante de volta pro login     header("Location: inicio.php"); exit; }


    include("../kint/Kint.class.php");



$conn = @mysql_connect('localhost', 'root', '');
mysql_query("SET CHARACTER SET utf8");
//mysql_query("SET NAMES utf8");
//mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci'"); // medida extrema, opcional
if (!$conn) {
    die('Could not connect: ' . mysql_error());
}

mysql_select_db("bd_emporio", $conn) or die(mysql_error());



    $id = $_POST['id'];

    $quantidadedetortas =  $_POST['quantidade'];

if( $_SERVER['REQUEST_METHOD']=='POST')
{

 
  $sql = "SELECT pf.cod_produtofinal, pf.nome, pf.valorvenda,pf.valortotal, pf.tamanho , sum(ft.quantidade * ift.quantidade) as quantidadeUtilizada, ift.ingrediente_cod_ingrediente as ingrediente_id FROM produtofinal pf inner join fichastecnicas_has_produtofinal ft on (ft.produtofinal_cod_produtofinal = pf.cod_produtofinal) inner join ingrediente_has_fichastecnicas ift on (ft.fichaTecnica_cod_fichaTecnica = ift.fichaTecnica_cod_fichaTecnica) where pf.cod_produtofinal = $id group by ift.ingrediente_cod_ingrediente ";

mysql_query ($sql, $conn);

$ingrediente_id = row['ingrediente_cod_ingrediente'];
$quantidadetotalUtilizada = (row['quantidadeUtilizada'] + $quantidade);
$ingredientenaoexiste = false;

$q = ($pdo->query($sql));
     foreach ($pdo->query($sql) as $row) {
  $sql1 = "select * from novacompra where cod_ingrediente = '$ingrediente_id'";
mysql_query ($sql1, $conn);


if ($quantidadetotalUtilizada <= $row['quantidade_total'];)
$ingredientenaoexiste = true;

}else{
  if(!$ingredientenaoexiste){
$sql2= "INSERT INTO registro_saida(cod_produtofinal,quantidade_torta,data_saida,hora_saida) VALUES (".$_POST["produto_final"].",".$_POST["quantidade"].",".$_POST["data_saida"].",".$_POST["hora_saida"].")";

mysql_query ($sql2, $conn);
     $id_ficha = mysql_insert_id();
$sql3= "UPDATE nova compra where cod_ingrediente = "  

  }



}


  }
    Database::disconnect();





?>