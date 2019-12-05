<?php

require_once __DIR__.'/../models/utils.php';
require_once __DIR__.'/../models/consultas_comunes.php';

$rol_requerido = 0;

include __DIR__.'/validacion_usuarios.php';

$errores = [];
$campos_insertados = [];

if($_SESSION) {
    // Ya hay una sesión activa.
  header('Location: '.__DIR__.'/../index.php');
} else if (!$_POST) {
    // no se ha insertado nada
    echo $blade->run('General.login_form', [
        'errores' => $errores,
        'campos_insertados' => $campos_insertados,
        'sesion_iniciada' => $sesion_iniciada,
        'usuario' => $nombre_usuario
    ]);
} else {
    // se han insertado datos
    $error = false;
    if (vp('nombreusu') && vp('pass')) {
        $nombreusu = vp('nombreusu');
        $pass = vp('pass');
        $usuario = obtain_user_by_username($nombreusu);

        if (!$usuario) {
            $errores['nombreusu'] = "El usuario insertado no existe.";
            $error = true;
        } else if (!password_verify($pass, $usuario->pass)) {
            $errores['pass'] = "La contraseña es incorrecta.";
            $error = true;
        } else {
            iniciar_sesion($usuario->nombre_usuario, $usuario->rol);
        }

        if ($error) {
            $campos_insertados = todos_vp();
            echo $blade->run('General.login_form', [
                'errores' => $errores,
                'campos_insertados' => $campos_insertados
            ]);
        }
    }
}

function iniciar_sesion($nombre_usuario, $rol) {
    session_start();
    $_SESSION['usuario'] = $nombre_usuario;
    $_SESSION['rol'] = $rol;
    header("Location: ".__DIR__."/../index.php");
}
