<?php
header('Content-Type: text/html; charset=utf-8');

?>
<!DOCTYPE html>
<HTML>
<HEAD>
<meta charset="utf-8">
<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'/>
<link rel="stylesheet" type="text/css" href="../css/legenda.css" />

<TITLE>Relatório de Fichas Técnicas Produzidas</TITLE>

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
            <font size=6><b>Relatório de Fichas Técnicas Produzidas</b></font>
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
	  <TH>Nome da Ficha Tecnica</TH>
    <TH>Tamanho</TH>
    <TH>DValor Total</TH>
</TR>
    <?php
    include '../conexao/database.php';
    $pdo = Database::connect();

    $sql = "SELECT * from fichastecnicas";

    foreach ($pdo->query($sql) as $row) {
        echo '<tr>';
        echo '<td align="center"> '. $row['nome'] . '</td>';
        echo '<td align="center"> '. $row['Tamanho']. '</td>';
        echo '<td align="center"> '.$row['valortotal']. '</td>';

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
Cor Verde - Est� no Prazo de Entrega<br>
Cor Branca - Entrega Realizada<br>
 </label>
</div>
-->
</BODY>
</HTML>
