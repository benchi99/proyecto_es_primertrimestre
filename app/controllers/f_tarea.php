<?php
require_once __DIR__ . '/../models/Tarea.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/consultas_comunes.php';

$errores = [
    "descripcion" => null,
    "poblacion" => null,
    "cp" => null,
    "provincia" => null,
    "persona_contacto" => null,
    "fecha_realizacion" => null
];

$campos_insertados = [
    "descripcion" => null,
    "poblacion" => null,
    "cp" => null,
    "provincia" => null,
    "persona_contacto" => null,
    "estado" => null,
    "persona_encargada" => null,
    "fecha_realizacion" => null,
    "anotacion_anterior" => null,
    "anotacion_posterior" => null
];

if (!$_GET) {
    // Hacer algo
} else {
    if (isset($_GET['action'])) {
        $usuarios = obtain_all_users();

        switch ($_GET['action']) {
            case 1:
                if (!$_POST) {
                    // Simplemente redirigir a formulario vacio
                    try {
                        echo $blade->run('Tareas.f_tareas', ["action" => 1,
                            "usuarios" => $usuarios,
                            "errores" => $errores,
                            "valores_antiguos" => $campos_insertados
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
                                header("Location: listar.php?status=1");
                            } else {
                                echo $blade->run('Error.error', ['error' => 'La tarea no se ha insertado correctamente. Contacte con el administrador.']);
                            }

                        } catch (Exception $e) {
                            echo $e->getMessage();
                        }

                        // Enviar a ventana de éxito.
                    } else {    // Los datos insertados no son correctos.
                        obtain_set_values();
                        try {
                            echo $blade->run('Tareas.f_tareas', [
                                "action" => 1,
                                "usuarios" => $usuarios,
                                "errores" => $errores,
                                "valores_antiguos" => $campos_insertados
                            ]);
                        } catch (Exception $e) {
                            echo $e->getMessage();
                        }
                    }
                }
                break;
            case 2:
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
                                "valores_antiguos" => $campos_insertados
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
                                    header("Location: listar.php?status=2");
                                } else {
                                    try {
                                        echo $blade->run('Error.error', ['error' => 'Error al actualizar tarea: No se ha podido actualizar el dato. Contácta con el administrador.']);
                                    } catch (Exception $e) {
                                        $e->getMessage();
                                    }
                                }
                            } catch (Exception $e) {
                                $e->getMessage();
                            }

                        } else { // Los datos a editar NO son válidos.
                            obtain_set_values();
                            try {
                                echo $blade->run('Tareas.f_tareas', [
                                    "action" => 2,
                                    "tarea" => $tarea,
                                    "usuarios" => $usuarios,
                                    "errores" => $errores,
                                    "valores_antiguos" => $campos_insertados
                                ]);
                            } catch (Exception $e) {
                                $e->getMessage();
                            }
                        }
                    }
                } else {
                    try {
                        echo $blade->run('Error.error', ['error' => 'Error al obtener tarea: No se ha especificado ID.']);
                    } catch (Exception $e) {
                        $e->getMessage();
                    }
                }
                break;
            case 3:
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
                        header("Location: listar.php?status=3");
                    } else {
                        try {
                            echo $blade->run('Error.error', ['error' => 'Error al eliminar tarea: Esta tarea no existe.']);
                        } catch (Exception $e) {
                            $e->getMessage();
                        }
                    }
                } else {
                    try {
                        echo $blade->run('Error.error', ['error' => 'Error al obtener tarea: No se ha especificado ID.']);
                    } catch (Exception $e) {
                        $e->getMessage();
                    }
                }
                break;
            case 4:
                if (isset($_GET['task_id'])) {
                    try {
                        $tarea = new Tarea(['id' => $_GET['task_id']]);
                    } catch (Exception $e) {
                        $e->getMessage();
                    }
                    if (!$tarea->complete_task()) {
                        try {
                            echo $blade->run('Error.error', ['error' => 'Error al completar tarea: No se ha podido actualizar el dato. Contácta con el administrador.']);
                        } catch (Exception $e) {
                            $e->getMessage();
                        }
                    } else {
                        header("Location: listar.php?status=4");
                    }
                } else {
                    try {
                        echo $blade->run('Error.error', ['error' => 'Error al obtener tarea: No se ha especificado ID.']);
                    } catch (Exception $e) {
                        $e->getMessage();
                    }
                }
                break;
        }
    } else {
        try {
            echo $blade->run('Error.error', ['error' => 'Acceso denegado a URL.']);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
}

/**
 * Valido los datos insertados según las especificaciones de la tarea.
 *
 * @return bool
 */
function valida_datos() {
    $estado = true;

    // DESCRIPCION
    if (empty($_POST['descripcion'])) {
        $GLOBALS['errores']['descripcion'] = "No se ha insertado ninguna descripción.";
        $estado = false;
    }

    // POBLACIÓN
    if (empty($_POST['poblacion'])) {
        $GLOBALS['errores']['poblacion'] = "No se ha insertado ninguna población.";
        $estado = false;
    }

    // CP
    if (empty($_POST['cp'])) {
        $GLOBALS['errores']['cp'] = "No se ha insertado ningún código postal." ;
        $estado = false;
    } else if (strlen($_POST['cp']) < 5) {
        $GLOBALS['errores']['cp'] = "El código postal insertado es inválido.";
        $estado = false;
    }

    // Provincia
    if (empty($_POST['provincia'])) {
        $GLOBALS['errores']['provincia'] = "No se ha seleccionado provincia.";
        $estado = false;
    }

    if (empty($_POST['persona_contacto'])) {
        $GLOBALS['errores']['persona_contacto'] = "No se ha seleccionado ninguna persona de contacto.";
        $estado = false;
    }

    // Fecha realización
    if (empty($_POST['fecha_realizacion'])) {
        $GLOBALS['errores']['fecha_realizacion'] = "No se ha insertado fecha de realización.";
        $estado = false;
    } else if (!preg_match("/[0-9]{2}\W[0-9]{2}\W[0-9]{4}/", $_POST['fecha_realizacion'])) {
        $GLOBALS['errores']['fecha_realizacion'] = "La estructura de la fecha es incorrecta.";
        $estado = false;
    } else if (!valida_fecha($_POST['fecha_realizacion'])) {
        $GLOBALS['errores']['fecha_realizacion'] = "La fecha insertada es inválida.";
        $estado = false;
    }  else if (strtotime($_POST['fecha_realizacion']) < strtotime(date('d-m-Y'))) {
        $GLOBALS['errores']['fecha_realizacion'] = "La fecha establecida es anterior a la fecha actual.";
        $estado = false;
    }

    return $estado;
}

/**
 * Obtiene todos los valores de $_POST del formulario de tareas y los guarda en un array.
 */
function obtain_set_values() {
    // TODO: VALORPOST/VALORGET

    if (isset($_POST['id'])) {
        $GLOBALS['campos_insertados']['id'] = $_POST['descripcion'];
    }

    if (isset($_POST['descripcion'])) {
        $GLOBALS['campos_insertados']['descripcion'] = $_POST['descripcion'];
    }

    if (isset($_POST['poblacion'])) {
        $GLOBALS['campos_insertados']['poblacion'] = $_POST['poblacion'];
    }

    if (isset($_POST['cp'])) {
        $GLOBALS['campos_insertados']['cp'] = $_POST['cp'];
    }

    if (isset($_POST['persona_contacto'])) {
        $GLOBALS['campos_insertados']['persona_contacto'] = $_POST['persona_contacto'];
    }

    if (isset($_POST['estado'])) {
        $GLOBALS['campos_insertados']['estado'] = $_POST['estado'];
    }

    if (isset($_POST['fecha_creacion'])) {
        $GLOBALS['campos_insertados']['fecha_creacion'] = $_POST['fecha_creacion'];
    }

    if (isset($_POST['persona_encargada'])) {
        $GLOBALS['campos_insertados']['persona_encargada'] = $_POST['persona_encargada'];
    }

    if (isset($_POST['fecha_realizacion'])) {
        $GLOBALS['campos_insertados']['fecha_realizacion'] = $_POST['fecha_realizacion'];
    }

    if (isset($_POST['anotacion_anterior'])) {
        $GLOBALS['campos_insertados']['anotacion_anterior'] = $_POST['anotacion_anterior'];
    }

    if (isset($_POST['anotacion_posterior'])) {
        $GLOBALS['campos_insertados']['anotacion_posterior'] = $_POST['anotacion_posterior'];
    }
}

function valida_fecha($fecha, $formato = 'd-m-Y') {
    $d = DateTime::createFromFormat($formato, $fecha);
    return $d && $d->format($formato) == $fecha;
}