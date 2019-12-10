<?php

require_once __DIR__.'/../models/utils.php';
require_once __DIR__.'/../models/consultas_comunes.php';

$errores = [
    'no_sesion_iniciada' => null,
    'nombreusu' => null,
    'pass' => null
];

$campos_insertados = [
    'nombreusu' => null,
    'pass' => null
];

if (isset($_SESSION)) {
    // Ya hay una sesión activa.
  header('Location:index.php');
} else if (!$_POST) {
    // no se ha insertado nada
    echo $blade->run('General.login_form', [
        'errores' => $errores,
        'campos_insertados' => $campos_insertados,
        'sesion_iniciada' => false,
        'usuario' => null
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
                'campos_insertados' => $campos_insertados,
                'sesion_iniciada' => false,
                'usuario' => null
            ]);
        }
    }
}

function iniciar_sesion($nombre_usuario, $rol) {
    session_start();
    $_SESSION['usuario'] = $nombre_usuario;
    $_SESSION['rol'] = $rol;
    header("Location:index.php");
}
