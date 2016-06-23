<?php
if ( !empty($_POST)) {

    $valorCPFError = null;

    $valorCPF = $_POST['valor_cpf'];

    if (empty($valorCPF)) {
        $valorCPFError = 'Por favor digite um CPF!';
    }

    $connect = @mysql_connect('localhost','root','');
    $db = mysql_select_db('bd_emporio');


            $verifica = mysql_query("SELECT * FROM usuarios WHERE cpf = '$valorCPF'") or die("Erro ao conectar ao banco de dados, contate o administrador!");
                if (mysql_num_rows($verifica)<=0){
                    echo"<script language='javascript' type='text/javascript'>alert('CPF não encontrado!');window.location.href='Validar_Cpf.php';</script>";
                    die();
                } else {

                  // Salva os dados encontados na vari�vel $resultado
                  $resultado = mysql_fetch_assoc($verifica);
                  //verifica se há alguem logado ou na sessão
                  if (!isset($_SESSION)) session_start();
                  // Coloca o id do usuario na sessão
                  $_SESSION['UsuarioID'] = $resultado['cod_usuario'];

                  header("Location:../forms/EsqueceuSenha.php"); exit;

                }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Validar Cpf</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.css">
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
function teste() {

window.location='EsqueceuSenha.php';
}

 function cpf_mask(v){
        v=v.replace(/\D/g,"")                 //Remove tudo o que não é dígito
        v=v.replace(/(\d{3})(\d)/,"$1.$2")    //Coloca ponto entre o terceiro e o quarto dígitos
        v=v.replace(/(\d{3})(\d)/,"$1.$2")    //Coloca ponto entre o setimo e o oitava dígitos
        v=v.replace(/(\d{3})(\d)/,"$1-$2")   //Coloca ponto entre o decimoprimeiro e o decimosegundo dígitos
        return v
      }
</script>
  </head>


  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
       <a href="#"><b>Empório das Tortas</b></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Esqueceu a senha?</p>


        <form action="Validar_cpf.php" method="post">
          <div class="form-group has-feedback">
            <input id="valor_cpf" name="valor_cpf" type="text" class="form-control" placeholder="CPF" value="" onblur="javascript: validarCPF(this.value);" onkeypress="javascript: mascara(this, cpf_mask);"  maxlength="14"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <span></span><br>
          <div class="row">
            <div class="col-xs-8">
              <a class="btn btn-default" href="../index.php">Voltar</a>
            </div><!-- /.col -->
            <div class="col-xs-4">

              <button name="entrar" value="Redefinir Senha" type="submit" class="btn btn-danger btn-block btn-flat">Redefinir</button>
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
<script type="text/javascript">
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

  </body>
</html>
