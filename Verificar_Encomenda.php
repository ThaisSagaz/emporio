<!DOCTYPE html> 

    <?php
    header('Content-Type: text/html; charset=UTF-8');
    if ( !empty($_POST)) {

    $valorCPFError = null;

    $valorCPF = $_POST['cpf'];

    if (empty($valorCPF)) {
        $valorCPFError = 'Por favor digite um CPF!';
    }

    $connect = mysql_connect('localhost','root','');
    $db = mysql_select_db('bd_emporio');


    $verifica = mysql_query("SELECT * FROM clientes WHERE cpf = '$valorCPF'") or die("erro ao selecionar");
    if (mysql_num_rows($verifica)<=0){
        echo"<script language='javascript' type='text/javascript'>alert('CPF não encontrado!');window.location.href='Verificar_Encomenda.php';</script>";
        die();
    } else {

        // Salva os dados encontados na vari?vel $resultado
        $resultado = mysql_fetch_assoc($verifica);


        header("Location:forms/CadastrarEncomenda.php?cod_cliente=".$resultado['cod_cliente'].""); exit;

    }
}
?>

<html> <?php

    if (!isset($_SESSION)) session_start();

        // Verifica se não há a variável da sessão que identifica o usuário
        if (!isset($_SESSION['UsuarioID'])) {
         // Destrói a sessão por segurança
         session_destroy();
         // Redireciona o visitante de volta pro login
         header("Location: index.php"); exit;
        } ?>
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Verificar Encomenda</title>

        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/AdminLTE.css">
        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
page. However, you can choose any other skin. Make sure you
apply the skin class to the body tag so the changes take effect.
-->
        <link rel="stylesheet" href="dist/css/skins/skin-blue.css">

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



    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <!-- Main Header -->
            <?php include_once("includes/header.php") ?>
            <!-- Left side column. contains the logo and sidebar -->
            <?php include_once("includes/menu.php") ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="box box-warning">
                            <div class="box-header with-border">
                                <h3 class="box-title">Inserir Encomendas</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <form action="Verificar_Encomenda.php" method="post">
                                    <div class="form-group">
                                        <label>Cliente Novo?</label>
                                    </div>
                                    <div class="form-group">
                                        <a class="btn btn-danger" href="forms/cadastrar_cliente.php">Cadastrar cliente</a>
                                    </div>
                                    <div class="form-group">
                                        <label>Cliente Já cadastrado?</label>
                                        <input type="text" class="form-control" name="cpf" id="cpf" onblur="javascript: validarCPF(this.value);" onkeypress="javascript: mascara(this, cpf_mask);"  maxlength="14" />
                                    </div>
                                    <button type="submit" class="btn btn-danger">Criar</button>
                                    <a class="btn btn-default" href="encomendas.php">Voltar</a>
                                </form>
                            </div><!-- box body -->
                        </div><!-- box Warning -->

                    </div>    
                     </div><!-- box Warning -->
           

                </section><!-- /.content -->
   
     
        
        
        
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
        <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/app.min.js"></script>

        <!-- Optionally, you can add Slimscroll and FastClick plugins.
Both of these plugins are recommended to enhance the
user experience. Slimscroll is required when using the
fixed layout. -->
    </body>
</html>
