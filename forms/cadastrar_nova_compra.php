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

$data_entrada = date('Y-m-d');


$timestamp3 = strtotime($data_entrada);
 $data_saida = date('Y-m-d');

$timestamp1 = strtotime($data_saida);
$timestamp2 = strtotime('+90 day', $timestamp1);
$data_teste = date('Y-m-d', $timestamp2);

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
      <title>Cadastrar Nova compra</title>
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

    <link rel="stylesheet" href="../js/bootstrap-chosen.css"/>
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
     $("#preco").maskMoney({symbol:"R$",decimal:".",thousands:"."});
// $("#quantidade").maskMoney({symbol:"R$",decimal:".",thousands:"."});
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
                        <h3 class="box-title">Nova compra de Ingrediente</h3>
                      </div><!-- /.box-header -->
                <div class="box-body">
                  <form  action="../DAO/Cadastrar_nova_compra.php" method="post">
                    <div class="form-group">
                      <label>Ingrediente:</label>
                      <select class="form-control" name="cod_tipoingrediente"  required="required" id="opcao">
                        <option value=""disabled selected style='display:none;'>Selecione o Ingrediente:</option>
                        <?php
                          $pdo = Database::connect();
                          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                          $resultado = "SELECT * FROM ingrediente";
                          Database::disconnect();

                          if(count($resultado)){
                            foreach ($pdo->query($resultado) as $res) {
                        ?>
                            <option  value="<?php echo $res['cod_ingrediente'];?>" ><?php echo $res['nome'];?></option>
                        <?php


                            }
                          }
                        ?>
                      </select>
                    </div>                   
                    <div class="form-group">
                      <label>Identificação:</label>
                      <select class="form-control" name="identificacao" id="identificacao" required="required">
                        <option value="iden" disabled selected style='display:none;'>Selecione a identificação:</option>
                        <option value="Kg"> Kg </option>
                        <option value="L"> l </option>
                        <option value="Un"> Un </option>
                        
                      </select>
                    </div>
                    <div id="palco" class="form-group">
                      <div id="iden"><label>Quantidade: </label></div>
                      <div id="Kg"><label >Quantidade em Kg:</label> </div>
                      <div id="L"><label>Quantidade em L:</label> </div>
                      <div id="Un"><label>Quantidade em :</label> </div>

                      <input type="text" class="form-control" name="QtdDeId" id="QtdDeId" required="required"  value="">
                    </div>


                    <div class="form-group">
                      <div id="iden"><label>Quantidade de itens:</label></div>
                      <input type="text" class="form-control" name="QtdPorId" id="QtdPorId" name="">
                     <div class="form-group" value="1">
                    </div>
                    <div class="form-group">
                      <label>Quantidade total:</label>
                      <input type="text" class="form-control" name="total" id="total" required="required">
                    </div>
                    <script>
                    // var quantidadeItens = $('total').val();
                    // var quantidadeuni = $('qtduni').val();
                    // var totalemuni = quantidadeItens*quantidadeuni;
                    // $('#totalemuni').val(totalemuni);
                    </script>
                     <div class="form-group">
                      <label>Preço:</label>
                      <input  type ="text" class="form-control" step=”3″ name="preco" id="preco" required="required" value="">
                    </div>
                    <button type="submit" class="btn btn-danger">Criar</button>
                    <a class="btn btn-default" href="../cadastrar_nova_compra.php">Voltar</a>
                  </form>
                </div><!-- box body -->
              </div><!-- box Warning -->
            </div><!-- col -->
          </div><!-- row -->
        </section>
      </div><!-- /.content-wrapper -->

      <?php include_once("includes/footer.php") ?>
      <script type="text/javascript">
    function optionCheck(){
        var option = document.getElementById("options").value;
        if(option == "fardos"){
            document.getElementById("hiddenDiv").style.visibility ="visible";
        }
        if(option == "sacos"){
            document.getElementById("hiddenDiv").style.visibility ="visible";
        }
        if(option == "caixas"){
            document.getElementById("hiddenDiv").style.visibility ="visible";
        }
        if(option == "lotes"){
            document.getElementById("hiddenDiv").style.visibility ="visible";
        }
    }
</script>
 <script type="text/javascript">
function id(el) {
  return document.getElementById(el);
}
function mostra(element) {
  if (element.value) {
    id(element.value).style.display = 'block';
  }
}
function esconde_todos($element, tagName) {
  var $elements = $element.getElementsByTagName(tagName),
      i = $elements.length;
  while(i--) {
    $elements[i].style.display = 'none';
  }
}
window.addEventListener('load', function() {
  var $iden = id('iden')
      $Kg = id('Kg'),
      $L = id('L'),
      $Un = id('Un'),
      $identificacao  = id('identificacao');


  //mostrando no onload da página
  esconde_todos(id('palco'), 'div', 'label');
  mostra($identificacao);

  //mostrando ao mudar o select
  $identificacao.addEventListener('change', function() {
    esconde_todos(id('palco'), 'div' ,'label');
    mostra(this);
  });
});
</script>
<script type="text/javascript">
function id(el) {
  return document.getElementById( el );
}
function total( un, QtdPorId ) {
  return un * QtdPorId;
}
window.onload = function() {
  id('QtdDeId').addEventListener('keyup', function() {
    var result = total( this.value , id('QtdPorId').value );
    id('total').value = result;
  });

  id('QtdPorId').addEventListener('keyup', function(){
    var result = total( id('QtdDeId').value , this.value );
    id('total').value = result;
  });
}


/*String.prototype.formatMoney = function() {
  var v = this;

  if(v.indexOf('.') === -1) {
    v = v.replace(/([\d]+)/, "$1,00");
  }

  v = v.replace(/([\d]+)\.([\d]{1})$/, "$1,$20");
  v = v.replace(/([\d]+)\.([\d]{2})$/, "$1,$2");
  v = v.replace(/([\d]+)([\d]{3}),([\d]{2})$/, "$1.$2,$3");

  return v;
};*/
</script>


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
