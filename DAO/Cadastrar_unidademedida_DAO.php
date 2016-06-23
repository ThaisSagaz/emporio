<?php

require '../conexao/database.php';

	if ( !empty($_POST)) {
		// Validar erros
		$nomeError = null;
		

		//Pegar valores vindo do formul�tio atrav�s do post
		$nome = $_POST['nome'];

		// validate input
		$valid = true;
		if (empty($nome)) {
			$nomeError = 'Por favor digite o nome da Unidade de Medida!';
			$valid = false;

		}

		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO unidademedida (nome) values(?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($nome));
			Database::disconnect();
			header("Location: ../unidadedemedida.php");
		}
	}
?>
