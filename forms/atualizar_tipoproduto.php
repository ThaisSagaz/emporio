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

  if ( null==$id ) {
    header("Location: ../tipo_produto.php");
  }

  if ( !empty($_POST)) {
    // keep track validation errors
    $nomeError = null;


    // keep track post values
    $nome = $_POST['nome'];


    // validate input
    $valid = true;
    if (empty($nome)) {
      $nomeError = 'Por favor digite o nome do Produto!';
      $valid = false;
    }



// update data
      if ($valid) {
        try{
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE tipoproduto set nome = ? WHERE cod_tipoproduto = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($nome,$id));

        echo "<script>
          alert('Atualizado com Sucesso!');
          window.location.href = '../tipo_produto.php';
          </script>";

      } catch (PDOException $e) {
      //die($e->getMessage());
      echo "<script>
          alert('Esse Tipo de Produto Já existe');
          window.location.href = 'atualizar_tipoproduto.php?id='$id;
          </script>";
    }
        Database::disconnect();
        //header("Location: ../Tipo_Produtos.php");
      }
  } else {
      $pdo = Database::connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "SELECT cod_tipoproduto, nome FROM tipoproduto where cod_tipoproduto = ?";
      $q = $pdo->prepare($sql);
      $q->execute(array($id));
      $data = $q->fetch(PDO::FETCH_ASSOC);
      $nome = $data['nome'];
      Database::disconnect();
      }
?>



<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Atualizar tipo produto</title>
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
                        <h3 class="box-title">Atualizar Tipo de Produto</h3>
                      </div><!-- /.box-header -->
                      <div class="box-body">
                        <form action="atualizar_tipoproduto.php?id=<?php echo $id?>" method="post">
                          <div class="form-group <?php echo !empty($nomeError)?'error':'';?>">
                            <label>Nome</label> <input name="nome"  class="form-control" type="text" required="required" value="<?php echo $data['nome'];?>">
					      	
                          </div>

                          <button type="submit" class="btn btn-danger">Atualizar</button>
                          <a class="btn btn-default" href="../tipo_produto.php">Voltar</a>
                        </form>
                      </div><!-- box body -->
                    </div><!-- box Warning -->
                </div><!-- col -->
            </div><!-- row -->
        </section>
      </div><!-- /.content-wrapper -->

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
