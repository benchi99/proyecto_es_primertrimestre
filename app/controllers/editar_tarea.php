<?php
$rol_requerido = ROL_ADMIN;

include __DIR__.'/validacion_usuarios.php';

include_once __DIR__ . '/f_tarea.php';

// Comprobar si viene id a editar
if (isset($_GET['task_id']) || isset($_POST['id'])) {
    if (!$_POST) {
        // Obtener tarea
        // Enviar objeto tarea a formulario
        try {
            $tarea = new Tarea(["id" => $_GET['task_id']]);
            echo $blade->run('Tareas.f_tareas', [
                "action" => 2,
                "tarea" => $tarea,
                "usuarios" => $usuarios,
                "errores" => $errores,
                "valores_antiguos" => $campos_insertados,
                'usuario' => $nombre_usuario,
                'sesion_iniciada' => $sesion_iniciada,
                'rol_actual' => intval($_SESSION['rol'])
            ]);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    } else {
        // El usuario quiere actualizar la tarea.
        // Obtener la tarea a editar, y editarla.
        try {
            $tarea = new Tarea(["id" => $_POST['id']]);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        // TODO: posiblemente encapsular esto dentro del modelo de la tarea.
        $tarea->descripcion = vp('descripcion');
        $tarea->poblacion = vp('poblacion');
        $tarea->codigo_postal = vp('cp');
        $tarea->provincia = vp('provincia');
        $tarea->persona_contacto = vp('persona_contacto');
        $tarea->estado = vp('estado');
        $tarea->fecha_creacion = vp('fecha_creacion');
        $tarea->persona_encargada = vp('persona_encargada');
        $tarea->fecha_realizacion = DateTime::createFromFormat('d-m-Y', vp('fecha_realizacion'))->format('Y-m-d');
        $tarea->anotacion_anterior = vp('anotacion_anterior');
        $tarea->anotacion_posterior = vp('anotacion_posterior');

        if (valida_datos()) { // Los datos a editar son válidos
            try {
                $estado = $tarea->commit_to_database();

                if ($estado) {
                    header("Location:index.php");
                } else {
                    try {
                        echo $blade->run('Error.error', [
                            'error' => 'Error al actualizar tarea: No se ha podido actualizar el dato. Contácta con el administrador.',
                            'usuario' => $nombre_usuario,
                            'sesion_iniciada' => $sesion_iniciada,
                            'rol_actual' => intval($_SESSION['rol'])
                        ]);
                    } catch (Exception $e) {
                        echo $e->getMessage();
                    }
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }

        } else { // Los datos a editar NO son válidos.
            $campos_insertados = todos_vp();
            try {
                echo $blade->run('Tareas.f_tareas', [
                    "action" => 2,
                    "tarea" => $tarea,
                    "usuarios" => $usuarios,
                    "errores" => $errores,
                    "valores_antiguos" => $campos_insertados,
                    'usuario' => $nombre_usuario,
                    'sesion_iniciada' => $sesion_iniciada,
                    'rol_actual' => intval($_SESSION['rol'])
                ]);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    }
} else {
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

