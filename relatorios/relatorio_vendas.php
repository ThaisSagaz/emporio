<?php

header('Content-Type: text/html; charset=utf-8');
require '../conexao/database.php';

$data_1Error = null;
$data_2Error = null;

$data_1 = $_POST['data_1'];
$data_2 = $_POST['data_2'];

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
<meta charset="8">

<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'/>
<link rel="stylesheet" type="text/css" href="../css/legenda.css" />

<TITLE>Relatório de Vendas</TITLE>
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
<table cellspacing=0 align=center width=100% bordercolor="#E35865">
    <tr align="center" color=#E35865>
        <td cellpadding=5>
            <font size=6><b>Relatório de Vendas</b></font>
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
    <TH>Produto</TH>
    <TH>Quantidade</TH>
    <TH>Valor Total</TH>
    <TH>Data da Venda</TH>
</TR>
    <?php
    //include '../conexao/database.php';
    $valor_geral = 0;
    $qtd_geral = 0;
    $pdo = Database::connect();
    $sql = "select vendas.cod_produto,prod.nome as produto, DATE_FORMAT(vendas.data,'%d/%m/%Y') as dtvenda,
            sum(vendas.quantidade) as qtd_total,format(sum(vendas.valor),2,'de_DE') as valor_total from vendas
            inner join produtos prod on vendas.cod_produto=prod.cod_produto
            where vendas.data >= '$data_1' and vendas.data <= '$data_2'
            group by vendas.cod_produto,vendas.data ";

    foreach ($pdo->query($sql) as $row) {
        echo '<tr>';
        echo '<td align="center"> '. $row['produto'] . '</td>';
        echo '<td align="center"> '. $row['qtd_total']. '</td>';
        echo '<td align="center">R$ '.$row['valor_total']. '</td>';
        echo '<td align="center"> '. $row['dtvenda']. '</td>';
        echo '</tr>';
        $valor_geral += $row['valor_total'];
        $qtd_geral += $row['qtd_total'];
    }
    echo '<tr bgcolor="#fff">';
    echo '<td align="center">TOTAL</td>';
    echo '<td align="center">'.$qtd_geral. '</td>';
    echo '<td align="center">R$ '. number_format($valor_geral, 2, ',', '.'). '</td>';
    echo '<td align="center"></td>';
    echo '</tr>';
    Database::disconnect();
    ?>
        
  
</TABLE>
<!--
<div>
<fieldset  class="legenda">
<legend>Legenda</legend>
<label>
**Cores na Coluna Entrega**<br><br>
Cor Vermelha - Entrega em atraso <br>
Cor Verde - Está no Prazo de Entrega<br>
Cor Branca - Entrega Realizada<br>
 </label>
</div>
-->
</BODY>
</HTML>