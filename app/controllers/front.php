<?php
require_once __DIR__.'/../models/utils.php';

// constantes que definen que hacer
define('ACTION', 'a');

// constantes que definen que cargar
define('L', '0');
define('FT', '1');
define('FU', '2');

$mapa_vistas = [
    L => 'listar',
    FT => 'f_tarea',
    FU => 'f_usuario'
    // ...
];

if (vg(ACTION)) {
    $vista_a_cargar = vg(ACTION);
    if (isset($mapa_vistas[$vista_a_cargar]) && file_exists(__DIR__.'/../controllers/'.$mapa_vistas[$vista_a_cargar].'.php')) {
        include __DIR__.'/'.$mapa_vistas[$vista_a_cargar].'.php';
    } else {
        // TODO: jaja no funciona por alguna razón arreglar en algun momento 😂👌😂👌😂👌😂👌😂👌😂👌😂👌😂👌😂👌😂👌😂👌😂👌😂👌😂👌😂👌😂👌😂👌😂👌😂👌😂👌😂👌😂👌😂👌😂👌😂👌😂👌😂👌😂👌😂👌😂👌😂👌😂👌😂👌😂👌
        try {
            $blade->run('Error.error', ['error' => 'La página solicitada no existe.']);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
} else if (!vg(ACTION)) {
    include __DIR__.'/'.$mapa_vistas[L].'.php';
}