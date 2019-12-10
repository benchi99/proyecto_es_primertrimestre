<?php
$rol_requerido = ROL_ADMIN;

include __DIR__ . '/validacion_usuarios.php';

include_once __DIR__ . '/f_usuario.php';

if (!$_POST) {
    // Obtener usuario, enviar a vista
    try {
        $usuario = obtain_user_by_username($nombre_usuario);
        echo $blade->run('Usuarios.editar_cuenta', [
            'usuario_editar' => $usuario,
            'usuario' => $nombre_usuario,
            'errores' => $errores,
            'valores_antiguos' => $campos_insertados,
            'sesion_iniciada' => $sesion_iniciada,
            'rol_actual' => intval($_SESSION['rol'])
        ]);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
} else {
    // Se quiere actualizar usuario
    // Obtener tarea y editar
    try {
        $usuario = obtain_user_by_username($nombre_usuario);

        // Si ha modificado el nombre de usuario, está ya en uso?
        if (vp('nombre_usuario') && (obtain_user_by_username(vp('nombre_usuario')) != $usuario)) {
            $errores['nombre_usuario'] = "Este nombre de usuario ya está en uso.";
            $campos_insertados = todos_vp();
            echo $blade->run('Usuarios.editar_cuenta', [
                'usuario_editar' => $usuario,
                'usuario' => $nombre_usuario,
                'errores' => $errores,
                'valores_antiguos' => $campos_insertados,
                'sesion_iniciada' => $sesion_iniciada,
                'rol_actual' => intval($_SESSION['rol'])
            ]);
            exit;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    $usuario->nombre_usuario = vp('nombre_usuario');
    if (vp('pass')) {
        $usuario->pass = password_hash(vp('pass'), PASSWORD_DEFAULT);
    }
    $usuario->email = vp('email');

    try {
        if ($usuario->commit_to_database()) {
            header('Location:index.php?a=11');
        } else {
            echo $blade->run('Error.error', [
                'error' => 'Error al actualizar usuario: no se ha podido actualizar el dato. Contácta con el administrador.',
                'usuario' => $nombre_usuario,
                'sesion_iniciada' => $sesion_iniciada,
                'rol_actual' => intval($_SESSION['rol'])
            ]);
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
