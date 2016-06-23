<?php

    if (!isset($_SESSION)) session_start();

        // Verifica se não há a variável da sessão que identifica o usuário
        if (!isset($_SESSION['UsuarioID'])) {
         // Destrói a sessão por segurança
         session_destroy();
         // Redireciona o visitante de volta pro login
         header("Location: index.php"); exit;
        }

error_reporting(0); 
ini_set("display_errors", 0 );

$conn = mysql_connect('localhost', 'root', '');
if (!$conn) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("bd_emporio", $conn) or die(mysql_error());
?>

<?php

$UsuarioID = $_SESSION['UsuarioID'];
if( $_SERVER['REQUEST_METHOD']=='POST' )
{
    $sql = "INSERT INTO vendas ( cod_Produto, quantidade, valor, cod_usuario,cod_cliente, data) VALUES ";

    $values = Array();
    for( $i=0; $i<count($_POST['produtos'] ); $i++ )
    {
        $values[] = "('".filter($_POST['produtos'][$i]) ."',
					'".filter( $_POST['quantidade'][$i] )."',
					'".filter( $_POST['result'][$i] )."',
					'".filter( $_POST['UsuarioID'][$i] )."',
					'".filter( $_POST['clientes'][$i] )."',
                    '".filter( $_POST['data'][$i] )."')";
    }
    $resultado = ($sql.implode( ',', $values ));
    //echo $resultado;
     mysql_query ($resultado, $conn);
    if ($values == null){

        echo"

    <script>
    alert('ERRO: Para realizar uma venda é necessário inserir algum item no carrinho')
    </script>

    ";
    }else {
        echo"

    <script>
    alert('Venda Feita com Sucesso');

    </script>

    ";

    }
}

function filter( $str ){
    return addslashes( $str );//deixo demais filtros e validações por sua conta
}

?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->


<html>
  <head>
    <meta charset="utf-8">
    <?php

    require 'conexao/database.php';
    ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Realizar Venda</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.css">
    <link rel="stylesheet" href="dist/css/skins/skin-blue.css">
    <link rel="stylesheet" href="js/bootstrap-chosen.css"/>
    <script type="text/javascript" src="js/jquery.js"></script>
    <link rel="stylesheet" href="_scripts/bootstrap-chosen.css"/>
    <script src="_scripts/jquery.min.js"></script>
    <script src="_scripts/chosen.jquery.js"></script>
	
	
    <script>
        $(function() {
            $('.chosen-select').chosen();
            $('.chosen-select-deselect').chosen({ allow_single_deselect: true });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#produtos').change(function(){
                $('#quantidade').load('listaCidades.php?produto='+$('#produtos').val());
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#produtos').change(function(){
                $('#valor').load('listaCidades.php?produto='+$('#produtos').val());
            });
        });

    </script>

    <script>
        function teste() {
            alert("Venda realizada com Sucesso");

            window.location='Realizar_Venda.php';
        }
    </script>


    <script type="text/javascript">
        var id_hidden = 0;


        $(document).ready(function(){
            $('#form_prepare').submit(function(){
                var $this = $( this );

                if($this.find("select[name='produtos']").val() == null) {
                    alert ("Selecione um Produto!!");
                    return false;
                }

                function formatReal(mixed) {
                    var int = parseInt(mixed.toFixed(2).toString().replace(/[^\d]+/g, ''));
                    var tmp = int + '';
                    tmp = tmp.replace(/([0-9]{2})$/g, ",$1");
                    if (tmp.length > 6)
                        tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");

                    return tmp;
                }

                function dataAtualFormatada(){
                    var data = new Date();
                    var dia = data.getDate();
                    if (dia.toString().length == 1)
                        dia = "0"+dia;
                    var mes = data.getMonth()+1;
                    if (mes.toString().length == 1)
                        mes = "0"+mes;
                    var ano = data.getFullYear();
                    return ano+"/"+mes+"/"+dia;
                }
                <?php

                echo"
                var UsuarioID = $UsuarioID;

                ";
                ?>
                data = new Date();
                data = dataAtualFormatada(data);
                var qtd = $this.find("select[name='quantidade']").val();
                var produtos = $this.find("select[name='produtos']").val();
                var clientes = $this.find("select[name='clientes']").val();
                var preco = $this.find("input[name='preco']").val();
                //var valor = parseFloat(preco.value.replace('.','').replace(',','.'));
                var moeda = preco.replace(".","");
                moeda = moeda.replace(",",".");
                var result = parseFloat(moeda) * qtd;

                result = formatReal(result);

                var e = document.getElementById("produtos");
                var itemSelecionado = e.options[e.selectedIndex].text;

                id_hidden += 1;
                var tr = '<tr id="ln_'+id_hidden+'">'+
                    '<td style="border:1px solid" align="center">'+itemSelecionado+'</td>'+
                    '<td style="border:1px solid" align="center">'+$this.find("select[name='quantidade']").val()+'</td>'+
                    '<td style="border:1px solid" align="center">'+result+'</td>'+
                    '<td class="excluir"><img id="excluir" src="css/img/excluir.png" style="width: 40px; height: 30px; cursor: pointer;" /></td>'+
                    //'<td align="center" bgcolor="#63B8FF" class="excluir">Excluir</td>'+
                    '</tr>';
                $('#grid').find('tbody').append( tr );

                var resultado = $('#resultado').text();

                resultado = resultado.replace(".","");
                resultado = resultado.replace(",",".");
                result = result.replace(".",",");
                result = result.replace(",",".");

                var total = parseFloat(result) + parseFloat(resultado);

                total = formatReal(total);
                $('#resultado').text(total);

                var hiddens = '<input id="produto_'+id_hidden+'" type="hidden" name="produtos[]" value="'+produtos+'" />'+
                    '<input id="result_'+id_hidden+'" type="hidden" name="result[]" value="'+result+'" />'+
                    '<input id="cliente_'+id_hidden+'" type="hidden" name="clientes[]" value="'+clientes+'" />'+
                    '<input id="quantidade_'+id_hidden+'" type="hidden" name="quantidade[]" value="'+qtd+'" />'+
                    '<input id="UsuarioID_'+id_hidden+'" type="hidden" name="UsuarioID[]" value="'+UsuarioID+'" />'+
                    '<input id="data_'+id_hidden+'" type="hidden" name="data[]" value="'+data+'" />';
                $('#form_insert').find('fieldset').append( hiddens );


                       $('.excluir').live('click',function(){

                 $( this ).parent('tr').remove();

                 var idizinho =  $( this ).parent('tr').attr('id');
                 idizinho = idizinho.split('_')[1];
                 //   var a="";
                 $("input[type=hidden]").each(function( index ) {
                 if($(this).attr('id').split('_')[1] == idizinho  ){

                 //var valor = "";
                 if($(this).attr('id').split('_')[0]=='result') {

               var valor =( $(this).val());

                var res =($('#resultado').text());
                     res = res.replace(",",".");

                   var  resto = parseFloat(res) - parseFloat(valor);
                     resto = formatReal(resto);
                     $('#resultado').text(resto);
                 }

                 $(this).remove();

                 }
                 });

                 });

               // $('#resultado').text(total);

                return false;

            });
        });
    </script>


</head>



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
                  <h3 class="box-title">Realizar Venda</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div id="Vendas" class="bradius">


                      <form action="" method="POST" id="form_prepare">
        <fieldset style="border: 0px">
            <div id="Layer1" style="position:absolute; float:right;";
            <br>
            <select name = "produtos"  required="required" data-placeholder="Escolha o Produto" class="chosen-select" tabindex="4" id="produtos" style="width: 200px">
                <option value=""disabled selected style='display:none;'>Selecione o produto</option>
                <?php
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $resultado = "Select prod.cod_Produto as produtos, concat(prod.nome,'  ', Coalesce(prod.tamanho,'')) as tortas,
											   quantidade
									    from estoquevenda venda
											 inner join produtos prod on prod.cod_Produto = venda.cod_Produto
											 inner join tipoproduto tipo on tipo.cod_tipoproduto = prod.cod_tipoproduto
									    where venda.quantidade > 0 AND LOWER(venda.status) ='Disponivel';";
                Database::disconnect();

                if(count($resultado)){
                    foreach ($pdo->query($resultado) as $res) {
                        ?>
                        <option  value="<?php echo $res['produtos'];?>" ><?php echo $res['tortas'];?></option>
                        <?php
                    }
                }
                ?>
            </select>
            <div id="quantidade"></div><br><br>
            <br><br>
            <select name = "clientes" data-placeholder="Escolha um cliente" class="chosen-select" tabindex="4" id="clientes" style="width: 200px">
                <option value=""disabled selected style='display:none;'>Selecione um cliente</option>
                <?php
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $resultado = "Select * from clientes";
                Database::disconnect();

                if(count($resultado)){
                    foreach ($pdo->query($resultado) as $res) {
                        ?>
                        <option  value="<?php echo $res['cod_cliente'];?>" ><?php echo $res['nome'];?></option>
                        <?php
                    }
                }
                ?>
            </select>
            <br><br>
            <label><input type="submit" name="ok" value="Inserir" class="btn btn-danger"/></label>

</div>
</fieldset>
</form>
<div id="Layer2" style="position:relative; float:right; width:422px; height:250px; left:25px; top:-15px; z-index:2; overflow-y:auto">
    <table class="views-table cols-6 table table-striped table-bordered" width="400" height="85" id="grid">
        <thead>
        <tr>
            <th>Produto</th>
            <th style="width: 30px">Qtd</th>
            <th>Valor</th>
            <th></th>

        </tr>

        </thead>
        <tbody>

        </tbody>

        <tfoot>
        <TR>
            <td align="center" bgcolor="#E35865" colspan ="2">TOTAL A PAGAR</td>
            <td bgcolor="#E35865" id="resultado">0</td>
            <td></td>
        </TR>
        </tfoot>


    </table><!-- /grid -->
</div>

	<form action="" method="POST" id="form_insert">
    <fieldset style="display: none;"></fieldset>
    <div id="Layer3" style="position:relative; left:230px; width:0px; height:0px; top:220px">
        <label><input type="submit" name="cadastrar" value="Efetuar Venda" class="btn btn-danger"/></label>
    </div>
	</form>
<!--login-->
</div>
                </div><!-- box body -->
              </div><!-- box Warning -->
            </div><!-- col -->
          </div><!-- row -->
        </section>


  <!-- box body -->

      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <?php include_once("includes/footer.php") ?>
	  
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>


  </body>




</html>
