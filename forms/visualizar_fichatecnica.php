<!DOCTYPE html>
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
if ( !empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}


$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT * FROM fichastecnicas where cod_fichaTecnica = ?";
$q = $pdo->prepare($sql);
$q->execute(array($id));
$data = $q->fetch(PDO::FETCH_ASSOC);
$nome = $data['nome'];
Database::disconnect();


?>
<html>
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>visualizar</title>

		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	    <!-- Bootstrap 3.3.5 -->
	    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">

			<link type="text/css" rel="stylesheet" href="/css/bootstrap.min.css" media="all">
	    <!-- Font Awesome -->
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	    <!-- Ionicons -->
	    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	    <!-- Theme style -->
	    <link rel="stylesheet" href="../dist/css/AdminLTE.css">
	    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
	          page. However, you can choose any other skin. Make sure you
	          apply the skin class to the body tag so the changes take effect.
	    -->
	    <link rel="stylesheet" href="../dist/css/skins/skin-blue.css">

	    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
      <script>
          function imprimir(){
              window.print();
          }
      </script>
      <style media="print">
          .botao, .btn {
              display: none;
          }
      </style>
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
						<span class="glyphicon-print"></span>
            <div class="col-xs-12">

             <section class="content-header">
          </section>
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Visualizar Ficha Técnica</h3>
                  <div class="box-tools">
                    <div class="input-group" style="width: 150px;">

                      <div class="input-group-btn">

                      </div>
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding"  style='overflow:auto;' id="scroll">
                  <table class="views-table cols-6 table table-striped table-bordered">
                    <thead>
                      <tr>

												<th class="views-field views-field-id">Ingredientes</th>
                        <th class="views-field views-field-id">Quantidade</th>
                        <th class="views-field views-field-field-nome">Valor</th>
                          <th class="views-field views-field-field-nome">Valor Total da Ficha Tecnica</th>

                    </thead>
                    <tbody>
                      <?php

                      $pdo = Database::connect();

                      $sql = "select  ingrediente_has_fichastecnicas.*, ingrediente.nome as ingrediente, fichastecnicas.nome as nome from ingrediente_has_fichastecnicas
                              inner join fichastecnicas on fichastecnicas.cod_fichaTecnica = ingrediente_has_fichastecnicas.fichatecnica_cod_fichaTecnica
                              inner join ingrediente on ingrediente.cod_ingrediente = ingrediente_has_fichastecnicas.ingrediente_cod_ingrediente
                    where cod_fichaTecnica =   $id";


                      foreach ($pdo->query($sql) as $row) {

                          echo '<tr>';

                          echo '<td>'. $row['ingrediente'] . '</td>';
                          echo '<td>'. $row['quantidade'] . '</td>';
                          echo '<td>'. $row['preco'] . '</td>';
                          echo '<td>'. $row['precototal'] . '</td>';
                          echo '</tr>';
                      }
                      Database::disconnect();
                      ?>

                    </tbody>
                    </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <?php include_once("includes/footer.php") ?>

      <!-- Control Sidebar -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>

    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
  </body>
</html>
