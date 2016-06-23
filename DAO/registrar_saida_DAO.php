<?php

  if (!isset($_SESSION)) session_start();  // Verifica se não há a variável da sessão que identifica o usuário if (!isset($_SESSION['UsuarioID'])) {     // Destrói a sessão por segurança     session_destroy();     // Redireciona o visitante de volta pro login     header("Location: inicio.php"); exit; }

    require '../conexao/database.php';
    include("../kint/Kint.class.php");

    $id = $_POST['id'];

    $quantidadedetortas =  $_POST['quantidade'];

ddd($_POST);

  $pdo = Database::connect();
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "SELECT pf.cod_produtofinal, pf.nome, pf.valorvenda,pf.valortotal, pf.tamanho , sum(ft.quantidade * ift.quantidade) as quantidadeUtilizada, ift.ingrediente_cod_ingrediente as ingrediente_id FROM produtofinal pf inner join fichastecnicas_has_produtofinal ft on (ft.produtofinal_cod_produtofinal = pf.cod_produtofinal) inner join ingrediente_has_fichastecnicas ift on (ft.fichaTecnica_cod_fichaTecnica = ift.fichaTecnica_cod_fichaTecnica) where pf.cod_produtofinal = $id group by ift.ingrediente_cod_ingrediente ";

$ingrediente_id = row['ingrediente_cod_ingrediente'];

$pdo = Database::connect();
$pdo
$ingredientenaoexiste = false;
$ingredientesexistente = ($pdo->query($sql));
foreach ($pdo->query($ingredientesexistente) as $row) {
 $sql = "select * from novacompra where as cod_ingrediente = $ingrediente_id"

$qtd_totalunidade = row['quantidade_total'];
$qtd_unidade = ['qtd_unidade'];
$quantidadetotalItens =  row['quantidade'];
//if(row['']){



    if(row['quantidadeUtilizada'] =< $qtd_totalunidade){
        $quantidadedeItensUltilizada = row['quantidadeUtilizada']/$qtd_unidade; //Quantidade utilizada / quantidade da unidadedo Ingrediente que vai ser igual ao total de Itens que iremos diminuir em Nova Compra
        $quantidadetotalItens =  $quantidadetotalItens - $quantidadedeItensUltilizada; //Baixa em quantidade total de Itens que vem no Nova Compra.
        $quantidade_totalunidade =  $quantidade_totalunidade - row['quantidadeUtilizada']; //Baixa em quantidade total em kilos, gramas, (em unidade) que vem no Nova Compra.


    }else{
      $ingredientenaoexiste = true;
    }

}else{
        $ingredientenaoexiste = true;
}




}



// echo '{"produtos":"'.$row['nome'].'","preco":"'.$row['preco'].'"}';


    Database::disconnect();





?>




SELECT pf.cod_produtofinal, pf.nome, pf.valorvenda,pf.valortotal, pf.tamanho , (ft.quantidade * ift.quantidade) as quantidadeUtilizada FROM produtofinal pf inner join fichastecnicas_has_produtofinal ft on (ft.produtofinal_cod_produtofinal = pf.cod_produtofinal) inner join ingrediente_has_fichastecnicas ift on (ft.fichaTecnica_cod_fichaTecnica = ift.fichaTecnica_cod_fichaTecnica) where pf.cod_produtofinal = 7

SELECT  pf.cod_produtofinal, pf.nome, pf.valorvenda,pf.valortotal, pf.tamanho ,
ift.fichaTecnica_cod_fichaTecnica, ift

(ft.quantidade * ift.quantidade) as quantidadeUtilizada FROM produtofinal pf
inner join fichastecnicas_has_produtofinal ft on (ft.produtofinal_cod_produtofinal = pf.cod_produtofinal)
inner join ingrediente_has_fichastecnicas ift on (ft.fichaTecnica_cod_fichaTecnica = ift.fichaTecnica_cod_fichaTecnica)
where pf.cod_produtofinal = 7

SELECT *, (ft.quantidade * ift.quantidade) as quantidadeUtilizada FROM produtofinal pf inner join fichastecnicas_has_produtofinal ft on (ft.produtofinal_cod_produtofinal = pf.cod_produtofinal) inner join ingrediente_has_fichastecnicas ift on (ft.fichaTecnica_cod_fichaTecnica = ift.fichaTecnica_cod_fichaTecnica) where pf.cod_produtofinal = 7
