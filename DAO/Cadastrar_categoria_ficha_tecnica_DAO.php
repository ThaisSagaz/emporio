<?php

require '../conexao/database.php';

	if ( !empty($_POST)) {
		// Validar erros
		$nomecategoriaError = null;


		//Pegar valores vindo do formulárioo através do post
		$nomecategoria = $_POST['categoria'];

		// validate input
		$valid = true;
		if (empty($nomecategoria)) {
			$nomecategoriaError = 'Por favor digite o nome da categoria!';
			$valid = false;

		}

		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO categoriafichatecnica (nome) values(?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($nomecategoria));
			Database::disconnect();
			header("Location: ../Categoria_ficha_tecnica.php");
		}
	}
?>
