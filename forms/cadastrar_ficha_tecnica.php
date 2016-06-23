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
    <title>cadastrar ficha tecnica</title>
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

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">

        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Cadastrar Ficha Técnica</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <form action="../DAO/Cadastrar_fichatecnica.php" method="post">

                    <div class="form-group">
                      <label>Nome</label>
                      <input type="text" class="form-control" name="nome" required="required" placeholder="Nome" value="">
                    </div>
                    <div class="form-group">
                      <label>Categoria</label>
                      <select class="form-control" name = "categoria"  required="required" id="opcao">
                        <option value=""disabled selected style='display:none;'>Selecione a categoria</option>
                        <?php
                          $pdo = Database::connect();
                          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                          $resultado = "SELECT * FROM categoriafichatecnica";
                          Database::disconnect();

                          if(count($resultado)){
                            foreach ($pdo->query($resultado) as $res) {
                        ?>
                        <option  value="<?php echo $res['codigo'];?>" ><?php echo $res['nome'];?></option>
                        <?php
                          }
                        }
                        ?>
                      </select>
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
                                <th class="views-field views-field-id">Ingrediente</th>
                                <th class="views-field views-field-field-nome">Quantidade</th>
                                <th class="views-field views-field-field-nome">Unidade de Medida</th>
                                <th class="views-field views-field-field-nome">Preço unitário</th>
                                <th class="views-field views-field-field-nome">Custo</th>
                                <th class="views-field views-field-field-nome">&nbsp;</th>
                            </tr>
                        </thead>
                      <tbody id="tbIngredientes">
                          <tr>
                            <td style="width: 450px">
                              <select class="form-control chosen-select bradius" name="ingredientes_0"  required="required" id="ingredientes_0">
                                <option value="" style='display:none;'>Selecione o Ingrediente:</option>
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
                            </td>
                            <td style="width: 50px">
                              <input type="text" id="qtd_0" name="qtd_0" class="form-control" maxlength="128" size="60" />
                            </td>
                            <td style="width: 150px">
                              <select class="form-control" readonly name="IdUnidadeMedida_0"  required="required" id="IdUnidadeMedida_0">
                                <option value="" >Unidade</option>
                              </select>
                            </td>
                            <td style="width: 150px">
                              <input type="text" id="idPrecoUnitario_0" readonly name="idPrecoUnitario_0" class="form-control" />
                            </td>
                            <td style="width: 150px">
                              <input type="text" id="precototal_0" readonly name="precototal_0" class = "form-control" />
                            </td>

                          </tr>
                      </tbody>
                      <tfoot>
                          <tr>
                              <td colspan="6">
                                  <a id="idBtnAddNovoIngrediente" class="btn btn-default">
                                      <i class="fa fa-plus-circle"></i>
                                  </a>
                              </td>
                          </tr>
                      </tfoot>
                      </table>

                      <div class="form-group">
                        <label>Valor Total</label>
                        <input type="text" id="total"  readonly="" name="total" class="form-control" />


                      </div>
                      <input type="hidden" id="totalDeIngredientes" name="totalDeIngredientes" value="1"  />
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
      //faco o jquery atribuir o change no select ingredientes para o index passado


      bindIngredientes(0);

      $('#idBtnAddNovoIngrediente').click(addNovoIngrediente);
    });

    function maskValores(index){
      $('#ingredientes_'+index).chosen();
      //$("#qtd_"+index).maskMoney({symbol:"R$",decimal:",",thousands:"."});
      $("#preco_"+index).maskMoney({symbol:"R$",decimal:",",thousands:"."});
      $("#precototal_"+index).maskMoney({symbol:"R$",decimal:",",thousands:"."});
      $("#total_"+index).maskMoney({symbol:"R$",decimal:",",thousands:"."});

    }

    function bindQTD(indexQtd){

      $( "#qtd_"+indexQtd ).change(function() {
        if($("#idPrecoUnitario_"+indexQtd).val() == "" || $("#qtd_"+indexQtd).val() == ""){
          return;
        }

        var precoUnitario = $('#idPrecoUnitario_'+indexQtd).maskMoney('unmasked');
        var qtd = $('#qtd_'+indexQtd).maskMoney('unmasked');
        var precoTotal = precoUnitario[0]*qtd[0];
        $('#precototal_'+indexQtd).val(precoTotal.toFixed(2));
        $("#precototal_"+indexQtd).maskMoney('mask');
        calcularPrecoTotal();
      });

    }

    function calcularPrecoTotal(){
      var totalIngredientes = $('#totalDeIngredientes').val();
      var valorDaFichaTecnica = 0;
      for(var i = 0; i< totalIngredientes; i++ ){
        valorDaFichaTecnica += $('#precototal_'+i).maskMoney('unmasked')[0];
      }

      $('#total').val(parseFloat(valorDaFichaTecnica).toFixed(2));
      $("#total").maskMoney('mask');

    }

    function bindIngredientes(indexIngrediente){
      $('#ingredientes_'+indexIngrediente).change(function(){
          var url = "../lista.php?cod_ingrediente="+$('#ingredientes_'+indexIngrediente).val();
        // var totalDeIngredientes = $("#totalDeIngredientes").val();
        //   for (var i = 0; i < totalDeIngredientes; i++) {
        //
        //
        //     $('#ingredientes_'+i).val() == $('#ingredientes_'+i).val();
        //
        //     alert("Esta funfando!");
        //
        //
        //
        //
        //   }

          var jqxhr = $.getJSON(url, function() {
          console.log( "success" );
          }).done(function(data) {

            $("#IdUnidadeMedida_"+indexIngrediente).empty();
            $("#IdUnidadeMedida_"+indexIngrediente).html('<option value="'+data.IdUnidademedida+'" >'+data.unidadeMedida+'</option>');
            if(data.unidadeMedida == "Kg"){
                //$("#idPrecoUnitario").val(data.valor/1000);
                valor = parseFloat(data.valor/1000);
                $('#idPrecoUnitario_'+indexIngrediente).val(valor.toFixed(2));
                $("#idPrecoUnitario_"+indexIngrediente).maskMoney('mask');

            }else if(data.unidadeMedida == ""){
                  //$("#idPrecoUnitario").val(data.valor/1000);
                  valor = parseFloat(data.valor/1000);
                  $('#idPrecoUnitario_'+indexIngrediente).val(valor.toFixed(2));
                  $("#idPrecoUnitario_"+indexIngrediente).maskMoney('mask');


                }else{
                //valor = data.valor;
                //$("#idPrecoUnitario").val(data.valor);
                $("#idPrecoUnitario_"+indexIngrediente).maskMoney({ precision: 2 }).maskMoney('mask', parseFloat(data.valor));
            }


          }).fail(function( jqxhr, textStatus, error ) {
            var err = textStatus + ", " + error;
            console.log( "Request Failed: " + err );
          });
      });
    }

    function excluirIngrediente(){
      var tr = $(this).parent().parent();
      //change the background color to red before removing
        tr.css("background-color","#E35865");

        tr.fadeOut(600, function(){
            tr.remove();
            var totalIngredientes = $('#totalDeIngredientes').val();
            totalIngredientes--;
            $('#totalDeIngredientes').val(totalIngredientes);
            calcularPrecoTotal();
        });

    }



    function addNovoIngrediente(){

      var index = $("#totalDeIngredientes").val();
      var linhaNovoIngredienteTabela = "<tr>";
          //celula de Ingredientes
          linhaNovoIngredienteTabela += ' <td style="width: 450px">';
          linhaNovoIngredienteTabela += '     <select class="form-control chosen-select bradius" name="ingredientes_'+index+'"  required="required" id="ingredientes_'+index+'">';
          linhaNovoIngredienteTabela += '       <option value="" style="display:none;">Selecione o ingrediente:</option>';
          linhaNovoIngredienteTabela +=         $('#id_options_ingredientes').html();
          linhaNovoIngredienteTabela += '     </select>';
          linhaNovoIngredienteTabela += ' </td>';
          //celula de quantidade
          linhaNovoIngredienteTabela += ' <td style="width: 50px">';
          linhaNovoIngredienteTabela += '   <input type="text" id="qtd_'+index+'" class="form-control" name="qtd_'+index+'" maxlength="128" size="60" />';
          linhaNovoIngredienteTabela += ' </td>';
          //celula de unidade medida
          linhaNovoIngredienteTabela += ' <td style="width: 150px">';
          linhaNovoIngredienteTabela += '     <select class="form-control" readonly name="IdUnidadeMedida_'+index+'"  required="required" id="IdUnidadeMedida_'+index+'">';
          linhaNovoIngredienteTabela += '       <option value="" >Unidade</option>';
          linhaNovoIngredienteTabela += '     </select>';
          linhaNovoIngredienteTabela += ' </td>';
          //celula de preco unitario
          linhaNovoIngredienteTabela += ' <td style="width: 150px">';
          linhaNovoIngredienteTabela += '   <input type="text" id="idPrecoUnitario_'+index+'" readonly name="idPrecoUnitario_'+index+'" class="form-control" />';
          linhaNovoIngredienteTabela += ' </td>';
          //celula de preco total
          linhaNovoIngredienteTabela += ' <td style="width: 150px">';
          linhaNovoIngredienteTabela += '   <input type="text" id="precototal_'+index+'" class ="form-control" readonly name="precototal_'+index+'"  />';
          linhaNovoIngredienteTabela += ' </td>';
          //celula do btn excluir linha
          linhaNovoIngredienteTabela += ' <td colspan="6">';
          linhaNovoIngredienteTabela += '   <a id="btnTrash_'+index+'" class="btn btn-default">';
          linhaNovoIngredienteTabela += '     <i class="fa fa-trash-o"></i>';
          linhaNovoIngredienteTabela += '   </a>';
          linhaNovoIngredienteTabela += ' </td>';
          linhaNovoIngredienteTabela += "</tr>";

      $('#tbIngredientes').append(linhaNovoIngredienteTabela);



      //inicializo o chosesn e mascaro os campos de valor numerico para o index passado
      maskValores(index);
      //faco o jquery atribuir o change no input qtd para o index passado
      bindQTD(index);
      //faco o jquery atribuir o change no select ingredientes para o index passado
      bindIngredientes(index);
      $('#btnTrash_'+index).click(excluirIngrediente);
      index++;
      $("#totalDeIngredientes").val(index);
    }
    </script>

<div id="id_options_ingredientes" style='display:none;'>
  <option value="" style='display:none;' >Selecione o Ingrediente:</option>
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
</div>



    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
  </body>




</html>
