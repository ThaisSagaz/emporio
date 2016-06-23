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
    <title>Cadastrar Cliente</title>
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
    <!-- <script language="JavaScript" type="text/javascript" src="../_scripts/MascaraValidacao.js"></script> -->
  	<!-- <script type="text/javascript" src="../_scripts/validacpf.js"></script> -->
  	<link rel="stylesheet" href="../_scripts/bootstrap-chosen.css"/>
  	<script src="../_scripts/jquery.min.js"></script>
  	<script src="../_scripts/chosen.jquery.js"></script>
  	<script>
  		$(function() {
  			$('.chosen-select').chosen();
  			$('.chosen-select-deselect').chosen({ allow_single_deselect: true });
  		});
  	</script>

    <script>
    function formatar(mascara, documento){
      var i = documento.value.length;
      var saida = mascara.substring(0,1);
      var texto = mascara.substring(i)

      if (texto.substring(0,1) != saida){
                documento.value += texto.substring(0,1);
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
      <?php include_once("includes/menu.php") ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Cadastrar Clientes</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <form action="../DAO/cadastrar_cliente.php" method="post">
                    <div class="form-group">
                      <label>Nome</label>
                      <input type="text" class="form-control" name="nomecliente" required="required" placeholder="Nome">
                    </div>
                    <div class="form-group">
                      <label>CPF</label>
                      <input type="text" class="form-control" name="cpf" id="cpf" onblur="javascript: validarCPF(this.value);" onkeypress="javascript: mascara(this, cpf_mask);"  maxlength="14" />
                    </div>

                    <label>Email</label>

                    <div class="input-group">

                      <span class="input-group-addon">@</span>
                      <input type="text" class="form-control" id="inputGroupSuccess2" aria-describedby="inputGroupSuccess2Status" name="email" required="required" placeholder="Email" value="">
                    </div>
                  </br>

                    <div class="form-group">
                      <label>Telefone</label>
                      <input type="tel" class="form-control" name="telefone" maxlength="13" OnKeyPress="formatar('## #####-####', this)" placeholder="Telefone" value="">

                    </div>
                    <div class="form-group">
                      <label>Celular</label>
                      <input type="tel" class="form-control" name="celular" maxlength="13" OnKeyPress="formatar('## #####-####', this)" placeholder="Telefone" value="">
	                       Whatsapp <input type="checkbox" name="whats" id ="whats" value="t">
                    </div>
                    <div class="form-group">
                      <label>Endereço</label>
                      <input type="text" class="form-control" name="endereco" required="required" placeholder="Endereço" value="">
                    </div>

                    <div class="form-group">
                      <label>Ponto de referência</label>
                      <input type="text" class="form-control" name="ponto_referencia" required="required" placeholder="Ponto de referência" value="">
                    </div>

                    <div class="form-group">
                      <label>Categoria</label>
                      <select class="form-control"  name="categoria_cliente" id="categoria_cliente">
                        <option >Selecione a Categoria</option>
  										<option value="vip">VIP</option>
  										<option value="intermediario">Intermediário</option>
  										<option value="normal">Normal</option>
                      </select>
                    </div>


                    <button type="submit" class="btn btn-danger">Criar</button>
                    <a class="btn btn-default" href="../cliente.php">Voltar</a>
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
  
<script>
function validarCPF( cpf ){
                var filtro = /^\d{3}.\d{3}.\d{3}-\d{2}$/i;

                if(!filtro.test(cpf))
                {
                    window.alert("CPF inválido. Tente novamente.");
                    return false;
                }

                cpf = remove(cpf, ".");
                cpf = remove(cpf, "-");

                if(cpf.length != 11 || cpf == "00000000000" || cpf == "11111111111" ||
                   cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" ||
                   cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" ||
                   cpf == "88888888888" || cpf == "99999999999")
                {
                    window.alert("CPF inválido. Tente novamente.");
                    return false;
                }

                soma = 0;
                for(i = 0; i < 9; i++)
                {
                    soma += parseInt(cpf.charAt(i)) * (10 - i);
                }

                resto = 11 - (soma % 11);
                if(resto == 10 || resto == 11)
                {
                    resto = 0;
                }
                if(resto != parseInt(cpf.charAt(9))){
                    window.alert("CPF inválido. Tente novamente.");
                    return false;
                }

                soma = 0;
                for(i = 0; i < 10; i ++)
                {
                    soma += parseInt(cpf.charAt(i)) * (11 - i);
                }
                resto = 11 - (soma % 11);
                if(resto == 10 || resto == 11)
                {
                    resto = 0;
                }

                if(resto != parseInt(cpf.charAt(10))){
                    window.alert("CPF inválido. Tente novamente.");
                    return false;
                }

                return true;
            }

            function remove(str, sub) {
                i = str.indexOf(sub);
                r = "";
                if (i == -1) return str;
                {
                    r += str.substring(0,i) + remove(str.substring(i + sub.length), sub);
                }

                return r;
            }

            /**
     * MASCARA ( mascara(o,f) e execmascara() ) CRIADAS POR ELCIO LUIZ
     * elcio.com.br
     */
            function mascara(o,f){
                v_obj=o
                v_fun=f
                setTimeout("execmascara()",1)
            }

            function execmascara(){
                v_obj.value=v_fun(v_obj.value)
            }

            function cpf_mask(v){
                v=v.replace(/\D/g,"")                 //Remove tudo o que não é dígito
                v=v.replace(/(\d{3})(\d)/,"$1.$2")    //Coloca ponto entre o terceiro e o quarto dígitos
                v=v.replace(/(\d{3})(\d)/,"$1.$2")    //Coloca ponto entre o setimo e o oitava dígitos
                v=v.replace(/(\d{3})(\d)/,"$1-$2")   //Coloca ponto entre o decimoprimeiro e o decimosegundo dígitos
                return v
            }

        </script>
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
