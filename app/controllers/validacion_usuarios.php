<?php

session_start();

$sesion_iniciada = false;
$nombre_usuario = null;

if (!$_SESSION) {
    header('Location:index.php?a=9');
} else if ($_SESSION['rol'] < $rol_requerido) {
    try {
        $sesion_iniciada = true;
        $nombre_usuario = $_SESSION['usuario'];
        echo $blade->run('Error.error', [
            'error' => 'Acceso denegado. Se requiere de más permisos para acceder a esta página.',
            'usuario' => $nombre_usuario,
            'sesion_iniciada' => $sesion_iniciada
        ]);
        exit;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
} else {
    $sesion_iniciada = true;
    $nombre_usuario = $_SESSION['usuario'];
}
