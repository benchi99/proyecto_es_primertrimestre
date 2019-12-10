<?php
    require_once __DIR__ . '/bd_gest.php';
    require_once __DIR__ . '/Tarea.php';
    require_once __DIR__ . '/Usuario.php';

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
     * Obtiene tareas según un parámetro de búsqueda (usado en la barra de búsqueda)
     * @param $query_string string Parámetro de búsuqeda
     * @return array|bool|mysqli_result Resultado de consulta
     * @throws Exception Error al construir objetos
     */
    function get_tasks($query_string) {
        $bd = bd_gest::get_instance();
        $conexion = $bd->get_connection();
        $param = $conexion->real_escape_string($query_string);  // Inyéctame esta quieres
        $response_data = [];

        $data = $conexion->query("SELECT tsk_id FROM pryt1_tarea WHERE tsk_descripcion like '%".$param."%' or
                                tsk_poblacion like '%".$param."%' or
                                tsk_cp like '%".$param."%' or
                                tsk_provincia like '%".$param."%' or
                                tsk_persona_contacto like '%".$param."%' or
                                tsk_estado like '%".$param."%' or
                                tsk_fecha_creacion like '%".$param."%' or
                                tsk_persona_encargada like '%".$param."%' or
                                tsk_fecha_realizacion like '%".$param."%' or
                                tsk_anotacion_anterior like '%".$param."%' or
                                tsk_anotacion_posterior like '%".$param."%'");

        if (!$data) {
            return $data;
        } else {
            while ($fila = $data->fetch_assoc()) {
                array_push($response_data, new Tarea(['id' => $fila['tsk_id']]));
            }
            return $response_data;
        }
    }

    /**
     * Obtiene usuarios según un parámetro de búsqueda (usado en la barra de búsqueda)
     * @param $query_string string Parametro de búsqueda
     * @return array|bool|mysqli_result Resultado de consulta
     * @throws Exception Error al construir objetos
     */
    function get_users($query_string) {
        $bd = bd_gest::get_instance();
        $conexion = $bd->get_connection();
        $param = $conexion->real_escape_string($query_string);  // Inyéctame esta quieres
        $response_data = [];

        $data = $conexion->query("SELECT usr_id FROM pryt1_usuarios WHERE usr_nombreusu like '%".$param."%' or
                                usr_nombre like '%".$param."%' or
                                usr_apellidos like '%".$param."%' or
                                usr_tlf like '%".$param."%' or
                                usr_email like '%".$param."%' or
                                usr_direccion like '%".$param."%' or
                                usr_rol like '%".$param."%'");

        if (!$data) {
            return $data;
        } else {
            while ($fila = $data->fetch_assoc()) {
                array_push($response_data, new Usuario(['id' => $fila['usr_id']]));
            }
            return $response_data;
        }

    }

    /**
     * Obtiene tareas según unos filtros especificados
     *
     * @param array $array Filtros.
     * @return array|bool|mysqli_result Tareas que cumplen filtros, o falso si no ha ido bien.
     * @throws Exception Error al construir objetos.
     */
    function get_task_fitered_by(array $array) {
        $bd = bd_gest::get_instance();
        $conexion = $bd->get_connection();
        $response_data = [];
        $where_params = [];

        foreach ($array as $queryparam => $value) {
            if ($value === '-1' || $queryparam === 'tipo_filtro_fecha_creacion' || $queryparam === 'tipo_filtro_fecha_realizacion') {
                continue;
            } else if ($queryparam === 'fecha_creacion' || $queryparam === 'fecha_realizacion') {
                $date_comparison_op = '=';
                switch ($queryparam) {
                    case "fecha_creacion":
                        $date_comparison_op = $array['tipo_filtro_fecha_creacion'];
                        break;
                    case " fecha_realizacion":
                        $date_comparison_op = $array['tipo_filtro_fecha_realizacion'];
                        break;
                }
                $where_params[] = 'tsk_'.$queryparam.' '.$date_comparison_op.' "'.DateTime::createFromFormat('d-m-Y', $value)->format('Y-m-d').'"';
            } else
                $where_params[] = 'tsk_'.$queryparam.' = '.$conexion->real_escape_string($value);
        }

        $sql = "SELECT tsk_id FROM pryt1_tarea WHERE ".implode(' AND ', $where_params);

        $consulta = $conexion->query($sql);

        if (!$consulta) {
            return $consulta;
        } else {
            while ($fila = $consulta->fetch_assoc()) {
                $response_data[] = new Tarea(['id' => $fila['tsk_id']]);
            }
            return $response_data;
        }
    }

    function obtain_user_by_username($username) {
        $bd = bd_gest::get_instance();
        $conexion = $bd->get_connection();

        $consulta = $conexion->query("SELECT usr_id FROM pryt1_usuarios WHERE usr_nombreusu = '".$username."'");

        if (!$consulta->num_rows) {
            return false;
        } else {
            $fila = $consulta->fetch_assoc();

            return new Usuario(["id" => $fila['usr_id']]);
        }
    }

    function get_provinces() {
        $result_set = [];
        $bd = bd_gest::get_instance();
        $conexion = $bd->get_connection();

        $consulta = $conexion->query("SELECT id, provincia FROM provincias");

        if (!$consulta->num_rows) {
            return false;
        } else {
            while ($fila = $consulta->fetch_assoc()) {
                $provincia = [
                    "id" => $fila['id'], "provincia" => utf8_encode($fila['provincia'])
                ];

                $result_set[] = $provincia;
            }
            return $result_set;
        }
    }

    function get_town_id_by_name($town_name, $province_id) {
        $bd = bd_gest::get_instance();
        $conexion = $bd->get_connection();

        $consulta = $conexion->query("SELECT id FROM municipios WHERE provincia = '".$province_id."' AND municipio LIKE '%".$town_name."%'");

        if (!$consulta->num_rows) {
            return false;
        } else {
            $fila = $consulta->fetch_assoc();

            return $fila['id'];
        }
    }

    function get_province($id) {
        $bd = bd_gest::get_instance();
        $conexion = $bd->get_connection();

        $consulta = $conexion->query("SELECT provincia FROM provincias WHERE id = '".$id."'");

        if (!$consulta->num_rows) {
            return false;
        } else {
            $fila = $consulta->fetch_assoc();

            return $fila['provincia'];
        }
    }

    function get_town($province_id, $town_id) {
        $bd = bd_gest::get_instance();
        $conexion = $bd->get_connection();

        $consulta = $conexion->query("SELECT municipio FROM municipios WHERE id = '".$town_id."' AND provincia = '".$province_id."'");

        if (!$consulta->num_rows) {
            return false;
        } else {
            $fila = $consulta->fetch_assoc();

            return $fila['municipio'];
        }
    }