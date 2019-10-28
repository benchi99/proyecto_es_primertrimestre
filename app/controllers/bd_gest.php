<?php
require '../config.php';

class bd_gest {

    // TODO: Echar un vistazo a PDO.

    private $base_datos;

    public function __construct()
    {
        $this->base_datos = new mysqli("localhost", USUARIO, CONTRA, ESQUEMA);

        if (!$this->base_datos->connect_errno) {
            echo '<p style="color: red"> Falló la conexión a la base de datos: ('.
                $this->base_datos->connect_errno.') '.$this->base_datos->connect_error.'.</p>';
        }
    }

    public function ejecuta_sql($sql)
    {
        $resultado_consulta = $this->base_datos->query($sql);

        if (!$resultado_consulta) {
            return false;
        } else {
            return $resultado_consulta;
        }
    }
}