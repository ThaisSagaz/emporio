<?php
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


<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html> <?php  if (!isset($_SESSION)) session_start();  // Verifica se não há a variável da sessão que identifica o usuário if (!isset($_SESSION['UsuarioID'])) {     // Destrói a sessão por segurança     session_destroy();     // Redireciona o visitante de volta pro login     header("Location: inicio.php"); exit; } ?>
  <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Visualizar Ficha Tecnica</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
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

    <style type="text/css">


    #celula2 {
    width: 300px;
    padding:10px;
    _width: 495px;
    }

  </style>
  </head>
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


        </p>
         <a class="btn btn-danger" href="../forms/cadastrar_ficha_tecnica.php">Novo</a>
          <a onclick="imprimir()" class="btn btn-danger pull-right">
                <span class="glyphicon glyphicon-print"></span>
              </a>
          <section class="content-header">
          </section>
              <div class="box">
                <div class="box-header">
                      <h3 class="box-title"><?php echo $nome;?></h3>



  <!-- //                     $pdo1 = Database::connect();
   //
  //                     $sql2 = "SELECT * from fichastecnicas = $id";
  //                     foreach ($pdo1->query($sql2) as $linha) {
   //
  //                       echo $linha['nome'];
  //  }
  //                       Database::disconnect();

                        ?> -->

                  <div class="box-tools">
                    <div class="input-group" style="width: 150px;">

                      <div class="input-group-btn">

                      </div>
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding" id="scroll">
                  <table class="views-table cols-6 table table-striped table-bordered">

         <thead>
      <tr>

                  <th class="views-field views-field-id">
          Ingrediente         </th>
                  <th class="views-field views-field-field-nome" id='celula2'>
            Quantidade        </th>

            <th class="views-field views-field-field-nome" id='celula2'>
      Tamanho        </th>

            <th class="views-field views-field-field-nome" id='celula2'>
    Preco Unitario     </th>

                <th class="views-field views-field-field-nome" id='celula2'>
      Custo     </th>
    <th class="views-field views-field-field-nome" id='celula2'>



    </thead>
    <tbody>
      <?php

             $pdo = Database::connect();

             $sql = "select ingrediente_has_fichastecnicas.*, ingrediente.valorunitario as preco, ingrediente.nome as ingrediente, fichastecnicas.valortotal as valortotal,fichastecnicas.nome as ficha,fichastecnicas.Tamanho as Tamanho from ingrediente_has_fichastecnicas
                    inner join fichastecnicas on fichastecnicas.cod_fichaTecnica = ingrediente_has_fichastecnicas.fichatecnica_cod_fichaTecnica

                    inner join ingrediente on ingrediente.cod_ingrediente = ingrediente_has_fichastecnicas.ingrediente_cod_ingrediente where cod_fichaTecnica =   $id";



             foreach ($pdo->query($sql) as $row) {

                 echo '<tr>';

                echo '<td>'. $row['ingrediente'] . '</td>';
                echo '<td>'. $row['quantidade'] . '</td>';
                echo '<td>'. $row['Tamanho'] . '</td>';
                echo '<td>'. 'R$ ' . number_format($row['preco'], 2, ',', '.') . '</td>';
                echo '<td>'. 'R$ ' . number_format($row['custo'], 2, ',', '.') . '</td>';

//echo 'R$' . number_format($num, 2, ',', '.');
                echo   '</tr>';

             }

             echo   '<tr>';
             echo '<th colspan="5" class="views-field views-field-field-nome" id="celula2">'  . "" .    '</th>';


             echo  '</tr>';
             echo   '<tr>';
             echo '<th class="views-field views-field-field-nome" id="celula2">'  . "Valor total" .    '</th>';
             echo '<td rowspan="6">' . 'R$ ' . number_format($row['valortotal'], 2, ',', '.') .   '</td>';

             echo  '</tr>';
             Database::disconnect();

             ?>

      </tbody>
      <!-- <tfoot>
      <TR>
          <th class="views-field views-field-id" align="center"  colspan ="2">Total</td>
          <td  id="resultado"></td>
          <td></td>
      </TR>
      </tfoot> -->


        </tr>
      </tfoot>
</table>
                </div><!-- /.box-body -->

              </div><!-- /.box -->
              <a class="btn btn-default" href="../ficha_tecnica.php">Voltar</a>

              <i class="fa fa-trash-o"></i>

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

    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
  </body>
</html>
