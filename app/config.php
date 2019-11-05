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

$blade = new BladeOne(null, null, BladeOne::MODE_DEBUG);

echo $blade->run("Test.hello", []);