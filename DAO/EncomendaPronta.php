<?php
header('Content-Type: text/html; charset=utf-8');
if (!isset($_SESSION)) session_start();

// Verifica se n?o h? a vari?vel da sess?o que identifica o usu?rio
if (!isset($_SESSION['UsuarioID'])) {
	// Destr?i a sess?o por seguran?a
	session_destroy();
	// Redireciona o visitante de volta pro login
	header("Location: ../index.php"); exit;
}

	require '../conexao/database.php';
	$id = 0;

	if ( !empty($_GET['id']) && !empty($_GET['tipo'])) {
		$id = $_REQUEST['id'];
		$tipo = $_REQUEST['tipo'];

		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM encomendas where cod_Encomenda = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$valor = $data['Valor'];

		Database::disconnect();

	}

		// keep track post values
if ($tipo == 'pronta') {
		try {

			 //Atualizar para pronta
				$pdo = Database::connect();
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "Update encomendas set situacao = 'Pronta Para Entrega' WHERE cod_Encomenda = ?";
				$q = $pdo->prepare($sql);
				$q->execute(array($id));
				Database::disconnect();

				echo "<script>
					alert('Foi Alterado a situação da Encomenda!');
					window.location.href = '../encomendas.php';
					</script>";

			}
		catch
			(PDOException $e) {
				//die($e->getMessage());
				echo "<script>
					alert('ERRO: Ocorreu algum problema e não foi possível atualizar a situação desta encomenda');
					window.location.href = '../encomendas.php';
					</script>";
			}
	}

if ($tipo == 'entregue') {
	try {

		//Atualizar para pronta
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "Update encomendas set situacao = 'Entregue' WHERE cod_Encomenda = ?;
	            Update encomendas set totalPago = ? WHERE cod_Encomenda = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id,$valor,$id));
		Database::disconnect();

		echo "<script>
					alert('Encomenda alterada com sucesso! Encomenda foi Entregue ao Cliente.');
					window.location.href = '../encomendas.php';
					</script>";

	}
	catch
	(PDOException $e) {
		//die($e->getMessage());
		echo "<script>
					alert('ERRO: Ocorreu algum problema e não foi possível atualizar a situação desta encomenda');
					window.location.href = '../encomendas.php';
					</script>";

	}
}


?>
