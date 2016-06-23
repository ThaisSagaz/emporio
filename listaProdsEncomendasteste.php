<?php
echo '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>';

require 'conexao/database.php';

$cod_Produto = $_GET['produto'];


$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          //Select format(preco,2,'de_DE') as preco from estoquevenda
$preco = "Select format(preco,2,'de_DE') as preco from produtos
           WHERE cod_Produto = ?";
$q = $pdo->prepare($preco);
$q->execute(array($cod_Produto));
$data = $q->fetch(PDO::FETCH_ASSOC);
$preco_prod = $data['preco'];

?>

<label style="
 position:absolute;
    width:85px;
	margin:0 auto;
	top:50px;
	height:28px;"
	class='control-label'>Pre�o:</label>
<input style="
    position:absolute;
    left:60px;
    width:65px;
	margin:0 auto;
	top:43px;
	height:28px;"
     class='txt_Venda bradius';
     name='preco' type='text'  placeholder='Pre�o' disabled value='<?php echo !empty($preco_prod)?$preco_prod:'';?>' required>
<?php

echo "<input name='quantidade' type='number' style=' position:absolute;
	left: 283px;
	width:50px;
	top:2px;
	margin:0 auto;
	height:28px';
	class='txt_Venda bradius' required>";
echo" <option value='' disabled selected style='display:none;'>Qtd</option>";

echo "</input>";

?>
