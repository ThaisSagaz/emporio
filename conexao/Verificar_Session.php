<?php


if (!isset($_SESSION)) session_start();

// Verifica se n�o h� a vari�vel da sess�o que identifica o usu�rio
if (!isset($_SESSION['UsuarioID'])) {
    // Destr�i a sess�o por seguran�a
    session_destroy();
    // Redireciona o visitante de volta pro login
    header("Location: ../index.php"); exit;
}

?>