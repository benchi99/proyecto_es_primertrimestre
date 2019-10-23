<?php


class Tarea
{
    public $id;
    public $descripcion;
    public $persona_contacto;
    public $estado;
    public $fecha_creacion;
    public $persona_encargada;
    public $fecha_realizacion;
    public $anotacion_anterior;
    public $anotacion_posterior;

    public function __construct($id, $descripcion, $persona_contacto, $estado, $fecha_creacion, $persona_encargada, $fecha_realizacion, $anotacion_anterior, $anotacion_posterior)
    {
        $this->id = $id;
        $this->descripcion = $descripcion;
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
        // TODO: OBTENER DATOS DE BD
    }
}