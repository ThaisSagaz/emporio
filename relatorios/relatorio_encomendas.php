<?php
header('Content-Type: text/html; charset=utf-8');
require '../conexao/database.php';

$data_1Error = null;
$data_2Error = null;
$situacaoError = null;

$data_1 = $_POST['data_1'];
$data_2 = $_POST['data_2'];
$situacao = $_POST['situacao'];

$data_1_formt = strtotime($data_1);
$data_2_formt = strtotime($data_2);

if (empty($data_1)) {
    $data_1Error = 'Por favor digite um telefone';
    $valid = false;
}

if (empty($data_2)) {
    $data_2Error = 'Por favor digite um login';
    $valid = false;
}


?>

<HTML>

<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'/>
<link rel="stylesheet" type="text/css" href="../css/legenda.css" />

<TITLE>Relatório de Encomendas</TITLE>
    <script>
        function imprimir(){
            window.print();
        }
    </script>

</HEAD>

<STYLE>

BODY{
    font-size: 14pt;
    -webkit-print-color-adjust: exact;
}

Table{
    font-family: sans-serif;
    font-size:12pt;
}

TH {
    background-color: #538CD3;
    color: #FFF;
}

.linhaTrue{
    background-color: #D8E5F1;
}
        
.numeroLegenda{
    font-size:7pt;
}

.vertical-rotate{
    transform: rotate(270deg);
    -webkit-transform: rotate(270deg);
    -moz-transform: rotate(270deg);
    -ms-transform: rotate(270deg);
}

</STYLE>
<style media="print">
    .botao {
        display: none;
    }
</style>

<BODY scroll=yes>
<table cellspacing=0 align=center width=100% bordercolor=\"#AAAAAA\">
    <tr align="center" color=#99CCFF>
        <td cellpadding=5>
            <font size=6><b>Relatório de Encomendas</b></font>
        </td>
    </tr>
    <tr align=left>
        <td cellpadding=5>
            <font size=4><b>Período: </b> <?php echo date('d/m/Y',$data_1_formt); ?> até <?php echo date('d/m/Y',$data_2_formt); ?></font>
        </td>
        <td cellpadding=5 align="right">
            <img src="../css/img/print_printer.png" onclick="imprimir()" style="width: 30px" class="botao">
        </td>
    </tr>
</table>

<BR>
<BR>
<BR>

<table cellspacing=0 align=center width='1000' border='1' bordercolor='#AAAAAA'>

<TR>
	<TH>Cliente</TH>
	<TH>Produto</TH>
    <TH>Quantidade</TH>
	<TH>Observação</TH>
    <TH>Data de Entrega</TH>
    <TH>Situação</TH>
</TR>
    <?php
    //include '../conexao/database.php';
    $pdo = Database::connect();
    $sql = "select cli.nome as cliente ,prod.nome as produto, prodxenco.quantidade as qtd, enco.descricao as descricao,
DATE_FORMAT(enco.dtentrega,'%d/%m/%Y') as dtentrega,enco.situacao as situacao
from encomendas enco inner join produtos_has_encomedas prodxenco on enco.cod_encomenda = prodxenco.Encomedas_cod_Encomenda
inner join produtos prod on prodxenco.Produtos_cod_Produto = prod.cod_produto
inner join clientes cli on enco.cod_cliente = cli.cod_cliente
 where enco.dtpedido >= '$data_1' and enco.dtentrega <= '$data_2'";

    if ($situacao != "" || $situacao != null){
        $sql .= " AND enco.situacao = '$situacao' ";
    }

    foreach ($pdo->query($sql) as $row) {
        echo '<tr>';
        echo '<td>'. $row['cliente'] . '</td>';
        echo '<td> '. $row['produto'] . '</td>';
        echo '<td> '. $row['qtd']. '</td>';
        echo '<td> '. $row['descricao']. '</td>';

        if ($row['dtentrega'] >= date('d/m/Y') and $row['situacao'] == "Pronta") {
            echo '<td bgcolor="green"> ' . $row['dtentrega'] . '</td>';
        }else if ($row['dtentrega'] >= date('d/m/Y') and $row['situacao'] == "A fazer") {
            echo '<td bgcolor="YELLOW"> ' . $row['dtentrega'] . '</td>';
        } else if ($row['dtentrega'] < date('d/m/Y') and $row['situacao'] != "Entregue") {
            echo '<td bgcolor="red"> ' . $row['dtentrega'] . '</td>';
        }else
            echo '<td bgcolor="white"> ' . $row['dtentrega'] . '</td>';

        echo '<td> ' . $row['situacao'] . '</td>';
        echo '</tr>';
    }
    Database::disconnect();
    ?>

</TABLE>

<div>
<fieldset  class="legenda">
<legend>Legenda</legend>
<label>
**Cores na Coluna Entrega**<br><br>
Cor Vermelha - Entrega Está em Atraso <br>
Cor Verde - Encomenda Pronta Para Entregar<br>
Cor Amarela - Ainda Não Foi Feita a Encomenda (Está no Prazo) <br>
Cor Branca - Entrega Realizada<br>
 </label>
</div>

</BODY>
</HTML>