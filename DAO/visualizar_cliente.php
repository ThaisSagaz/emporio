<?php



    require '../conexao/database.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }

    if ( null==$id ) {
        header("Location: ../index.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM clientes where cod_cliente = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
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
    <title>Visualizar cliente</title>
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

              <!-- Content Header (Page header) -->
              <div class="box box-warning">
                <div class="form">
                  <div class="box-header with-border">
                  <h3 class="box-title">Visualizar cliente</h3>
                  </div><!-- /.box-header -->
                  <div class="box-body">

                    <div class="form-group">
                      <label>Nome</label>
                      <input type="text" class="form-control" disabled="yes" name="nome" placeholder="Nome" value="<?php echo $data['nome'];?>">
                    </div>
                    <div class="form-group">
                      <label>CPF</label>
                      <input type="text" class="form-control" disabled="yes" name="cpf" id="cpf" onblur="javascript: validarCPF(this.value);" onkeypress="javascript: mascara(this, cpf_mask);"  maxlength="14" value="<?php echo $data['cpf'];?>" />
                    </div>

                    <label>Email</label>

                    <div class="input-group">

                      <span class="input-group-addon">@</span>
                      <input type="text" class="form-control"  disabled="yes" id="inputGroupSuccess2" aria-describedby="inputGroupSuccess2Status" name="email" required="required" placeholder="Email" value="<?php echo $data['email'];?>">
                    </div>
                  </br>

                    <div class="form-group">
                      <label>Telefone</label>
                      <input type="tel" class="form-control" name="telefone" maxlength="13" OnKeyPress="formatar('## #####-####', this)" disabled="yes" value="<?php echo $data['telefone'];?>">

                    </div>
                    <div class="form-group">
                      <label>Celular</label>
                      <input type="tel" class="form-control" disabled="yes" name="celular" maxlength="13" OnKeyPress="formatar('## #####-####', this)" value="<?php echo $data['celular'];?>">

                    </div>
                    <div class="form-group">
                      <label>Endereço</label>
                      <input type="text" class="form-control" name="endereco" disabled="yes" value="<?php echo $data['endereco'];?>">
                    </div>

                    <div class="form-group">
                      <label>Ponto de referência</label>
                      <input type="text" class="form-control" name="ponto_referencia" disabled="yes" placeholder="Ponto de referência" value="<?php echo $data['ponto_referencia'];?>">
                    </div>

                    <div class="form-group">
                      <label>Categoria</label>
                      <input type="text" class="form-control" disabled="yes" value="<?php echo $data['categoria_cliente']; ?>">
                    </div>

                    <a class="btn btn-default" href="../cliente.php">Voltar</a>

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
