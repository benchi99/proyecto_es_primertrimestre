<?php

// DATOS DE BASE DE DATOS
# Datos acceso
define("USUARIO", "root");
define("CONTRA", "");
define("ESQUEMA", "proyecto_1trimestre");

# Definición roles
define("ROL_NOUSU", -1);
define("ROL_OPERARIO", 0);
define("ROL_ADMIN", 1);

# Define URL !!!!!! CAMBIAR ESTO A TU RUTA ABSOLUTA EN TU SERVIDOR !!!!!!
define("URL", "http://localhost/ES/proyecto_es_primertrimestre/");

// CONFIGURACIÓN BLADEONE
// TODO: probar y puede que sustituir BladeOne por Jessengers' Blade. https://github.com/jenssegers/blade
// TODO: Instalar Composer e inicializar Composer en el proyecto.
include __DIR__.'\..\lib\BladeOne.php';
use eftec\bladeone\BladeOne;

$blade = new BladeOne(__DIR__.'\views',
    __DIR__.'\views\compiled',
    BladeOne::MODE_DEBUG); // CAMBIAR A PROD AL ENTREGAR!!!!!

// TODO: Cambiar a URL del servidor a desplegar.
$blade->setBaseUrl(URL);
