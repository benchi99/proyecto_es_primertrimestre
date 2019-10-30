<?php

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

    /**
     *  Ejecuta una consulta en la base de datos.
     *
     * @param $sql string Consulta SQL
     * @return bool|mysqli_result Resultado de la consulta, o falso si ha devuelto error.
     */
    public static function ejecuta_sql($sql)
    {
        $resultado_consulta = self::$base_datos->query($sql);

        if (!$resultado_consulta) {
            return false;
        } else {
            return $resultado_consulta;
        }
    }

    /**
     *  Obtiene la instancia de base de datos.
     * @return bd_gest|mysqli
     */
    public static function get_instance()
    {
        if (self::$base_datos == null) {
            self::$base_datos = new bd_gest();
        }

        return self::$base_datos;
    }

    /**
     * Cierra la conexión actual.
     */
    public function cierra_conexion() {
        self::$base_datos->close();
    }
}