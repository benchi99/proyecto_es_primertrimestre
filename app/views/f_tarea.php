<?php
require '../models/Tarea.php';
require '../config.php';

if (!$_GET) {
    // Hacer algo
} else {
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 1:
                // Simplemente redirigir a formulario vacio
                try {
                    echo $blade->run('Tareas.f_tareas', ["action" => 1]);
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
                break;
            case 2:
                // Comprobar si viene id a editar
                if (isset($_GET['task_id'])) {
                    // Obtener tarea
                    // Enviar objeto tarea a formulario
                    try {
                        $tarea = new Tarea(["id" => $_GET['task_id']]);
                        echo $blade->run('Tareas.f_tareas', ["action" => 2, "tarea" => $tarea]);
                    } catch (Exception $e) {
                        echo $e->getMessage();
                    }
                }
                break;
            case 3:
                // Comprobar si viene id al eliminar
                if (isset($_GET['task_id'])) {
                    // Obtener tarea y enviar señal para eliminar
                    // TODO: hacer justo lo que pone en el comentario encima mío
                }
        }
    }
}