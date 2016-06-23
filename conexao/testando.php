<?php

require 'database.php';

?>

<!doctype html>
<html> <?php  if (!isset($_SESSION)) session_start();  // Verifica se não há a variável da sessão que identifica o usuário if (!isset($_SESSION['UsuarioID'])) {     // Destrói a sessão por segurança     session_destroy();     // Redireciona o visitante de volta pro login     header("Location: inicio.php"); exit; } ?>
<head>
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

    <!--	<link href="css/jquery.click-calendario-1.0.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="_scripts/jquery.js"></script>
        <script type="text/javascript" src="_scripts/jquery.click-calendario-1.0-min.js"></script>
        <script type="text/javascript" src="_scripts/exemplo-calendario.js"></script>
        <script type="text/javascript" src="_scripts/validacpf.js"></script> -->

</head>
<body>

                <label class="control-label">Produto</label> <span> <?php echo !empty ($cod_produto); ?> </span>
                <div class="controls">
                    <select name = "produto"  required class = "select bradius" id="opcao" style="width: 252px; height: 42px">
                        <option value=""disabled selected style='display:none;'>Selecione o Produto</option>
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

                    <select data-placeholder="Escolha o Produto" class="chosen-select" tabindex="4" style="width:300px" id="opcao" name="produto">
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



</body>
</html>