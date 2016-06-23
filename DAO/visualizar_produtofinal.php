<?php
require '../conexao/database.php';
$id = null;
if ( !empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT * FROM produtofinal where cod_produtofinal = ?";
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
<?php  if (!isset($_SESSION)) session_start();  // Verifica se não há a variável da sessão que identifica o usuário if (!isset($_SESSION['UsuarioID'])) {     // Destrói a sessão por segurança     session_destroy();     // Redireciona o visitante de volta pro login     header("Location: inicio.php"); exit; } ?>
  <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Visualizar produto final</title>
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
              <div class="box">  <h2><?php echo $nome;?></h2>
                <div class="box-header">
                    



  <!-- //                     $pdo1 = Database::connect();
   
                      $sql2 = "SELECT * from fichastecnicas = $id";
                      foreach ($pdo1->query($sql2) as $linha) {
   
  /                      echo $linha['nome'];
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

                  <th rowspan="3" class="views-field views-field-id">
          Ficha Tecnica         </th>
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

             $sql =" select fichastecnicas_has_produtofinal.*, fichastecnicas.nome as ficha, produtofinal.valortotal as valortotal,produtofinal.valorvenda as valorvenda, produtofinal.tamanho as tamanho from fichastecnicas_has_produtofinal inner join produtofinal on produtofinal.cod_produtofinal = fichastecnicas_has_produtofinal.produtofinal_cod_produtofinal inner join fichastecnicas on fichastecnicas.cod_fichaTecnica = fichastecnicas_has_produtofinal.produtofinal_cod_produtofinal where cod_produtofinal=   $id";



            foreach ($pdo->query($sql) as $row) {

                 echo '<tr>';

                echo '<td>'. $row['ficha'] . '</td>';
                echo '<td>'. $row['quantidade'] . '</td>';
                echo '<td>'. $row['tamanho'] . '</td>';
                echo '<td>'. 'R$ ' . number_format($row['precounitario'], 2, ',', '.') . '</td>';
                echo '<td>'. 'R$ ' . number_format($row['custo'], 2, ',', '.') . '</td>';

//echo 'R$' . number_format($num, 2, ',', '.');
                echo   '</tr>';

             }

             echo   '<tr>';
             echo '<th colspan="5" class="views-field views-field-field-nome" id="celula2">'  . "" .    '</th>';

///
             echo  '</tr>';
            echo   '<tr>';
            echo '<th class="views-field views-field-field-nome" id="celula2">'  . "Valor total" .    '</th>';
             echo '<td rowspan="">' . 'R$ ' . number_format($row['valortotal'], 2, ',', '.') .   '</td>';

             echo  '</tr>';

             echo   '<tr>';
             echo '<th colspan="5" class="views-field views-field-field-nome" id="celula2">'  . "" .    '</th>';


             echo  '</tr>';
             echo   '<tr>';
             echo '<th class="views-field views-field-field-nome" id="celula2">'  . "Valor de Venda" .    '</th>';
             echo '<td rowspan="">' . 'R$ ' . number_format($row['valorvenda'], 2, ',', '.') .   '</td>';
//
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
              <a class="btn btn-default" href="../produto_final.php">Voltar</a>

            </div>
          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->





      <!-- Main Footer -->
      <?php include_once("includes/footer.php") ?>

      <!-- Control Sidebar -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.js"></script>

    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
  </body>
</html>
