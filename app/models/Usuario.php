<?php


class Usuario
{
    public $id;
    public $nombre_usuario;
    public $nombre;
    public $apellidos;
    public $telefono;
    public $email;
    public $direccion;
    public $poblacion;
    public $codigo_postal;
    public $provincia;
    public $rol;

    public function __construct($id, $nombre_usuario, $nombre, $apellidos, $telefono, $email, $direccion, $poblacion, $codigo_postal, $provincia, $rol)
    {
        $this->id = $id;
        $this->nombre_usuario = $nombre_usuario;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->direccion = $direccion;
        $this->poblacion = $poblacion;
        $this->codigo_postal = $codigo_postal;
        $this->provincia = $provincia;
        $this->rol = $rol;
    }

    public function __construct1($id) {
        $this->id = $id;
        // TODO: OBTENER DATOS DE BD.
    }

    public function getFullName() {
        return $this->nombre.' '.$this->apellidos;
    }
}