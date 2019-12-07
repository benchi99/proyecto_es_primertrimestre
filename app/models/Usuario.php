<?php
require_once __DIR__.'/iDBTemplate.php';
require_once __DIR__ . '/bd_gest.php';

class Usuario implements iDBTemplate
{
    public $id;
    public $nombre_usuario;
    public $pass;
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
        if (isset($data['id'])) {
            $this->id = $data['id'];
        }
        $this->nombre_usuario = $data['nombre_usuario'];
        $this->pass = $data['pass'];
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
        $consulta = $conexion->query('SELECT * FROM pryt1_usuarios WHERE usr_id = '.$id);

        if (!$consulta) {
            throw new Exception("Hubo un error al construir usuario desde base de datos: ".$conexion->error);
        } else {
            while ($fila = $consulta->fetch_assoc()) {
                $this->nombre_usuario = $fila['usr_nombreusu'];
                $this->pass = $fila['usr_password'];
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

    private function __vienen_todos_los_datos($data)
    {
        return isset($data['nombre_usuario']) &&
            isset($data['nombre']) &&
            isset($data['pass']) &&
            isset($data['apellidos']) &&
            isset($data['telefono']) &&
            isset($data['email']) &&
            isset($data['direccion']) &&
            isset($data['rol']);
    }

    public function commit_to_database()
    {
        $bd = bd_gest::get_instance();
        $conexion = $bd->get_connection();

        if (!$this->id) {
            // Vamos a insertar
            $resultado = $conexion->query("INSERT INTO pryt1_usuarios VALUES (
                    null,
                    '" . $this->nombre_usuario . "',
                    '" . password_hash($this->pass, PASSWORD_DEFAULT) . "',
                    '" . $this->nombre . "',
                    '" . $this->apellidos . "',
                    '" . $this->telefono . "',
                    '" . $this->email . "',
                    '" . $this->direccion . "',
                    '" . $this->rol . "')"
            );

            return $resultado;
        } else {
            // Vamos a actualizar.
            $resultado = $conexion->query("SELECT * FROM pryt1_usuarios WHERE usr_id = " . $this->id);

            if ($resultado->num_rows === 1) {
                $resultado = $conexion->query('UPDATE pryt1_usuarios SET 
                       usr_nombreusu = \'' . $this->nombre_usuario . '\', 
                       usr_password = \'' . $this->pass . '\', 
                       usr_nombre = ' . $this->nombre . ', 
                       usr_apellidos = \'' . $this->apellidos . '\', 
                       usr_tlf = ' . $this->telefono . ', 
                       usr_email = ' . $this->email . ', 
                       usr_direccion = ' . $this->direccion . ', 
                       usr_rol = \'' . $this->rol . '\', 
                   WHERE usr_id = ' . $this->id);

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

        $resultado = $conexion->query("DELETE FROM pryt1_usuarios WHERE usr_id = " . $this->id);

        return $resultado;
    }
}