<?php
    require_once __DIR__ .'/../models/bd_gest.php';
    require_once __DIR__.'/../models/Tarea.php';
    require_once __DIR__.'/../models/Usuario.php';

    /**
     * Consulta la base de datos para obtener todas las tareas existentes.
     *
     * @return array|bool|mysqli_result Consulta
     * @throws Exception Error al construir objetos Tarea.
     */
    function obtain_all_tasks() {
        $bd = bd_gest::get_instance();
        $conexion = $bd->get_connection();
        $response_data = [];

        $data = $conexion->query("SELECT tsk_id FROM pryt1_tarea");

        if (!$data) {
            return $data;
        } else {
            while ($fila = $data->fetch_assoc()) {
                array_push($response_data, new Tarea([ 'id' =>
                                                                $fila["tsk_id"]]));
            }
            return $response_data;
        }
    }

/**
 * Consulta a la base de datos para obtener todos los usuarios.
 *
 * @return array|bool|mysqli_result Consulta
 * @throws Exception Error al construir objetos de Usuario
 */
    function obtain_all_users() {
        $bd = bd_gest::get_instance();
        $conexion = $bd->get_connection();
        $response_data = [];

        $data = $conexion->query("SELECT usr_id FROM pryt1_usuarios");

        if (!$data) {
            return $data;
        } else {
            while ($fila = $data->fetch_assoc()) {
                array_push($response_data, new Usuario(['id' => $fila["usr_id"]]));
            }
            return $response_data;
        }
    }

/**
 * @param $query_string
 * @return array|bool|mysqli_result
 * @throws Exception Error al construir objetos
 */
    function get_tasks($query_string) {
        $bd = bd_gest::get_instance();
        $conexion = $bd->get_connection();
        $response_data = [];

        $data = $conexion->query("SELECT tsk_id FROM pryt1_tarea WHERE tsk_descripcion like '%".$query_string."%' or
                                tsk_poblacion like '%".$query_string."%' or
                                tsk_cp like '%".$query_string."%' or
                                tsk_provincia like '%".$query_string."%' or
                                tsk_persona_contacto like '%".$query_string."%' or
                                tsk_estado like '%".$query_string."%' or
                                tsk_fecha_creacion like '%".$query_string."%' or
                                tsk_persona_encargada like '%".$query_string."%' or
                                tsk_fecha_realizacion like '%".$query_string."%' or
                                tsk_anotacion_anterior like '%".$query_string."%' or
                                tsk_anotacion_posterior like '%".$query_string."%'");

        if (!$data) {
            return $data;
        } else {
            while ($fila = $data->fetch_assoc()) {
                array_push($response_data, new Tarea(['id' => $fila['tsk_id']]));
            }
            return $response_data;
        }
    }