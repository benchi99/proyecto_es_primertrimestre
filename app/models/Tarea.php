<?php
require __DIR__.'/../controllers/bd_gest.php';

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

    public function __construct($id, $descripcion, $poblacion, $codigo_postal, $provincia, $persona_contacto, $estado, $fecha_creacion, $persona_encargada, $fecha_realizacion, $anotacion_anterior, $anotacion_posterior)
    {
        $this->id = $id;
        $this->descripcion = $descripcion;
        $this->poblacion = $poblacion;
        $this->codigo_postal = $codigo_postal;
        $this->provincia = $provincia;
        $this->persona_contacto = $persona_contacto;
        $this->estado = $estado;
        $this->fecha_creacion = $fecha_creacion;
        $this->persona_encargada = $persona_encargada;
        $this->fecha_realizacion = $fecha_realizacion;
        $this->anotacion_anterior = $anotacion_anterior;
        $this->anotacion_posterior = $anotacion_posterior;
    }

    public function __construct1($id) {
        $this->id = $id;

        $bd = bd_gest::get_instance();

        $consulta = $bd->ejecuta_sql("SELECT * FROM ".TABLA_TAREAS." WHERE tsk_id = '".$id."'");
        if (!$consulta) {
            echo "Error lol";
        } else {
            $datos_usuario = $consulta->fetch_assoc()[0];

            $this->descripcion = $datos_usuario['tsk_descripcion'];
            $this->poblacion = $datos_usuario['tsk_poblacion'];
            $this->codigo_postal = $datos_usuario['tsk_cp'];
            $this->provincia = $datos_usuario['tsk_provincia'];
            $this->persona_contacto = $datos_usuario['tsk_persona_contacto'];
            $this->estado = $datos_usuario['tsk_estado'];
            $this->fecha_creacion = $datos_usuario['tsk_fecha_creacion'];
            $this->persona_encargada = $datos_usuario['tsk_persona_encargada'];
            $this->fecha_realizacion = $datos_usuario['tsk_fecha_realizacion'];
            $this->anotacion_anterior = $datos_usuario['tsk_anotacion_anterior'];
            $this->anotacion_posterior = $datos_usuario['tsk_anotacion_posterior'];
        }
    }

    public function es_valido()
    {
        // TODO: Implement es_valido() method.
    }

    public function commit_to_database()
    {
        // TODO: Implement commit_to_database() method.
    }
}