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
header('Content-type: text/html; charset=utf-8');
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
    <title>cadastrar produto final</title>
    <!-- Tell the browser to be responsive to screen width -->
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
<div class="content-wrapper">

        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Cadastrar Produto Final</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <form action="../DAO/Cadastrar_produtofinal.php" method="post">

                    <div class="form-group">
                      <label>Nome</label>
                      <input type="text" class="form-control" name="nome" required="required" placeholder="Nome" value="">
                    </div>

                    <div class="form-group">
                      <label>Tamanho</label>
                      <select class="form-control" name = "tamanho"  required="required">
                        <option id="P"> P </option>
                        <option id="M"> M </option>
                        <option id="G"> G </option>
                      </select>
                    </div>

                      <table class="views-table cols-6 table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="views-field views-field-id">Ficha Técnica</th>
                                <th class="views-field views-field-field-nome">Quantidade</th>

                                <th class="views-field views-field-field-nome">Preço unitário</th>
                                <th class="views-field views-field-field-nome">Custo</th>
                                <th class="views-field views-field-field-nome">&nbsp;</th>
                            </tr>
                        </thead>
                      <tbody id="tbficha">
                          <tr>
                            <td style="width: 450px">
                              <select class="form-control chosen-select bradius" name="ficha_0"  required="required" id="ficha_0">
                                <option value="" style='display:none;'>Selecione a Ficha Tecnica:</option>
                                <?php
                                  $pdo = Database::connect();
                                  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                  $resultado = "SELECT * FROM fichastecnicas";
                                  Database::disconnect();

                                  if(count($resultado)){
                                    foreach ($pdo->query($resultado) as $res) {
                                ?>
                                    <option  value="<?php echo $res['cod_fichaTecnica'];?>" ><?php echo $res['nome']." - ".$res['Tamanho'];
                                        ?></option>
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
                              <input type="text" id="valor_0" readonly name="valor_0" class="form-control" />
                            </td>
                            <td style="width: 150px">
                              <input type="text" id="precototal_0" readonly name="precototal_0" class = "form-control" />
                            </td>

                          </tr>
                      </tbody>
                      <tfoot>
                          <tr>
                              <td colspan="6">
                                  <a id="idBtnAddNovoficha" class="btn btn-default">
                                      <i class="fa fa-plus-circle"></i>
                                  </a>
                              </td>
                          </tr>
                      </tfoot>
                      </table>

                      <div class="form-group">
                        <label>Valor Total</label>
                        <input type="text" id="total" style="width: 150px" name="total"  readonly="" class="form-control" />



                      </div>


                      <div class="form-group" style=" float: center; ">
                        <label>Preço de Venda</label>
                        <input type="text" id="totalvenda"  style="width: 150px" name="totalvenda" class="form-control">


                      </div>



                      <input type="hidden" id="totalDeficha" name="totalDeficha" value="1"  />
                      <button type="submit" class="btn btn-danger">Criar</button>
                      <a class="btn btn-default" href="../ficha_tecnica.php">Voltar</a>


                  </form>
                </div><!-- box body -->
              </div><!-- box Warning -->
            </div><!-- col -->
          </div><!-- row -->
        </section>


  <!-- box body -->

      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <?php include_once("../includes/footer.php") ?>

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

    <script type="text/javascript">


      $(document).ready(function() {

          var total = 0;
      $('.soma').each(function(i){
            var valor = Number($(this).val());
      if (!isNaN(valor)) total += valor;
          });
        $('input[name="total"]').val(total.toFixed(2));

      });


     </script>
    <script>

    jQuery(function($){
      //inicializo o chosesn e mascaro os campos de valor numerico para o index passado
      maskValores(0);
      //faco o jquery atribuir o change no input qtd para o index passado
      bindQTD(0);
      //faco o jquery atribuir o change no select ficha para o index passado

      bindficha(0);
      $('#idBtnAddNovoficha').click(addNovoficha);
    });

    function maskValores(index){
      $('#ficha_'+index).chosen();
      //$("#qtd_"+index).maskMoney({symbol:"R$",decimal:",",thousands:"."});
      $("#preco_"+index).maskMoney({symbol:"R$",decimal:",",thousands:"."});
      $("#precototal_"+index).maskMoney({symbol:"R$",decimal:",",thousands:"."});
          $("#valor_"+index).maskMoney({symbol:"R$",decimal:",",thousands:"."});
          $("#totalvenda").maskMoney({symbol:"R$",decimal:",",thousands:"."});

    }

    function bindQTD(indexQtd){

      $( "#qtd_"+indexQtd ).change(function() {
        if($("#valor_"+indexQtd).val() == "" || $("#qtd_"+indexQtd).val() == ""){
          return;
        }

        var precoUnitario = $('#valor_'+indexQtd).maskMoney('unmasked');
        var qtd = $('#qtd_'+indexQtd).maskMoney('unmasked');
        var precoTotal = precoUnitario[0]*qtd[0];
        $('#precototal_'+indexQtd).val(precoTotal.toFixed(2));
        $("#precototal_"+indexQtd).maskMoney('mask');
        calcularPrecoTotal();
      });

    }


      function bindficha(indexficha){
      $('#ficha_'+indexficha).change(function(){
          var url = "../listafichatecnicas.php?cod_fichaTecnica="+$('#ficha_'+indexficha).val();

          var jqxhr = $.getJSON(url, function() {
          }).done(function(data) {



    $("#valor_"+indexficha).val(data.valortotal);



          }).fail(function( jqxhr, textStatus, error ) {
            var err = textStatus + ", " + error;
            console.log( "Esse é o erro: " + err );
          });
      });
    }

    function calcularPrecoTotal(){
      var totalficha = $('#totalDeficha').val();
      var valorDaFichaTecnica = 0;
      for(var i = 0; i< totalficha; i++ ){
        valorDaFichaTecnica += $('#precototal_'+i).maskMoney('unmasked')[0];
      }

      $('#total').val(parseFloat(valorDaFichaTecnica).toFixed(2));
      $("#total").maskMoney('mask');

    }

    // function calcularPrecovenda(){

    //   var valorDaFichaTecnica = $_POST[total].val();
    //   var comissao = $_POST[comissao].val()
    //   $quantos_porcento = comissao / 100;

    //   $resultado = $quantos_porcento * $valorDaFichaTecnica;
    //   $('#totalvenda').val(parseFloat(resultado).toFixed(2));
    //   $("#totalvenda").maskMoney('mask');

    // }



    function excluirficha(){
      var tr = $(this).parent().parent();
      //change the background color to red before removing
        tr.css("background-color","#E35865");

        tr.fadeOut(600, function(){
            tr.remove();
            var totalficha = $('#totalDeficha').val();
            totalficha--;
            $('#totalDeficha').val(totalficha);
            calcularPrecoTotal();
        });

    }


    function addNovoficha(){

      var index = $("#totalDeficha").val();
      var linhaNovofichaTabela = "<tr>";
          //celula de ficha
          linhaNovofichaTabela += ' <td style="width: 450px">';
          linhaNovofichaTabela += '     <select class="form-control chosen-select bradius" name="ficha_'+index+'"  required="required" id="ficha_'+index+'">';
          linhaNovofichaTabela += '       <option value="" style="display:none;">Selecione o Ficha Técnica:</option>';
          linhaNovofichaTabela +=         $('#id_options_ficha').html();
          linhaNovofichaTabela += '     </select>';
          linhaNovofichaTabela += ' </td>';
          //celula de quantidade
          linhaNovofichaTabela += ' <td style="width: 50px">';
          linhaNovofichaTabela += '   <input type="text" id="qtd_'+index+'" class="form-control" name="qtd_'+index+'" maxlength="128" size="60" />';
          linhaNovofichaTabela += ' </td>';


          //celula de preco unitario
          linhaNovofichaTabela += ' <td style="width: 150px">';
          linhaNovofichaTabela += '   <input type="text" id="valor_'+index+'" readonly name="valor_'+index+'" class="form-control" />';
          linhaNovofichaTabela += ' </td>';
          //celula de preco total
          linhaNovofichaTabela += ' <td style="width: 150px">';
          linhaNovofichaTabela += '   <input type="text" id="precototal_'+index+'" class ="form-control" readonly name="precototal_'+index+'"  />';
          linhaNovofichaTabela += ' </td>';
          //celula do btn excluir linha
          linhaNovofichaTabela += ' <td colspan="6">';
          linhaNovofichaTabela += '   <a id="btnTrash_'+index+'" class="btn btn-default">';
          linhaNovofichaTabela += '     <i class="fa fa-trash-o"></i>';
          linhaNovofichaTabela += '   </a>';
          linhaNovofichaTabela += ' </td>';
          linhaNovofichaTabela += "</tr>";

      $('#tbficha').append(linhaNovofichaTabela);



      //inicializo o chosesn e mascaro os campos de valor numerico para o index passado
      maskValores(index);
      //faco o jquery atribuir o change no input qtd para o index passado
      bindQTD(index);
      //faco o jquery atribuir o change no select ficha para o index passado
      bindficha(index);
      $('#btnTrash_'+index).click(excluirficha);
      index++;
      $("#totalDeficha").val(index);
    }
    </script>

<div id="id_options_ficha" style='display:none;'>
  <option value="" style='display:none;' >Selecione a Ficha Técnica::</option>
  <?php
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $resultado = "SELECT * FROM fichastecnicas";
    Database::disconnect();

    if(count($resultado)){
      foreach ($pdo->query($resultado) as $res) {
  ?>
      <option  value="<?php echo $res['cod_fichaTecnica'];?>" ><?php echo $res['nome']." - ".$res['Tamanho'];?></option>
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
