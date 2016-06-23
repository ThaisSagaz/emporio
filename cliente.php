<!DOCTYPE html>
<?php

    if (!isset($_SESSION)) session_start();

        // Verifica se não há a variável da sessão que identifica o usuário
        if (!isset($_SESSION['UsuarioID'])) {
	       // Destrói a sessãoo por segurança
	       session_destroy();
	       // Redireciona o visitante de volta pro login
	       header("Location: index.php"); exit;
        }
?>
 <html>
  <head>
    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Clientes</title>
    <!-- Tell the browser to be responsive to screen width -->
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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <style type="text/css">


	#celula2 {
  width: 300px;
  padding:10px;
  _width: 495px;
	}

</style>
  <!--
  BODY TAG OPTIONS:
  =================
  Apply one or more of the following classes to get the
  desired effect
  |---------------------------------------------------------|
  | SKINS         | skin-blue                               |
  |               | skin-black                              |
  |               | skin-purple                             |
  |               | skin-yellow                             |
  |               | skin-red                                |
  |               | skin-green                              |
  |---------------------------------------------------------|
  |LAYOUT OPTIONS | fixed                                   |
  |               | layout-boxed                            |
  |               | layout-top-nav                          |
  |               | sidebar-collapse                        |
  |               | sidebar-mini                            |
  |---------------------------------------------------------|
  -->
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
             <a class="btn btn-danger" href="forms/cadastrar_cliente.php">Novo</a>
             <section class="content-header">
          </section>
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Clientes</h3>
                  <div class="box-tools">
                    <div class="input-group" style="width: 150px;">

                      <div class="input-group-btn">

                      </div>
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding"  style='overflow:auto;' id="scroll">
                  <table id="example" class="views-table cols-6 table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th class="views-field views-field-id">Nome</th>
                        <th class="views-field views-field-id">CPF</th>
                        <th class="views-field views-field-id">Email</th>
                        <th class="views-field views-field-id" id="celula2";>Ação</th>



                    </thead>
                    <tbody>
                       <?php
                          include 'conexao/database.php';
                          $pdo = Database::connect();
                          $sql = $sql = 'SELECT * FROM clientes ORDER BY cod_cliente DESC';
                          foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['nome'] . '</td>';
                            echo '<td>'. $row['cpf'] . '</td>';
                            echo '<td>'. $row['email'] . '</td>';


                            echo '<td width=200>';
                            echo '<a class="btn btn-default" href="DAO/visualizar_cliente.php?id='.$row['cod_cliente'].'">Visualizar</a>';
                            echo '&nbsp;'; 
							echo '<a class="btn btn-danger" href="forms/atualizar_cliente.php?id='.$row['cod_cliente'].'">Atualizar</a>';
                            echo '&nbsp;';
                            echo '<a class="btn btn-danger" href="DAO/Excluir_Cliente.php?id='.$row['cod_cliente'].'">Apagar</a>';
                            echo '</td>';
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
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>

   <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.min.css">
    <script type="text/javascript" charset="utf8" src="js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="js/dataTables.bootstrap.js"></script>


    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->

    <script type="text/javascript">
      $(document).ready(function() {
        $('#example').DataTable();
      } );
    </script>
  </body>
</html>
