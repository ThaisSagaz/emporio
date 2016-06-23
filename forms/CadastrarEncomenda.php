<?php

    if (!isset($_SESSION)) session_start();

        // Verifica se não há a variável da sessão que identifica o usuário
        if (!isset($_SESSION['UsuarioID'])) {
         // Destrói a sessãoo por segurança
         session_destroy();
         // Redireciona o visitante de volta pro login
         header("Location: ../index.php"); exit;
        }
    header("Content-type: text/html; charset=utf-8");
    require '../conexao/database.php';




  $id = null;
  if ( !empty($_GET['cod_cliente'])) {
      $id = $_REQUEST['cod_cliente'];
  }

  if ( null==$id ) {
      header("Location: Verificar_Encomenda.php");
  }


  $pdo = Database::connect();
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "SELECT * FROM clientes where cod_cliente = '$id'";
  $q = $pdo->prepare($sql);
  $q->execute(array($id));
  $data = $q->fetch(PDO::FETCH_ASSOC);
  $nome = $data['nome'];
  Database::disconnect();
  Database::disconnect();

?>


  <!DOCTYPE html>
<html>
<html>
  <head>
    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>cadastrar encomenda</title>
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
    <link rel="stylesheet" href="../js/bootstrap-chosen.css"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


    <script type="text/javascript">
    </script>

    <script>

    function Habilitar_apagar() {
    if (document.getElementById('totalPago').checked) {
    document.getElementById("pago").disabled = false;
    } else {
    document.getElementById("pago").disabled = true;
    }
    }

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
      <?php include_once ("includes/menu.php") ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">

        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Cadastrar Encomenda</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <form action="../DAO/Cadastrar_EncomendasDAO.php" method="post">

                    <div class="form-group">
                    <label>Cliente:</label>



                    <input type="hidden" class="form-control" name="nome" value="<?php echo $id; ?>"  >

                    <input type="text" class="form-control" name="só_mostra_o_nome_nao_faz_insert" value="<?php echo $nome; ?>"  >
                            <?php

                            $data_entrada = date('Y-m-d');

                            $timestamp1 = strtotime($data_entrada);
                            ?>
                    <div class="form-group">
                    <label>Data do pedido:</label>
                    <input type="date" class="form-control" name="dtpedido" required="required" value="<?php echo $data_entrada ?>">
                    </div>
                    <label>Data do Entrega:</label>
                    <input type="date" class="form-control" name="dtentrega" required="required" value="">
                    </div>

                      <table class="views-table cols-6 table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="views-field views-field-id">Produto</th>
                                <th class="views-field views-field-field-nome">Quantidade</th>

                                <th class="views-field views-field-field-nome">Preço Unitário</th>
                                  <th class="views-field views-field-field-nome">Custo</th>

                                <th class="views-field views-field-field-nome">&nbsp;</th>
                            </tr>
                        </thead>
                      <tbody id="tbproduto">
                          <tr>
                            <td style="width: 450px">
                              <select class="form-control chosen-select bradius" name="produto_0"  required="required" id="produto_0">
                                <option value="" style='display:none;'>Selecione o produto:</option>
                                <?php
                                    $pdo = Database::connect();
                                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    $resultado = "SELECT * FROM produtos";
                                    Database::disconnect();

                                    if(count($resultado)){
                                        foreach ($pdo->query($resultado) as $res) {
                                            ?>
                                            <option  value="<?php echo $res['cod_produto'];?>" ><?php echo $res['nome'];?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                              </select>
                            </td>
                            <td style="width: 50px">
                              <input type="text" id="qtd_0" name="qtd_0" class="form-control" maxlength="128" size="60" />
                            </td>

                            <td style="width: 150px">
                              <input type="text" id="idpreco_0" readonly name="idpreco_0" class="form-control" />
                            </td>
                            <td style="width: 150px">
                              <input type="text" id="precototal_0" readonly name="precototal_0" class = "form-control" />
                            </td>

                          </tr>
                      </tbody>
                      <tfoot>
                          <tr>
                              <td colspan="6">
                                  <a id="idBtnAddNovoproduto" class="btn btn-default">
                                      <i class="fa fa-plus-circle"></i>
                                  </a>
                              </td>
                          </tr>
                      </tfoot>
                      </table>

                      <div class="form-group">
                        <label>Preço Total</label>

                        <input type="text" id="total"  readonly="" name="total" class="form-control" />


                      </div>

                    <div class="form-group">


                      <label>Pago?</label>
                      <input type="checkbox" name="totalPago" id="totalPago" onclick="Habilitar_apagar()">
                      <input type="text" class=""step="0.01" disabled name="pago" id="pago" style="width: 60px">
   </div>





                      <input type="hidden" id="totalDeproduto" name="totalDeproduto" value="1"  />
                      <button type="submit" class="btn btn-danger">Criar</button>
                      <a class="btn btn-default" href="../encomendas.php">Voltar</a>


                  </form>
                </div><!-- box body -->
              </div><!-- box Warning -->
            </div><!-- col -->
          </div><!-- row -->
        </section>


  <!-- box body -->

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


    <script type="text/javascript" src="../js/chosen.jquery.js" ></script>
    <script type="text/javascript" src="../js/jquery.maskMoney.min.js" ></script>


    <script>

    jQuery(function($){
      //inicializo o chosesn e mascaro os campos de valor numerico para o index passado
      maskValores(0);
      //faco o jquery atribuir o change no input qtd para o index passado
      bindQTD(0);
      //faco o jquery atribuir o change no select produto para o index passado


      bindproduto(0);

      $('#idBtnAddNovoproduto').click(addNovoproduto);
    });

    function maskValores(index){
      $('#produto_'+index).chosen();
      $("#qtd_"+index).maskMoney({symbol:"R$",decimal:",",thousands:"."});
      $("#idpreco_"+index).maskMoney({symbol:"R$",decimal:",",thousands:"."});
      $("#pago").maskMoney({symbol:"R$",decimal:",",thousands:"."});
      $("#precototal_"+index).maskMoney({symbol:"R$",decimal:",",thousands:"."});

    }

    function bindQTD(indexQtd){

      $( "#qtd_"+indexQtd ).change(function() {
        if($("#idpreco_"+indexQtd).val() == "" || $("#qtd_"+indexQtd).val() == ""){
          return;
        }

        var precoUnitario = $('#idpreco_'+indexQtd).maskMoney('unmasked');
        var qtd = $('#qtd_'+indexQtd).maskMoney('unmasked');
        var precoTotal = precoUnitario[0]*qtd[0];
        $('#precototal_'+indexQtd).val(precoTotal.toFixed(2));
        $("#precototal_"+indexQtd).maskMoney('mask');
        calcularPrecoTotal();
      });

    }

    function calcularPrecoTotal(){
      var totalproduto = $('#totalDeproduto').val();
      var precoDaencomenda = 0;
      for(var i = 0; i< totalproduto; i++ ){
        precoDaencomenda += $('#precototal_'+i).maskMoney('unmasked')[0];
      }

      $('#total').val(parseFloat(precoDaencomenda).toFixed(2));
      $("#total").maskMoney('mask');

    }

    function bindproduto(indexproduto){
      $('#produto_'+indexproduto).change(function(){
          var url = "../listaprod.php?cod_produto="+$('#produto_'+indexproduto).val();

          var jqxhr = $.getJSON(url, function() {
          }).done(function(data) {



    $("#idpreco_"+indexproduto).val(data.preco);



          }).fail(function( jqxhr, textStatus, error ) {
            var err = textStatus + ", " + error;
            console.log( "Esse Ã© o erro: " + err );
          });
      });
    }





    function excluirproduto(){
      var tr = $(this).parent().parent();
      //change the background color to red before removing
        tr.css("background-color","#E35865");

        tr.fadeOut(600, function(){
            tr.remove();
            var totalproduto = $('#totalDeproduto').val();
            totalproduto--;
            $('#totalDeproduto').val(totalproduto);
            calcularPrecoTotal();
        });

    }


    function addNovoproduto(){

      var index = $("#totalDeproduto").val();
      var linhaNovoprodutoTabela = "<tr>";
          //celula de produto
          linhaNovoprodutoTabela += ' <td style="width: 450px">';
          linhaNovoprodutoTabela += '     <select class="form-control chosen-select bradius" name="produto_'+index+'"  required="required" id="produto_'+index+'">';
          linhaNovoprodutoTabela += '       <option value="" style="display:none;">Selecione o produto:</option>';
          linhaNovoprodutoTabela +=         $('#id_options_produto').html();
          linhaNovoprodutoTabela += '     </select>';
          linhaNovoprodutoTabela += ' </td>';
          //celula de quantidade
          linhaNovoprodutoTabela += ' <td style="width: 50px">';
          linhaNovoprodutoTabela += '   <input type="text" id="qtd_'+index+'" class="form-control" name="qtd_'+index+'" maxlength="128" size="60" />';
          linhaNovoprodutoTabela += ' </td>';

          //celula de preco unitario
          linhaNovoprodutoTabela += ' <td style="width: 150px">';
          linhaNovoprodutoTabela += '   <input type="text" id="idpreco_'+index+'" readonly name="idpreco_'+index+'" class="form-control" />';
          linhaNovoprodutoTabela += ' </td>';
          //celula de preco total
          linhaNovoprodutoTabela += ' <td style="width: 150px">';
          linhaNovoprodutoTabela += '   <input type="text" id="precototal_'+index+'" class ="form-control" readonly name="precototal_'+index+'"  />';
          linhaNovoprodutoTabela += ' </td>';
          //celula do btn excluir linha
          linhaNovoprodutoTabela += ' <td colspan="6">';
          linhaNovoprodutoTabela += '   <a id="btnTrash_'+index+'" class="btn btn-default">';
          linhaNovoprodutoTabela += '     <i class="fa fa-trash-o"></i>';
          linhaNovoprodutoTabela += '   </a>';
          linhaNovoprodutoTabela += ' </td>';
          linhaNovoprodutoTabela += "</tr>";

      $('#tbproduto').append(linhaNovoprodutoTabela);



      //inicializo o chosesn e mascaro os campos de valor numerico para o index passado
      maskValores(index);
      //faco o jquery atribuir o change no input qtd para o index passado
      bindQTD(index);
      //faco o jquery atribuir o change no select produto para o index passado
      bindproduto(index);
      $('#btnTrash_'+index).click(excluirproduto);
      index++;
      $("#totalDeproduto").val(index);
    }
    </script>

<div id="id_options_produto" style='display:none;'>
  <option value="" style='display:none;' >Selecione o produto:</option>
  <?php
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $resultado = "SELECT * FROM produtos";
    Database::disconnect();

    if(count($resultado)){
      foreach ($pdo->query($resultado) as $res) {
  ?>
      <option  value="<?php echo $res['cod_produto'];?>" ><?php echo $res['nome'];?></option>
  <?php
      }
    }
  ?>
</div>



    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
  </body>




</html>
