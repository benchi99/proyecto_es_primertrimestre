<?php
require_once __DIR__.'/iDBTemplate.php';
require_once __DIR__.'/../controllers/bd_gest.php';

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

    public function __construct($data)
    {
        if (!$this->__vienen_todos_los_datos($data) && isset($data['id'])) {
            $this->__construye_desde_id($data['id']);
        } else if ($this->__vienen_todos_los_datos($data)) {
            $this->__construye_todos_params($data);
        } else {
            throw new Exception('Objeto "Usuario" no se ha podido construir');
        }

    }
    
    private function __construye_todos_params($data)
    {
        $this->id = $data['id'];
        $this->nombre_usuario = $data['nombre_usuario'];
        $this->nombre = $data['nombre'];
        $this->apellidos = $data['apellidos'];
        $this->telefono = $data['telefono'];
        $this->email = $data['email'];
        $this->direccion = $data['direccion'];
        $this->rol = $data['rol'];
    }

    private function __construye_desde_id($id)
    {
        $this->id = $id;

        $bd = bd_gest::get_instance();
        $conexion = $bd->get_connection();
        $consulta = $conexion->query("SELECT * FROM pryt1_usuarios WHERE usr_id = '.$id.'");

        if (!$consulta) {
            echo "Error lol";
        } else {
            while ($fila = $consulta->fetch_assoc()) {
                $this->nombre_usuario = $fila['usr_nombreusu'];
                $this->nombre = $fila['usr_nombre'];
                $this->apellidos = $fila['usr_apellidos'];
                $this->telefono = $fila['usr_tlf'];
                $this->email = $fila['usr_email'];
                $this->direccion = $fila['usr_direccion'];
                $this->rol = $fila['usr_rol'];
            }
        }

    }

    public function get_full_name()
    {
        return $this->nombre . ' ' . $this->apellidos;
    }

    public function get_user_tasks()
    {
        $bd = bd_gest::get_instance();
        $conexion = $bd->get_connection();
        $result = [];

        $ids = $conexion->query("SELECT tsk_id FROM pryt1_tarea 
                                      WHERE tsk_persona_encargada = " . $this->id);

        while ($fila = $ids->fetch_assoc()) {
            array_push($result, new Tarea($ids['tsk_id']));
        }

        return $result;
    }

    public function commit_to_database()
    {
        // TODO: Insertar a base de datos.
    }

    public function es_valido()
    {
        // TODO: Validar si datos son válidos.
    }

    private function __vienen_todos_los_datos($data)
    {
        return isset($data['id']) &&
            isset($data['nombre_usuario']) &&
            isset($data['nombre']) &&
            isset($data['apellidos']) &&
            isset($data['telefono']) &&
            isset($data['email']) &&
            isset($data['direccion']) &&
            isset($data['rol']);
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }
}