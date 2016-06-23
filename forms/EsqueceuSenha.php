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

    $id = $_SESSION['UsuarioID'];

    if ( null==$id ) {
        header("Location: menu.php");
    }

    if ( !empty($_POST)) {
        // keep track validation errors
        $nova_senhaError = null;
        $confirmar_senhaError = null;

        // keep track post values
        $nova_senha = md5($_POST['nova_senha']);
        $confirmar_senha = md5($_POST['confirmar_senha']);

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


        if ($nova_senha != $confirmar_senha ) {

            echo "
            <script language='javascript' type='text/javascript'>
                alert('Senhas diferentes, tente novamente.');

            </script>";

        } else {

            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE usuarios  set senha = '$confirmar_senha' WHERE cod_usuario = '$id'";
            $q = $pdo->prepare($sql);
            $q->execute(array($confirmar_senha,$id));
            Database::disconnect();
            header("Location: ../index.php");
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
<html> <?php  if (!isset($_SESSION)) session_start();  // Verifica se não há a variável da sessão que identifica o usuário if (!isset($_SESSION['UsuarioID'])) {     // Destrói a sessão por segurança     session_destroy();     // Redireciona o visitante de volta pro login     header("Location: inicio.php"); exit; } ?>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Esqueceu a senha</title>
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
    <!-- iCheck -->
    <link rel="stylesheet" href="../plugins/iCheck/square/blue.css">

    <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'/>

   

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
function inicioLogin() {
alert("Senha alterada com sucesso");

window.location='../inicio.php';
}
</script>
  </head>


  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
         <a href="#"><b>Empório das Tortas</b></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Redefinir senha</p>


        <form action="EsqueceuSenha.php" method="post">
          <div class="form-group has-feedback">
            <input id="senhanova" type="password" class="form-control" placeholder="Senha nova" value="" required name="nova_senha" value=""/>
             <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
           <div class="form-group has-feedback">
            <input id="confrmarsenha" type="password" class="form-control" placeholder="Confirmar senha" value="" required name="confirmar_senha" value=""/>
             <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <span></span><br>
          <div class="row">
            <div class="col-xs-8">
              <a class="btn btn-default" href="../index.php">Voltar</a>

            </div><!-- /.col -->
            <div class="col-xs-4">
              <button name="entrar" value="RefedinirSenha" type="submit" class="btn btn-danger btn-block btn-flat">Redefinir</button>

            </div><!-- /.col -->
          </div>
        </form>
<!--
        <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
          <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
        </div><!-- /.social-auth-links -->




      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->


    <script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>

    <script src="../../bootstrap/js/bootstrap.min.js"></script>

    <script src="../../plugins/iCheck/icheck.min.js"></script>
  <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>

  </body>
</html>
