<?php

    if (!isset($_SESSION)) session_start();

        // Verifica se não há a variável da sessão que identifica o usuário
        if (!isset($_SESSION['UsuarioID'])) {
         // Destrói a sessãoo por segurança
         session_destroy();
         // Redireciona o visitante de volta pro login
         header("Location: ../index.php"); exit;
        }


	require '../conexao/database.php';



	if ( !empty($_POST)) {

		if(isset($_POST['whats']))
		{
			$whats = $_POST['whats'];
		}
		else
		{
			$whats = 'f';
		}

		$nome = $_POST['nomecliente'];
		$cpf = $_POST['cpf'];
		$email = $_POST['email'];
		$telefone = $_POST['telefone'];
		$celular = $_POST['celular'];
		$endereco = $_POST['endereco'];
		$ponto_referencia = $_POST['ponto_referencia'];
		$categoria_cliente = $_POST['categoria_cliente'];


		$valid = true;

		// insert data
		if ($valid) {
			try{
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO clientes (nome,cpf,email,telefone,celular,whats,endereco,ponto_referencia,categoria_cliente) values(?,?,?,?,?,?,?,?,?)";
			$q = $pdo->prepare($sql);

			$q->execute(array($nome,$cpf,$email,$telefone,$celular,$whats,$endereco,$ponto_referencia,$categoria_cliente));

			echo "<script>
					alert('Salvo com Sucesso!');
					window.location.href = '../cliente.php';
					</script>";

		} catch (PDOException $e) {
			//die($e->getMessage());
			echo "<script>
					alert('ERRO: Já existe esse CPF cadastrado');
					window.location.href = '../forms/cadastrar_cliente.php';
					</script>";
		}

			Database::disconnect();

		}
	}


?>
