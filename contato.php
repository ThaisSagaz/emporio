<?php

if (!isset($_SESSION)) session_start();

// Verifica se não há a variável da sessão que identifica o usuário
if (!isset($_SESSION['UsuarioID'])) {
  // Destrói a sessãoo por segurança
  session_destroy();
  // Redireciona o visitante de volta pro login
  header("Location: ../inicio.php"); exit;
}

require 'conexao/database.php';

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
    <title>Cadastrar Tipo de Produto</title>
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
                 <div class="col-xs-12 col-md-6" >
                    <div class="box box-warning" style="position: center;">
                      <div class="box-header with-border">
                        <h3 class="box-title">Contato</h3>

                      </div><!-- /.box-header -->
                      <div class="box-body">
                        <form action="enviar.php" method="post" >
                          
                            <small>*Campos de Preenchimentos Obrigatório </small>
'                             
                              <div class="form-group">
                             <label for="nome">* Nome</label>
                              <input type="text" class="form-control" name="nome" id="nome">
                              </div>
                                <div class="form-group">
                              <label for="email">* Email</label>
                              <input type="email" name="email" class="form-control" id="email">
                              </div>
                                 <div class="form-group">
                                <label for="assunto">* Assunto</label>
                            <input type="text" name="assunto" class="form-control" id="assunto">
                              </div>

                              <div class="form-group">
                                 <label for="mensagem">* Mensagem</label>
        <textarea name="mensagem" id="mensagem" class="form-control"></textarea>
                                </div>
                               
                              </textarea>
                           
                            
                               <div class="form-group"></div>
                            <input type="submit" name="enviar" class="btn btn-danger"  id="enviar" value="Enviar">
                              <a  class="btn btn-default" href="inicio.php">Voltar</a>
                              </div>
                        </form>
                      </div><!-- box body -->
                    </div><!-- box Warning -->
                </div><!-- col -->
            </div><!-- row -->
        </section>


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
