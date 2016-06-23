<?php
header('Content-type: text/html; charset=utf-8');
require '../conexao/database.php';
include("../kint/Kint.class.php");

   //ddd($_POST);
	if ( !empty($_POST)) {
		// keep track validation errors
		$nomeError = null;
		$unidademedidaError = null;
		$valorunitarioError = null;

		// keep track post values
		$nome = $_POST['nome'];
		$unidademedida = $_POST['unidade'];
		$valorunitario = $_POST['valorunitario'];


		// validate input
		$valid = true;
		if (empty($nome)) {
			$nomeError = 'Por favor digite o tipo de Ingrediente!';
			$valid = false;
		}
		if (empty($unidademedida)) {
			$unidademedidaError = 'Por favor digite a unidade de medida';
			$valid = false;
		}
		if (empty($valorunitario)) {
			$valorunitarioError = 'Por favor digite o valor unitario';
			$valid = false;

		}

		$connect = @mysql_connect('localhost','root','');
		$db = @mysql_select_db('bd_emporio');
		$verifica = mysql_query("SELECT * FROM ingrediente WHERE UPPER(nome) = UPPER('$nome')") or die("erro ao selecionar");
				if (mysql_num_rows($verifica) > 0){
						echo"<script language='javascript' type='text/javascript'>alert('Ingrediente já existe!');window.location.href='../forms/Cadastrar_ingrediente.php';</script>";
						die();
				}else {
					// insert data
					if ($valid) {
						$pdo = Database::connect();
						$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$sql = "INSERT INTO ingrediente (nome,cod_unidademedida,valorunitario) values(?, ?, ?)";
						$q = $pdo->prepare($sql);
						$q->execute(array($nome,$unidademedida,$valorunitario));
						Database::disconnect();
						header("Location: ../estoque.php");
					}
				}
	}
?>
