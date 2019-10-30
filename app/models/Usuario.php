<?php
require __DIR__.'/../controllers/bd_gest.php';

class Usuario implements iDBTemplate
{
    public $id;
    public $nombre_usuario;
    public $nombre;
    public $apellidos;
    public $telefono;
    public $email;
    public $direccion;
    public $rol;

    public function __construct($id, $nombre_usuario, $nombre, $apellidos, $telefono, $email, $direccion, $rol)
    {
        $this->id = $id;
        $this->nombre_usuario = $nombre_usuario;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->direccion = $direccion;
        $this->rol = $rol;
    }

    public function __construct1($id) {
        $this->id = $id;
        $bd = bd_gest::get_instance();

        $consulta = $bd->ejecuta_sql("SELECT * FROM ".TABLA_USUARIOS." WHERE usr_id = '.$id.'");

        if (!$consulta) {
            echo "Error lol";
        } else {
            $datos_usuario = $consulta->fetch_assoc()[0];

            $this->nombre_usuario = $datos_usuario['usr_nombreusu'];
            $this->nombre = $datos_usuario['usr_nombre'];
            $this->apellidos = $datos_usuario['usr_apellidos'];
            $this->telefono = $datos_usuario['usr_tlf'];
            $this->email = $datos_usuario['usr_email'];
            $this->direccion = $datos_usuario['usr_direccion'];
            $this->rol = $datos_usuario['usr_rol'];
        }
    }

    public function get_full_name() {
        return $this->nombre.' '.$this->apellidos;
    }

    public function get_user_tasks() {
        $bd = bd_gest::get_instance();
        $result = [];

        $ids = $bd->ejecuta_sql("SELECT tsk_id FROM ".TABLA_TAREAS." 
                                      WHERE tsk_persona_encargada = ".$this->id);

        while ($fila = $ids->fetch_assoc()) {
            $result[] += new Tarea($ids['tsk_id']);
        }

        return $result;
    }

    public function commit_to_database() {
        // TODO: Insertar a base de datos.
    }

    public function es_valido() {
        // TODO: Validar si datos son válidos.
    }
}