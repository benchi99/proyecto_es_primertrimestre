<?php
$rol_requerido = 1;

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
                'sesion_iniciada' => $sesion_iniciada
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
        $tarea->descripcion = $_POST['descripcion'];
        $tarea->poblacion = $_POST['poblacion'];
        $tarea->codigo_postal = $_POST['cp'];
        $tarea->provincia = $_POST['provincia'];
        $tarea->persona_contacto = $_POST['persona_contacto'];
        $tarea->estado = $_POST['estado'];
        $tarea->fecha_creacion = $_POST['fecha_creacion'];
        $tarea->persona_encargada = $_POST['persona_encargada'];
        $tarea->fecha_realizacion = DateTime::createFromFormat('d-m-Y', $_POST['fecha_realizacion'])->format('Y-m-d');
        $tarea->anotacion_anterior = $_POST['anotacion_anterior'];
        $tarea->anotacion_posterior = $_POST['anotacion_posterior'];

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
                            'sesion_iniciada' => $sesion_iniciada
                        ]);
                    } catch (Exception $e) {
                        $e->getMessage();
                    }
                }
            } catch (Exception $e) {
                $e->getMessage();
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
                    'sesion_iniciada' => $sesion_iniciada
                ]);
            } catch (Exception $e) {
                $e->getMessage();
            }
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

