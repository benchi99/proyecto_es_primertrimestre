<?php
require_once __DIR__ . '/../models/Tarea.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../models/consultas_comunes.php';
require_once __DIR__ . '/../models/utils.php';

$errores = [
  'nombre_usuario' => null
];

$campos_insertados = [
    'nombre_usuario' => null
];