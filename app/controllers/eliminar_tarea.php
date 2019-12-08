<?php
$rol_requerido = 0;

include __DIR__.'/validacion_usuarios.php';

include_once __DIR__ . '/f_tarea.php';

// Comprobar si viene id al eliminar
if (isset($_GET['task_id'])) {
    // Obtener tarea y enviar señal para eliminar
    try {
        $tarea = new Tarea(['id' => $_GET['task_id']]);
    } catch (Exception $e) {
        $e->getMessage();
    }
    if ($tarea->id) {
        $tarea->delete();
        header("Location: index.php");
    } else {
        try {
            echo $blade->run('Error.error', [
                'error' => 'Error al eliminar tarea: Esta tarea no existe.',
                'usuario' => $nombre_usuario,
                'sesion_iniciada' => $sesion_iniciada
            ]);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
} else {
    try {
        echo $blade->run('Error.error', [
            'error' => 'Error al obtener tarea: No se ha especificado ID.',
            'usuario' => $nombre_usuario,
            'sesion_iniciada' => $sesion_iniciada
        ]);
    } catch (Exception $e) {
        $e->getMessage();
    }
}
