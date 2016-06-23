<?php

if (!isset($_SESSION)) session_start();

// Verifica se não há a variável da sessão que identifica o usuário
if (!isset($_SESSION['UsuarioID'])) {
	// Destrói a sessão por segurança
	session_destroy();
	// Redireciona o visitante de volta pro login
	header("Location: ../index.php"); exit;
}
	require '../conexao/database.php';

	
	
	if ( !empty($_POST)) {

	// keep track post values
		$name = $_POST['name'];
		$cpf = $_POST['cpf'];
		$email = $_POST['email'];
		$mobile = $_POST['telefone'];
		$login = $_POST['login'];
		$senha = md5($_POST ["senha"]);
		$acesso = $_POST['acesso'];

	}
		
		// validate input
		$valid = true;
	
		// insert data
		if ($valid) {
			
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO usuarios (name,cpf,email,mobile,login,senha,acesso) values(?,?, ?, ?, ?, ?,?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($name,$cpf,$email,$mobile,$login,$senha,$acesso));
			echo "<script>
					alert('Salvo com Sucesso!');
					window.location.href = '../usuarios.php';
					</script>";

		}
			Database::disconnect();
			//header("Location: ../Usuarios.php");
		
	
?>
