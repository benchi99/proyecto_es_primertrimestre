<?php
require_once __DIR__ . '/iDBTemplate.php';
require_once __DIR__ . '/bd_gest.php';

class Tarea implements iDBTemplate
{
    public $id;
    public $descripcion;
    public $poblacion;
    public $codigo_postal;
    public $provincia;
    public $persona_contacto;
    public $estado;
    public $fecha_creacion;
    public $persona_encargada;
    public $fecha_realizacion;
    public $anotacion_anterior;
    public $anotacion_posterior;

    public function __construct($data)
    {
        if (!$this->__vienen_todos_los_datos($data) && isset($data['id'])) {
            $this->__construye_desde_id($data['id']);
        } else if ($this->__vienen_todos_los_datos($data)) {
            $this->__construye_todos_params($data);
        } else {
            throw new Exception('Objeto "Tarea" no se ha podido construir');
        }
    }

    private function __construye_todos_params($data)
    {
        if (isset($data['id'])) {
            $this->id = intval($data['id']);
        }
        $this->descripcion = $data['descripcion'];
        $this->poblacion = $data['poblacion'];
        $this->codigo_postal = $data['codigo_postal'];
        $this->provincia = $data['provincia'];
        $this->persona_contacto = $data['persona_contacto'];
        $this->estado = $data['estado'];
        $this->fecha_creacion = $data['fecha_creacion'];
        $this->persona_encargada = $data['persona_encargada'];
        $this->fecha_realizacion = $data['fecha_realizacion'];
        $this->anotacion_anterior = $data['anotacion_anterior'];
        $this->anotacion_posterior = $data['anotacion_posterior'];
    }

    private function __construye_desde_id($id)
    {
        $this->id = intval($id);

        $bd = bd_gest::get_instance();
        $conexion = $bd->get_connection();

        $consulta = $conexion->query("SELECT * FROM pryt1_tarea WHERE tsk_id = '" . $id . "'");

        if (!$consulta) {
            throw new Exception("Hubo un error al construir tarea desde base de datos: ".$conexion->error);
        } else {
            while ($fila = $consulta->fetch_assoc()) {
                $this->descripcion = $fila['tsk_descripcion'];
                $this->poblacion = $fila['tsk_poblacion'];
                $this->codigo_postal = $fila['tsk_cp'];
                $this->provincia = $fila['tsk_provincia'];
                $this->persona_contacto = $fila['tsk_persona_contacto'];
                $this->estado = $fila['tsk_estado'];
                $this->fecha_creacion = DateTime::createFromFormat('Y-m-d', $fila['tsk_fecha_creacion'])->format('d-m-Y');
                $this->persona_encargada = $fila['tsk_persona_encargada'];
                $this->fecha_realizacion = DateTime::createFromFormat('Y-m-d', $fila['tsk_fecha_realizacion'])->format('d-m-Y');
                $this->anotacion_anterior = $fila['tsk_anotacion_anterior'];
                $this->anotacion_posterior = $fila['tsk_anotacion_posterior'];
            }
        }
    }

    private function __vienen_todos_los_datos($data)
    {
        return isset($data['descripcion']) &&
            isset($data['poblacion']) &&
            isset($data['codigo_postal']) &&
            isset($data['provincia']) &&
            isset($data['persona_contacto']) &&
            isset($data['estado']) &&
            isset($data['fecha_creacion']) &&
            isset($data['persona_encargada']) &&
            isset($data['fecha_realizacion']) &&
            isset($data['anotacion_anterior']) &&
            isset($data['anotacion_posterior']);
    }

    public function commit_to_database()
    {
        $bd = bd_gest::get_instance();
        $conexion = $bd->get_connection();

        if (!$this->id) {
            // Vamos a insertar
            $resultado = $conexion->query("INSERT INTO pryt1_tarea VALUES (
                    null,
                    '" . $this->descripcion . "',
                    '" . $this->poblacion . "',
                    '" . $this->codigo_postal . "',
                    '" . $this->provincia . "',
                    '" . $this->persona_contacto . "',
                    '" . $this->estado . "',
                    '" . $this->fecha_creacion . "',
                    '" . $this->persona_encargada . "',
                    '" . $this->fecha_realizacion . "', 
                    '" . $this->anotacion_anterior . "',
                    '" . $this->anotacion_posterior . "')"
            );

            return $resultado;
        } else {
            // Vamos a actualizar.
            $resultado = $conexion->query("SELECT * FROM pryt1_tarea WHERE tsk_id = " . $this->id);

            if ($resultado->num_rows === 1) {
                $resultado = $conexion->query('UPDATE pryt1_tarea SET 
                       tsk_descripcion = \'' . $this->descripcion . '\', 
                       tsk_poblacion = \'' . $this->poblacion . '\', 
                       tsk_cp = ' . $this->codigo_postal . ', 
                       tsk_provincia = \'' . $this->provincia . '\', 
                       tsk_persona_contacto = ' . $this->persona_contacto . ', 
                       tsk_estado = ' . $this->estado . ', 
                       tsk_persona_encargada = ' . $this->persona_encargada . ', 
                       tsk_fecha_realizacion = \'' . $this->fecha_realizacion . '\', 
                       tsk_anotacion_anterior = \'' . $this->anotacion_anterior . '\', 
                       tsk_anotacion_posterior = \'' . $this->anotacion_posterior . '\' 
                   WHERE tsk_id = ' . $this->id);

                if (!$resultado) {
                    throw new Exception("There was an error updating your data:" . $conexion->error . " (" . $conexion->errno . ")");
                }

                return $resultado;
            } else {
                throw new Exception("There has been an error updating this task: task id '" . $this->id . "'' does not exist in DB.");
            }
        }
    }

    public function delete()
    {
        $bd = bd_gest::get_instance();
        $conexion = $bd->get_connection();

        $resultado = $conexion->query("DELETE FROM pryt1_tarea WHERE tsk_id = " . $this->id);

        return $resultado;
    }

    public function complete_task() {
        $bd = bd_gest::get_instance();
        $conexion = $bd->get_connection();

        $resultado = $conexion->query("SELECT * FROM pryt1_tarea WHERE tsk_id = " . $this->id);
        if ($resultado->num_rows === 1) {
            $resultado_completar = $conexion->query('UPDATE pryt1_tarea SET tsk_estado = 1 WHERE tsk_id = '.$this->id);

            return $resultado_completar;
        } else {
            return $resultado;
        }
    }
}