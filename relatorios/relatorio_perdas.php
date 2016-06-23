<?php
header('Content-Type: text/html; charset=utf-8');

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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'/>
<link rel="stylesheet" type="text/css" href="../css/legenda.css" />

<TITLE>Relatório de Perdas</TITLE>

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
            <font size=6><b>Relatório de Perdas</b></font>
        </td>
    </tr>
    <tr align="right">
        <td cellpadding=5>
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
    <TH>Status</TH>
    <TH>Observação</TH>
    <TH>Data da Perdas</TH>
</TR>
    <?php
    include '../conexao/database.php';
    $pdo = Database::connect();

    $sql = "select prod.nome as produto, est.quantidade as quantidade, est.status as status, est.observacao as observacao from estoquevenda as est
            inner join produtos as prod on est.cod_produto=prod.cod_produto where est.status = 'Problema' ";

    foreach ($pdo->query($sql) as $row) {
        echo '<tr>';
        echo '<td align="center"> '. $row['produto'] . '</td>';
        echo '<td align="center"> '. $row['quantidade']. '</td>';
        echo '<td align="center"> '.$row['status']. '</td>';
        echo '<td align="center"> '. $row['observacao']. '</td>';
              echo '</tr>';
    }
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