<?php

    $rol_requerido = ROL_ADMIN;

    include __DIR__.'/validacion_usuarios.php';

    include_once __DIR__ . '/f_tarea.php';

    if (!$_POST) {
        // Simplemente redirigir a formulario vacio
        try {
            echo $blade->run('Tareas.f_tareas', ["action" => 1,
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
        // Hay datos de formulario, el usuario está intentando insertar a BD
        if (valida_datos()) {   // Los datos insertados son correctos.
            try {
                $tarea_nueva = new Tarea([
                    'descripcion' => $_POST['descripcion'],
                    'poblacion' => $_POST['poblacion'],
                    'codigo_postal' => intval($_POST['cp']),
                    'provincia' => $_POST['provincia'],
                    'persona_contacto' => intval($_POST['persona_contacto']),
                    'estado' => 0,
                    'fecha_creacion' => date('Y-m-d'),
                    'persona_encargada' => isset($_POST['persona_encargada']) ? intval($_POST['persona_encargada']) : 0,
                    'fecha_realizacion' => DateTime::createFromFormat('d-m-Y', $_POST['fecha_realizacion'])->format('Y-m-d'),
                    'anotacion_anterior' => isset($_POST['anotacion_anterior']) ? $_POST['anotacion_anterior'] : '',
                    'anotacion_posterior' => isset($_POST['anotacion_posterior']) ? $_POST['anotacion_posterior'] : '',
                ]);

                if ($tarea_nueva->commit_to_database()) {
                    header("Location: index.php");
                } else {
                    echo $blade->run('Error.error', [
                        'error' => 'La tarea no se ha insertado correctamente. Contacte con el administrador.',
                        'usuario' => $nombre_usuario,
                        'sesion_iniciada' => $sesion_iniciada,
                        'rol_actual' => intval($_SESSION['rol'])
                    ]);
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        } else {    // Los datos insertados no son correctos.
            $campos_insertados = todos_vp();
            try {
                echo $blade->run('Tareas.f_tareas', [
                    "action" => 1,
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
