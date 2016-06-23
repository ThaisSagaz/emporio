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

  $id = null;
  if ( !empty($_GET['id'])) {
    $id = $_REQUEST['id'];
  }

  if ( null==$id ) {
    header("Location: ../estoque.php");
  }

  if ( !empty($_POST)) {
    // keep track validation errors
    $nomeError = null;
    $unidadeError = null;
    $valorunitarioError = null;


    // keep track post values
    $nome = $_POST['nome'];
    $unidade = $_POST['unidade'];
    $valorunitario = $_POST['valorunitario'];

    }
    // validate input
    $valid = true;
    if (empty($nome)) {
      $nomeError = 'Por favor digite um Nome';
      $valid = false;
    }

    if (empty($unidade)) {
      $unidadeError = 'Por favor digite uma Unidade';
      $valid = false;
    }


    if (empty($valorunitario)) {
      $valorunitarioError = 'Por favor escolha o valor Unitario';
      $valid = false;
    }

    // update data
    if ($valid) {
      $pdo = Database::connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "UPDATE ingrediente set nome = ?, cod_unidademedida = ?, valorunitario = ? WHERE cod_ingrediente = ?";
      $q = $pdo->prepare($sql);
      $q->execute(array($nome,$unidade,$valorunitario,$id));
      Database::disconnect();
      header("Location: ../estoque.php");
    } else {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT ingrediente.*,unidademedida.nome as unidade FROM ingrediente
        inner join unidademedida on ingrediente.cod_unidademedida=unidademedida.cod_unidademedida
          where cod_ingrediente = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $nome = $data['nome'];
    $unidade = $data['cod_unidademedida'];
    $valorunitario = $data['valorunitario'];
    Database::disconnect();
    }
?>


<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Atualiza Ingrediente</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link rel="stylesheet" href="../dist/css/skins/skin-blue.css">
    <script type="text/javascript" src="../js/chosen.jquery.js" ></script>
    <script type="text/javascript" src="../js/jquery.maskMoney.min.js" ></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
 <script type="text/javascript">
   
   jQuery(function($){
      $('#ingredientes').chosen();
      $("#valor").maskMoney({symbol:"R$",decimal:".",thousands:"."});

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
      <?php include_once ("includes/header.php" )?>
      <!-- Left side column. contains the logo and sidebar -->
      <?php include_once("includes/menu.php") ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <section class="content">
          <div class="row">

              <!-- Content Header (Page header) -->
              <div class="box box-warning">
                <div class="form">
                  <div class="box-header with-border">
                  <h3 class="box-title">Atualizar Ingrediente</h3>
                  </div><!-- /.box-header -->
                  <div class="box-body">
                    <form action="Atualizar_ingrediente.php?id=<?php echo $id?>" method="post">
                      <div class="form-group">
                        <label>Nome</label>
                        <input name="nome" type="text" class="form-control"  value="<?php echo $data['nome'];?>">
                      

                      </div>

                      <div class="form-group">
                        <label>Unidade de Medida</label>
                        <select name ="unidade" required="required" id="opcao" class="form-control" >
                          <option value="" disabled selected style='display:none;'>Selecione a unidade</option>
                          <?php
                          $pdo = Database::connect();
                          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                          $resultado = "SELECT * FROM unidademedida";
                          Database::disconnect();

                          if(count($resultado)){
                            foreach ($pdo->query($resultado) as $res) {
                            ?>
                          <option  value="<?php echo $res['cod_unidademedida'];?>" ><?php echo $res['nome'];?></option>
                           <?php
                                }
                              }
                          ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Valor Unitário</label>
                        <input type="text" class="form-control" id="valor" name="valorunitario" required="required" value="<?php echo $data['valorunitario'];?>">
                  
                      </div>


                      <div class="box-footer">

                        <a href="../estoque.php" class="btn btn-default">Cancelar</a>
                        <button type="submit" class="btn btn-danger pull-right">Alterar</button>

                      </div><!-- /.box-footer -->
                    </form>
                  </div><!-- /.box-body -->
                </div><!-- /.box -->
              </div><!-- /.formulário-->
            </div><!-- /.row -->
        </section>
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
