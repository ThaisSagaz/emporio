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
		header("Location: ../entrada_produto.php");
	}

		if ( !empty($_POST)) {
		// keep track validation errors

		// keep track post values
		$cod_Produto = $_POST['tipo_prod'];
		$quantidade = $_POST['quantidade'];
		$status = $_POST['status'];
		$validade = $_POST['validade'];
		$origem = $_POST['origem'];
		// validate input
		$valid = true;

		// update data
			if ($valid) {
				$pdo = Database::connect();
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "UPDATE estoquevenda  set cod_Produto = ?, quantidade = ?, status = ?, validade = ?, origem = ? WHERE cod_EstoqueVenda = ?";
				$q = $pdo->prepare($sql);
				$q->execute(array($cod_Produto,$quantidade,$status,$validade,$origem,$id));
				Database::disconnect();
				header("Location: ../entrada_produto.php");
			}
	} else {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "SELECT estoquevenda.*,concat(produtos.nome,' ',COALESCE(produtos.tamanho,' ')) as produto FROM estoquevenda left join produtos on estoquevenda.cod_Produto=produtos.cod_produto
					where cod_EstoqueVenda = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($id));
			$data = $q->fetch(PDO::FETCH_ASSOC);

			$cod_Produto = $data['cod_Produto'];
			$produto = $data['produto'];
			$quantidade = $data['quantidade'];
			$status = $data['status'];
			$validade = $data['validade'];
			$origem = $data['origem'];
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
    <title>Atualização do estoque</title>
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

      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    <script type="text/javascript" src="../js/chosen.jquery.js" ></script>
    <script type="text/javascript" src="../js/jquery.maskMoney.min.js" ></script>


    <script>
    jQuery(function($){
      $('#ingredientes').chosen();
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
                        <h3 class="box-title">Atualização de Produtos</h3>
                      </div><!-- /.box-header -->
                <div class="box-body">
                  <form action="atualizar_estoqueLoja.php?id=<?php echo $id?>" method="post" class="" >
                    <div class="form-group">
                      <label>Produto</label>

                      <select class="form-control" name ="tipo_prod"  required="required" id="opcao">
                        <option value="<?php echo $cod_Produto;?>" >
										<?php echo $produto;?></option>
                        <?php
						 $pdo = Database::connect();
						 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						  $resultado = "SELECT cod_produto, concat(produtos.nome, ' ', COALESCE(produtos.tamanho,'')) as prods FROM produtos";
 							Database::disconnect();

						  if(count($resultado)){
						 foreach ($pdo->query($resultado) as $res) {
						  ?>
							<option  value="<?php echo $res['cod_produto'];?>" ><?php echo $res['prods'];?></option>
						  <?php
							}
						  }
						?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Quantidade</label>
                      <input type="text" class="form-control" name="quantidade" required="required" value="<?php echo $quantidade;?>">
                    </div>



        <div class="form-group">
                <label>Situação</label>
                <select class="form-control" name ="status"  required="required" id="opcao">
                    <option value="" disabled selected style='display:none;'>Status do Produto</option>
              <option value="Pendente">Pendente</option>
              <option value="Disponivel">Disponível</option>
              <option value="Problema">Problema</option>
              </select>
            </div>

            <div class="form-group">
              <label>Valido até:</label>
              <input type="date" class="form-control" name="validade" id="preco" required="required" placeholder="Valor Unitário" value="<?php echo $validade;?>">
            </div>

            <div class="form-group">
                    <label>Origem:</label>
                    <select class="form-control" name="origem"  required="required" id="opcao">
                        <option value="<?php echo $origem;?>" disabled selected style='display:none;'>Origem do produto</option>
                  <option value="Interno">Interno</option>
                  <option value="Externo">Externo</option>

                  </select>
                </div>
                    <button type="submit" class="btn btn-danger">Criar</button>
                    <a class="btn btn-default" href="../entrada_produto.php">Voltar</a>
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
