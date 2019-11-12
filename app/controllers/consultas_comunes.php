<?php
    require_once __DIR__ .'/../models/bd_gest.php';
    require_once __DIR__.'/../models/Tarea.php';
    require_once __DIR__.'/../models/Usuario.php';

    /**
     * Consulta la base de datos para obtener todas las tareas existentes.
     *
     * @return array|bool|mysqli_result
     * @throws Exception Parámetros que faltan de
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