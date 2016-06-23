<?
require 'database.php';
?>
<!DOCTYPE html>
<html> <?php  if (!isset($_SESSION)) session_start();  // Verifica se não há a variável da sessão que identifica o usuário if (!isset($_SESSION['UsuarioID'])) {     // Destrói a sessão por segurança     session_destroy();     // Redireciona o visitante de volta pro login     header("Location: inicio.php"); exit; } ?>
<head>
    <meta charset="utf-8">
    <title>
        testando a parada
    </title>
    <style>
        body { margin-bottom: 144px; }
        header { margin: 72px 0 36px; }
        header h1 { font-size: 54px; }
    </style>
    <link rel="stylesheet" href="../_scripts/bootstrap-chosen.css"/>
    <script src="../_scripts/jquery.min.js"></script>
    <script src="../_scripts/chosen.jquery.js"></script>
    <script>
        $(function() {
            $('.chosen-select').chosen();
            $('.chosen-select-deselect').chosen({ allow_single_deselect: true });
        });
    </script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <select data-placeholder="Choose a Country" class="chosen-select" multiple tabindex="4">
                <option value=""></option>
                <?php
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $resultado = "SELECT * FROM produtos";
                Database::disconnect();

                if(count($resultado)){
                    foreach ($pdo->query($resultado) as $res) {
                        ?>
                        <option value="<?php echo $res['cod_produto'];?>"><?php echo $res['nome'];?></option>
                        <?php
                    }
                }
                ?>
            </select>
        </div>
    </div>
</div>
</body>
</html>
