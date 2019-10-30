<?php
    require __DIR__.'/bd_gest.php';

    /**
     * Consulta la base de datos para obtener todas las tareas existentes.
     *
     * @return array|bool|mysqli_result
     */
    function obtain_all_tasks() {
        $bd = bd_gest::get_instance();
        $response_data = [];

        $data = $bd->ejecuta_sql("SELECT tsk_id FROM ".TABLA_TAREAS);

        if (!$data) {
            return $data;
        } else {
            while ($fila = $data->fetch_assoc()) {
                $response_data[] += new Tarea($fila["tsk_id"]);
            }
            return $response_data;
        }
    }