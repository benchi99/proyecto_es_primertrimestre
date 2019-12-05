<?php

session_start();

$sesion_iniciada = false;
$nombre_usuario = null;

if (!$_SESSION['usuario']) {
    header('Location: '.__DIR__.'/../index.php?a=3');
} else if ($_SESSION['rol'] < $rol_requerido) {
    echo $blade->run('Error.error', ['error' => 'Acceso denegado. Se requiere de más permisos para acceder a esta página.']);
} else {
    $sesion_iniciada = true;
    $nombre_usuario = $_SESSION['usuario'];
}
