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
    // keep track validation errors

    // keep track post values
    //$torta = $_POST['torta'];
    $cod_estoquevenda = $_POST['torta'];
    $preco = $_POST['preco'];
    // validate input
    $valid = true;

    // insert data
    if ($valid) {
      $pdo = Database::connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $teste = "Select tamanho from produtos where cod_Produto = ?";
      $t = $pdo->prepare($teste);
      $t->execute(array($cod_estoquevenda));
      $data = $t->fetch(PDO::FETCH_ASSOC);
      $cod = $data['tamanho'];

      $aux = "select cod_Produto from produtos
            where cod_torta_fat = ? ";
      $a = $pdo->prepare($aux);
      $a->execute(array($cod_estoquevenda));
      $data = $a->fetch(PDO::FETCH_ASSOC);
      $cod_produto = $data['cod_Produto'];

      $validade = "select validade from estoquevenda
            where cod_Produto = ? ";
      $v = $pdo->prepare($validade);
      $v->execute(array($cod_estoquevenda));
      $data = $v->fetch(PDO::FETCH_ASSOC);
      $validade_Prod = $data['validade'];

      if ($cod == 'M' || $cod == 'm') {


        $sql = "insert into estoquevenda (cod_Produto,quantidade,status,validade,origem) values (?,12,'Disponível',?,'Interno');
            UPDATE estoquevenda set quantidade = (quantidade - 1) where cod_Produto = ?;
            ";
          $u = $pdo->prepare($sql);
          $u->execute(array($cod_produto,$validade_Prod,$cod_estoquevenda));

      }else{

        $sql = "insert into estoquevenda (cod_Produto,quantidade,status,validade,origem) values (?,10,'Disponível',?,'Interno');
            UPDATE estoquevenda set quantidade = (quantidade - 1) where cod_Produto = ?;
            ";
        $u = $pdo->prepare($sql);
        $u->execute(array($cod_produto,$validade_Prod,$cod_estoquevenda));
      }
      
      $precoSql = "UPDATE produtos set preco = ? where cod_produto = ?;";
      $u = $pdo->prepare($precoSql);
          $u->execute(array($preco,$cod_produto));
      Database::disconnect();
      header("Location: ../estoqueLoja.php");
    }
  }
?>



<html> <?php  if (!isset($_SESSION)) session_start();  // Verifica se não há a variável da sessão que identifica o usuário if (!isset($_SESSION['UsuarioID'])) {     // Destrói a sessão por segurança     session_destroy();     // Redireciona o visitante de volta pro login     header("Location: inicio.php"); exit; } ?>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Fatiar Torta</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
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
    <link rel="stylesheet" href="../dist/css/skins/skin-blue.css">
    <link rel="stylesheet" href="../js/bootstrap-chosen.css"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>


    <![endif]-->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    <script type="text/javascript" src="../js/chosen.jquery.js" ></script>
    <script type="text/javascript" src="../js/jquery.maskMoney.min.js" ></script>
    <script>
  $(function() {
    $('.chosen-select').chosen();
    $('.chosen-select-deselect').chosen({ allow_single_deselect: true });
  });
</script>
<script>
jQuery(function($){
  $('#preco').chosen();
  $("#preco").maskMoney({symbol:"R$",decimal:",",thousands:"."});

});
</script>
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
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-warning">
                            <div class="box-header with-border">
                                <h3 class="box-title">Fatiar Torta</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <form class="form-horizontal" id="form" action="fatiar_torta.php" method="post">

                                    <div class="box-body">
                                       <div class="form-group">
                                        <label>Torta:</label>
                                           <select name = "torta" required="required" class="form-control chosen-select bradius"  id="opcao">
                                            <option value="" disabled selected style='display:none;'>Selecione a Torta</option>
                                            <?php
                                                $pdo = Database::connect();
                                                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                                $resultado = "Select cod_estoquevenda,venda.cod_Produto as produto, concat(prod.nome,'  ', prod.tamanho) as tortas,
                                                    quantidade
                                                    from estoquevenda venda
                                                    inner join produtos prod on prod.cod_Produto = venda.cod_Produto
                                                    inner join tipoproduto tipo on tipo.cod_tipoproduto = prod.cod_tipoproduto
                                                    where venda.quantidade > 0 and (LOWER(prod.nome) like '%torta%' or LOWER(tipo.nome) = 'torta' ) 
                                                    AND lower(tamanho) = 'm' || lower(tamanho) = 'p'  || lower(tamanho) = 'g' AND LOWER(venda.status) ='Disponivel';";
                                                            Database::disconnect();

                                                            if(count($resultado)){
                                                                foreach ($pdo->query($resultado) as $res) {
                                                                                                ?>                                             
                                                                                                <option  value="<?php echo $res['produto'];?>" ><?php echo $res['tortas'];?></option>
                                                                                                <?php      
                                                                }
                                                            }
                                                                                                ?>
                                        </select>
                                        </div>

                                        <div class="form-group">

                                            <label>Preço:</label>
                                            <input type="text" class="form-control" name="preco" id="preco" required="required"  value=""><br>

                                        </div>  
                                        <div class="form-group">
                                            <p class="alert alert-error">Tem certeza que deseja fatiar esta torta?</p>
                                        </div>
                                        <a class="btn btn-default" href="../entrada_produto.php">Cancelar</a>
                                        <button type="submit" class="btn btn-danger pull-right">Fatiar</button>
                                     
                                    </div>

                                    </div>

                            </div><!-- box body -->
                        </div><!-- box Warning -->
                    </div><!-- col -->
                </div><!-- row -->
            </section>

       <!-- /container -->

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
