<?php

require '../conexao/database.php';

	if ( !empty($_POST)) {
		// keep track validation errors
		$nomeError = null;

		// keep track post values
		$nome = $_POST['nome'];

		// validate input
		$valid = true;
		if (empty($nome)) {
			$nomeError = 'Por favor digite o nome do tipo de produto!';
			$valid = false;
		}
		// insert data
		if ($valid) {
			try {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO tipoproduto(nome) values(?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($nome));

					echo "<script>
					alert('Tipo de produto salvo com Sucesso!');
					window.location.href = '../tipo_produto.php';
					</script>";

				} catch (PDOException $e) {
					//die($e->getMessage());
				echo "<script>
					alert('Esse Tipo de Produto Já existe');
					window.location.href = '../forms/cadastrar_tipoproduto.php';
					</script>";
				}

			Database::disconnect();
			//header("Location: ../Tipo_Produtos.php");
		}
	}
?>
