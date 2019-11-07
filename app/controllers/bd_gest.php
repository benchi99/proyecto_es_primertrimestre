<?php
/**
 * Class bd_gest
 * PATRÓN SINGLETON - Solo quiero una instancia de conexión a BD.
 */

class bd_gest
{
    private $_connection;
    private static $_instance; // La instancia única.
    private $_host = "localhost";
    private $_username = USUARIO;
    private $_password = CONTRA;
    private $_database = ESQUEMA;

    /**
     * Devuelve una instancia de base de datos.
     *n
     * @return bd_gest
     */
    public static function get_instance()
    {
        if (!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    // Constructor
    private function __construct()
    {
        $this->_connection = new mysqli($this->_host, $this->_username,
            $this->_password, $this->_database);

        // Si falla la conexión
        if ($this->_connection->connect_error) {
            echo '<p style="color: red">Hubo un error al conectar a base de datos: '.$this->_connection->connect_error.'
                ('.$this->_connection->connect_errno.')</p>';
        }
    }

    // Este método está vacío para evitar duplicar este objeto.
    private function __clone()
    {
    }

    /**
     * Devuelve la conexión de base de datos.
     * @return mysqli
     */
    public function get_connection()
    {
        return $this->_connection;
    }
}

?>