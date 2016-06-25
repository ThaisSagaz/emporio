<?php

  if (!isset($_SESSION)) session_start();  // Verifica se não há a variável da sessão que identifica o usuário if (!isset($_SESSION['UsuarioID'])) {     // Destrói a sessão por segurança     session_destroy();     // Redireciona o visitante de volta pro login     header("Location: inicio.php"); exit; } 

    require '../conexao/database.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }

  $pdo = Database::connect();
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "select produtos_has_encomedas.*, produtos.nome as produto, encomendas.Valor as valortotal, DATE_FORMAT(dtpedido,'%d/%m/%y') as dtpedido,DATE_FORMAT(dtentrega, '%d/%m/%y') as dtentrega from produtos_has_encomedas 
            inner join produtos on produtos.cod_Produto = produtos_has_encomedas.Produtos_cod_Produto inner join encomendas on encomendas.cod_Encomenda = produtos_has_encomedas.Encomedas_cod_Encomenda 
            inner join clientes on clientes.cod_Cliente = encomendas.cod_cliente where cod_Encomenda = $id";                
 $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
$cliente = $data['cliente'];
 Database::disconnect();


?>
 

<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Visualizar Encomendas</title>
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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

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
         <a class="btn btn-danger" href="../Verificar_Encomenda.php">Novo</a>
          <a onclick="imprimir()" class="btn btn-danger pull-right">
                <span class="glyphicon glyphicon-print"></span>
              </a>
          <section class="content-header">
          </section>
              <div class="box">
                <div class="box-header">
                      <h3 class="box-title">Encomenda de <?php 

                      echo $cliente; ?></h3>




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

                  
                  <th class="views-field views-field-field-nome" id='celula2'>
            Produtos        </th>

            <th class="views-field views-field-field-nome" id='celula2'>
      Quantidade       </th>
       <th colspan="2" class="views-field views-field-field-nome" id='celula2'>
      Valor total       </th>

            



    </thead>
    <tbody>
           <?php

            $pdo = Database::connect();

            $sql = "select  DISTINCT DATE_FORMAT(dtpedido,'%d/%m/%y') as dtpedido,DATE_FORMAT(dtentrega, '%d/%m/%y') as dtentrega, 
                            quantidade,clientes.nome as cliente,valor,produtos.nome as produtos
                            from produtos_has_encomedas as prod_enco
                    inner join produtos
                        on produtos.cod_Produto = prod_enco.Produtos_cod_Produto
                    inner join encomendas as enco
                        on enco.cod_Encomenda = prod_enco.Encomedas_cod_Encomenda
                    inner join clientes on clientes.cod_Cliente = enco.cod_cliente
                    where cod_Encomenda =   $id";

            foreach ($pdo->query($sql) as $row) {

                echo '<tr>';
                echo '<td>'. $row['produtos'] . '</td>';
                echo '<td>'. $row['quantidade'] . '</td>';
                echo '</tr>';
            }

           
           
             echo '<th class="views-field views-field-field-nome" id="celula2">'  . "Data de Entrega" .    '</th>';
             
             

             echo '<th class="views-field views-field-field-nome" id="celula2">'  . "Data Pedido" .    '</th>';

            




               echo  '<tr>';
               echo '<td rowspan="2" class="views-field views-field-field-nome" id="celula2">'  . $row['dtentrega'].   '</td>';
               echo '<td class="views-field views-field-field-nome">'  . $row['dtpedido'].   '</td>';
               echo '<td rowspan="2">' . 'R$ ' . number_format($row['valor'], 2, ',', '.') .   '</td>';
             
            

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
</div>
</div>
  <a class="btn btn-default" href="../encomendas.php">Voltar</a>
               

           </div>
   </div> 
        </section><!-- /.content -->
   
   </div>
   </div>
   </div>

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
