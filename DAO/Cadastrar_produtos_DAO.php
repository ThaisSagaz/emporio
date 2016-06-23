<?php

require '../conexao/database.php';
	
	if ( !empty($_POST)) {
		// keep track validation errors
		$nomeError = null;
		$precoError = null;
		$cod_tipoprodutoError= null;
		
		// keep track post values
		$nome = $_POST['nome'];
		$preco = $_POST['preco'];
		if (empty($tamanho)) {
			$tamanho = $_POST['-'];
		}
		$tamanho = $_POST['tamanho'];
		$cod_tipoproduto = $_POST['tipo_prod'];
		
		// validate input
		$valid = true;
		if (empty($nome)) {
			$nomeError = 'Por favor digite o nome do Produto!';
			$valid = false;
		}
		if (empty($preco)) {
			$precoError = 'Por favor digite o Preço do Produto';
			$valid = false;
		}		

		if (empty($cod_tipoproduto)) {
			$cod_tipoprodutoError = 'Digite qual o Tipo do Produto a ser inserido!';
			$valid = false;
		}
		
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO produtos (nome,preco,tamanho,cod_tipoproduto) values(?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($nome,$preco,$tamanho,$cod_tipoproduto));
			Database::disconnect();
			header("Location: ../produtos.php");
		}
	}
?>

