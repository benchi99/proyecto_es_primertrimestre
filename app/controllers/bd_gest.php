<?php

// TODO: tirar a la basura toda esta clase, que le den
class BD
{
    private $bd = null;

    public function __construct($host, $usuario, $contra, $esquema)
    {
        $bd = new mysqli($host, $usuario, $contra, $esquema);

        if ($bd->connect_errno) {
            echo '<p style="color: red;">Fallo al intentar conectar a MySQL: ('.$bd->connect_errno.') '.$bd->connect_error.'</p>';
            unset($this);
        }
    }

    public function consulta($columnas, $tabla, $condiciones, $ordenacion, $limite, $agrupa)
    {
        if (!$this->bd) {
            echo '<p style="color: red;">No hay conexión a Base de Datos</p>';
        } else {
            $sentencia = $this->bd->prepare("SELECT ? FROM ? WHERE ?");
        }
    }



}
