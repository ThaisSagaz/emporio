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
            <font size=6><b>Relatório de Estoque</b></font>
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
    <TH>Ingredientes</TH>
    <TH>Identificação</TH>
    <TH>Quantidade</TH>
    <TH>Quantidade/Lote</TH>
    <TH>Data de Validade</TH>
</TR>
<?php
    include '../conexao/database.php';
    $pdo = Database::connect();

    $sql = "SELECT novacompra.*, DATE_FORMAT(novacompra.data_validade,'%d/%m/%Y') as data_validade_fmt,ingrediente.nome as ingrediente FROM novacompra
        inner join ingrediente on novacompra.cod_ingrediente=ingrediente.cod_ingrediente ";

    if($data_1 != "" || $data_1 != null || $data_2 != "" || $data_2 != null){
      $sql .= "where '$data_1' <= novacompra.data_entrada and '$data_2' >= novacompra.data_entrada";
    }

    foreach ($pdo->query($sql) as $row) {
        echo '<tr>';
        echo '<td align="center"> '. $row['ingrediente'] . '</td>';
        echo '<td align="center"> '. $row['nome']. '</td>';
        echo '<td align="center"> '.$row['quantidade']. '</td>';
        echo '<td align="center"> '.$row['quantidade_total']. '</td>';
        echo '<td align="center"> '.$row['data_validade_fmt']. '</td>';

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