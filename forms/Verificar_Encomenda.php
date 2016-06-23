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

$id = null;
if ( !empty($_GET['cod_cliente'])) {
    $id = $_REQUEST['cod_cliente'];
}

if ( null==$id ) {
    header("Location: Verificar_Encomenda.php");
}

    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM clientes where cod_cliente = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $nome = $data['nome'];
    $dia = date('d/m/Y');
    Database::disconnect();


?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>produtos</title>
		<title>produtos</title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	    <!-- Bootstrap 3.3.5 -->
	    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
	    <!-- Font Awesome -->
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	    <!-- Ionicons -->
	    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	    <!-- Theme style -->
	    <link rel="stylesheet" href="dist/css/AdminLTE.css">
	    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
	          page. However, you can choose any other skin. Make sure you
	          apply the skin class to the body tag so the changes take effect.
	    -->
	    <link rel="stylesheet" href="dist/css/skins/skin-blue.css">
<script>
function imprimir(){
    decisao = confirm("Deseja Imprimir via do cliente ?");

    if (decisao){
        window.location='../DAO/Imprimir_Encomendas.php';
    }
}

myInput = document.getElementById("qtd");
myInput.oninput = function () {
    if (this.value.length > 5)
        this.value = this.value.slice(0,4);
};

function limite(){
    myInput.value.length = 5;
}

function teste() {
//alert("Cadastro feito com sucesso");

window.location='../Verificar_Encomenda.php';
}
</script>

</head>



<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <!-- Main Header -->
    <?php include_once("includes/header.php") ?>
    <!-- Left side column. contains the logo and sidebar -->
    <?php include_once("includes/menu.php") ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <!-- Content Header (Page header) -->



      <!-- Main content -->
      <section class="content">


      <div class="row">
          <div class="col-xs-12">

      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->





    <!-- Main Footer -->
    <?php include_once("includes/footer.php") ?>

    <!-- Control Sidebar -->

  <!-- REQUIRED JS SCRIPTS -->

  <!-- jQuery 2.1.4 -->
  <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
  <!-- Bootstrap 3.3.5 -->
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/app.min.js"></script>

  <!-- Optionally, you can add Slimscroll and FastClick plugins.
       Both of these plugins are recommended to enhance the
       user experience. Slimscroll is required when using the
       fixed layout. -->
</body>
</html>
