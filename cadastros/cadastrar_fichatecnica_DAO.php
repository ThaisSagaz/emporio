<?php

require '../conexao/database.php';

	if ( !empty($_POST)) {
		// Validar erros
		$nomeError = null;
		$categoriaError = null;
		$quantidadeError = null;



		//Pegar valores vindo do formul�tio atrav�s do post
		$nome = $_POST['nome'];
		$categoria = $_POST['cod_categoria'];
		$quantidade = $_POST['qntreceita'];

		// validate input
		$valid = true;
		if (empty($nome)) {
			$nomeError = 'Por favor digite o nome da categoria!';
			$valid = false;

		}

		if (empty($categoria)) {
			$categoriaError = 'Por favor digite o nome da categoria!';
			$valid = false;

		}

		if (empty($quantidade)) {
			$quantidadeError = 'Por favor digite a quantidade';
			$valid = false;

		}
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO fichatecnica (codigo,nome,cod_categoria,qntreceita) select fichatecnica.codigo, receita.qntreceita from fichatecnica
			inner join receita on fichatecnica.codigo = receita.codigo";
			$q = $pdo->prepare($sql);
			$q->execute(array($nome,$categoria,$quantidade));
			Database::disconnect();
			header("Location: ../fichatecnica.php");
		}
	}
?>
