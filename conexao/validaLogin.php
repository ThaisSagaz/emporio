<?php
    $login = $_POST['login'];
    $entrar = $_POST['entrar'];
    $senha = md5($_POST ["senha"]);
    $connect = @mysql_connect('localhost','root','');
    $db = mysql_select_db('bd_emporio');
        if (isset($entrar)) {
                     
            $verifica = mysql_query("SELECT * FROM usuarios WHERE login = '$login' AND senha = '$senha'") or die("Erro ao conectar ao banco de dados, contate o administrador!");
           // echo $verifica;
                if (mysql_num_rows($verifica)<=0){
                    echo"<script language='javascript' type='text/javascript'>alert('Login e/ou senha incorretos');window.location.href='../index.php';</script>";
                    die();
                }else{
                    // Salva os dados encontados na variável $resultado
                    $resultado = mysql_fetch_assoc($verifica);

                    //setcookie("login",$login);

                    // Se a sessão não existir, inicia uma
                    if (!isset($_SESSION)) session_start();

                    // Salva os dados encontrados na sessão
                    $_SESSION['UsuarioID'] = $resultado['cod_usuario'];
                    $_SESSION['UsuarioNome'] = $resultado['name'];
                    $_SESSION['UsuarioAcesso'] = $resultado['acesso'];
                    $_SESSION['UsuarioLogin'] = $resultado['login'];



                    //Direciona para a página principal
                    header("Location:../inicio.php"); exit;


                }
        }
?>