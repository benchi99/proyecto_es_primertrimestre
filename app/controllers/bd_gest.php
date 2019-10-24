<?php

class BD
{
    private $bd;

    public function __construct($host, $usuario, $contra, $esquema)
    {
        $bd = new mysqli($host, $usuario, $contra, $esquema);

        if ($bd->connect_errno) {
            echo '<p style="color: red;">Fallo al intentar conectar a MySQL: ('.$bd->connect_errno.') '.$bd->connect_error.'</p>';
            unset($this);
        }
    }



}
