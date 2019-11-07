<?php

// DATOS DE BASE DE DATOS
# Datos acceso

define("USUARIO", "root");
define("CONTRA", "");
define("ESQUEMA", "proyecto_1trimestre");

# Nombre de Tablas
define("TABLA_USUARIOS", "pryt1_usuarios");
define("TABLA_TAREAS", "pryt1_tarea");

// CONFIGURACIÓN BLADEONE
include __DIR__.'\..\lib\BladeOne.php';
use eftec\bladeone\BladeOne;

$blade = new BladeOne(__DIR__.'\views\templates',
    __DIR__.'\views\templates\compiled',
    BladeOne::MODE_DEBUG); // CAMBIAR A PROD AL ENTREGAR!!!!!

// TODO: Cambiar a URL del servidor a desplegar.
$blade->setBaseUrl("http://localhost/ES/proyecto_es_primertrimestre/app/");
// Escribir esto a la hora de invocar una vista.
// echo $blade->run("Test.hello", []);