<?php
require_once __DIR__.'/iDBTemplate.php';
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

    private function __construye_todos_params($data) {
        $this->id = $data['id'];
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

    private function __construye_desde_id($id) {
        $this->id = $id;

        $bd = bd_gest::get_instance();
        $conexion = $bd->get_connection();

        $consulta = $conexion->query("SELECT * FROM pryt1_tarea WHERE tsk_id = '".$id."'");
        if (!$consulta) {
            echo "Error lol";
        } else {
            while ($fila = $consulta->fetch_assoc()) {
                $this->descripcion = $fila['tsk_descripcion'];
                $this->poblacion = $fila['tsk_poblacion'];
                $this->codigo_postal = $fila['tsk_cp'];
                $this->provincia = $fila['tsk_provincia'];
                $this->persona_contacto = $fila['tsk_persona_contacto'];
                $this->estado = $fila['tsk_estado'];
                $this->fecha_creacion = $fila['tsk_fecha_creacion'];
                $this->persona_encargada = $fila['tsk_persona_encargada'];
                $this->fecha_realizacion = $fila['tsk_fecha_realizacion'];
                $this->anotacion_anterior = $fila['tsk_anotacion_anterior'];
                $this->anotacion_posterior = $fila['tsk_anotacion_posterior'];
            }
        }
    }

    private function __vienen_todos_los_datos($data) {
        return isset($data['id']) &&
            isset($data['descripcion']) &&
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

    public function es_valido()
    {
        // TODO: Implement es_valido() method.
    }

    public function commit_to_database()
    {
        // TODO: Implement commit_to_database() method.
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }
}