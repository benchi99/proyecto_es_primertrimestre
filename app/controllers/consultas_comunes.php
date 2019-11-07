<?php
    require __DIR__.'/bd_gest.php';
    require __DIR__.'/../models/Tarea.php';

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

        $data = $conexion->query("SELECT tsk_id FROM ".TABLA_TAREAS);

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