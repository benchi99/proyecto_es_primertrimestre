<?php
require '../config.php';


class bd_gest {
    // TODO: Echar un vistazo a PDO.

    private static $base_datos;

    private function __construct()
    {
        self::$base_datos = new mysqli("localhost", USUARIO, CONTRA, ESQUEMA);

        if (!self::$base_datos->connect_errno) {
            echo '<p style="color: red"> Falló la conexión a la base de datos: ('.
                self::$base_datos->connect_errno.') '.self::$base_datos->connect_error.'.</p>';
        }
    }

    public static function ejecuta_sql($sql)
    {
        $resultado_consulta = self::$base_datos->query($sql);

        if (!$resultado_consulta) {
            return false;
        } else {
            return $resultado_consulta;
        }
    }

    public static function get_instance()
    {
        if (self::$base_datos == null) {
            self::$base_datos = new bd_gest();
        }

        return self::$base_datos;
    }

    public function cierra_conexion() {
        self::$base_datos->close();
    }
}