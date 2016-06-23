<?php

    if (!isset($_SESSION)) session_start();

        // Verifica se não há a variável da sessão que identifica o usuário
        if (!isset($_SESSION['UsuarioID'])) {
	       // Destrói a sessãoo por segurança
	       session_destroy();
	       // Redireciona o visitante de volta pro login
	       header("Location: index.php"); exit;
        }

require 'conexao/database.php';

    $id = $_SESSION['UsuarioID'];

    if ( null==$id ) {
        header("Location: inicio.php");
    }

    if ( !empty($_POST)) {
        // keep track validation errors
        $nova_senhaError = null;
        $confirmar_senhaError = null;
        $senha_atualError = null;

        // keep track post values
        $nova_senha = md5($_POST['nova_senha']);
        $confirmar_senha = md5($_POST['confirmar_senha']);
        $senha_atual = md5($_POST['senha_atual']);

        // validate input
        $valid = true;
        if (empty($nova_senha)) {
            $nova_senhaError = 'Por favor digite a Nova Senha!!';
            $valid = false;
        }
        if (empty($confirmar_senha)) {
            $confirmar_senhaError = 'Por favor Confirme a sua Nova Senha!';
            $valid = false;
        }
        if (empty($senha_atual)) {
            $senha_atualError = 'Por favor digite a sua Senha Atual!!';
            $valid = false;
        }

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM usuarios where cod_usuario = '$id'";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $senha_bd = $data['senha'];
        $nome = $data['name'];
        $login = $data['login'];
        Database::disconnect();

            if ( $senha_bd != $senha_atual) {
              echo "
              <script language='javascript' type='text/javascript'>
                  alert('Senha Atual não conhecidem.');

              </script>";
            } elseif ($nova_senha != $confirmar_senha){

              echo "
              <script language='javascript' type='text/javascript'>
                  alert('Nova Senha e Confirmar Senha não conhecidem.');

              </script>";

            } else {

              $pdo = Database::connect();
              $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $sql = "UPDATE usuarios  set senha = '$confirmar_senha' WHERE cod_usuario = '$id'";
              $q = $pdo->prepare($sql);
              $q->execute(array($confirmar_senha,$id));
              echo "
              <script language='javascript' type='text/javascript'>
                  alert('Senha alterada com sucesso!');
              </script>";
              Database::disconnect();

              header("Location: inicio.php");
            }


        //Database::disconnect();
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM usuarios where cod_usuario = '$id'";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $nome = $data['name'];
        $login = $data['login'];
        Database::disconnect();
    }
    ?>


<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html> <?php  if (!isset($_SESSION)) session_start();  // Verifica se não há a variável da sessão que identifica o usuário if (!isset($_SESSION['UsuarioID'])) {     // Destrói a sessão por segurança     session_destroy();     // Redireciona o visitante de volta pro login     header("Location: inicio.php"); exit; } ?>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Alterar senha</title>
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

      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    <script type="text/javascript" src="js/chosen.jquery.js" ></script>
    <script type="text/javascript" src="js/jquery.maskMoney.min.js" ></script>




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
                  <h3 class="box-title">Alterar Senha</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <form  action="alterarsenha.php?id=<?php echo $id?>" method="post">
                    <div class="form-group">
                      <label>Nome</label>
                      <input type="text" class="form-control" disabled name="nome" value="<?php echo !empty($nome)?$nome:'';?>">

                    </div>
                    <div class="form-group">
                      <label>Login</label>
                      <input disabled name="login" class="form-control" type="text" placeholder="" value="<?php echo !empty($login)?$login:'';?>">

                    </div>

                    <div class="form-group">
                      <label>Senha Atual</label>
                      <input name="senha_atual" class="form-control" type="password" placeholder="" value="<?php echo !empty($senha_atual)?$senha_atual:'';?>">


                    </div>
                    <div class="form-group">
                      <label>Nova Senha</label>
                      <input name="nova_senha" type="password" class="form-control" placeholder="" value="<?php echo !empty($nova_senha)?$nova_senha:'';?>">

                    </div>
                    <div class="form-group">
                      <label>Confirmar Senha</label>
                      <input name="confirmar_senha" class="form-control" type="password"  placeholder="" value="<?php echo !empty($confirmar_senha)?$confirmar_senha:'';?>">

                    </div>


                    <button type="submit" class="btn btn-danger">Criar</button>
                    <a class="btn btn-default" href="inicio.php">Voltar</a>
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
