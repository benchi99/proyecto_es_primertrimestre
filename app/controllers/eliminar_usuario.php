<?php
$rol_requerido = ROL_ADMIN;

include __DIR__ . '/validacion_usuarios.php';

include_once __DIR__ . '/f_usuario.php';

if (vg('user_id')) {
    try {
        $usuario = new Usuario(['id' => vg('user_id')]);
        echo $blade->run('Usuarios.eliminar', [
            'usuario_eliminar' => $usuario,
            'usuario' => $nombre_usuario,
            'sesion_iniciada' => $sesion_iniciada,
            'rol_actual' => intval($_SESSION['rol'])
        ]);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
} else if (vp('id')) {
    try {
        $usuario = new Usuario(['id' => vp('ip')]);
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    if ($usuario->id) {
        $usuario->delete();
        header("Location:index.php?a=11");
    } else {
        try {
            echo $blade->run('Error.error', [
                'error' => 'Error al eliminar usuario: Este usuario no existe.',
                'usuario' => $nombre_usuario,
                'sesion_iniciada' => $sesion_iniciada,
                'rol_actual' => intval($_SESSION['rol'])
            ]);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
} else {
    try {
        echo $blade->run('Error.error', [
            'error' => 'Error al obtener usuario: No se ha especificado ID.',
            'usuario' => $nombre_usuario,
            'sesion_iniciada' => $sesion_iniciada,
            'rol_actual' => intval($_SESSION['rol'])
        ]);
    } catch (Exception $e) {
        $e->getMessage();
    }
}