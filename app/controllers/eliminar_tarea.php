<?php
$rol_requerido = ROL_ADMIN;

include __DIR__.'/validacion_usuarios.php';

include_once __DIR__ . '/f_tarea.php';

// Comprobar si viene id al eliminar
if (vg('task_id')) {
    // Obtener tarea y enviar señal para eliminar
    try {
        $tarea = new Tarea(['id' => $_GET['task_id']]);
        echo $blade->run('Tareas.eliminar', [
            'tarea_eliminar' => $tarea,
            'usuario' => $nombre_usuario,
            'sesion_iniciada' => $sesion_iniciada,
            'rol_actual' => intval($_SESSION['rol'])
        ]);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
} else if (vp('id')) {
    try {
        $tarea = new Tarea(['id' => vp('ip')]);
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    if ($tarea->id) {
        $tarea->delete();
        header("Location:index.php");
    } else {
        try {
            echo $blade->run('Error.error', [
                'error' => 'Error al eliminar tarea: Esta tarea no existe.',
                'usuario' => $nombre_usuario,
                'sesion_iniciada' => $sesion_iniciada,
                'rol_actual' => intval($_SESSION['rol'])
            ]);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}else {
    try {
        echo $blade->run('Error.error', [
            'error' => 'Error al obtener tarea: No se ha especificado ID.',
            'usuario' => $nombre_usuario,
            'sesion_iniciada' => $sesion_iniciada,
            'rol_actual' => intval($_SESSION['rol'])
        ]);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
