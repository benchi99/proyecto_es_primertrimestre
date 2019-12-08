<?php
$rol_requerido = 0;

include __DIR__.'/validacion_usuarios.php';

include_once __DIR__ . '/f_tarea.php';

if (isset($_GET['task_id'])) {
    try {
        $tarea = new Tarea(['id' => $_GET['task_id']]);
    } catch (Exception $e) {
        $e->getMessage();
    }
    if (!$tarea->complete_task()) {
        try {
            echo $blade->run('Error.error', [
                'error' => 'Error al completar tarea: No se ha podido actualizar el dato. Contácta con el administrador.',
                'usuario' => $nombre_usuario,
                'sesion_iniciada' => $sesion_iniciada
            ]);
        } catch (Exception $e) {
            $e->getMessage();
        }
    } else {
        header("Location:index.php");
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
