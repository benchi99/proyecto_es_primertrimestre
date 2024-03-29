<?php
require_once __DIR__.'/../models/utils.php';

// constantes que definen que hacer
define('ACTION', 'a');

// constantes que definen que cargar
define('LT', '0');
define('IT', '1');
define('ET', '2');
define('DT', '3');
define('CT', '4');
//define('FU', '5');
define('IU', '5');
define('EU', '6');
define('DU', '7');
define('EA', '8');
define('LG', '9');
define('CS', '10');
define('LU', '11');

$mapa_controladores = [
    LT => 'listar_tarea',
    IT => 'insertar_tarea',
    ET => 'editar_tarea',
    DT => 'eliminar_tarea',
    CT => 'completar_tarea',
//    FU => 'f_usuario',
    IU => 'insertar_usuario',
    EU => 'editar_usuario',
    DU => 'eliminar_usuario',
    EA => 'editar_cuenta',
    LG => 'login',
    CS => 'cerrar_sesion',
    LU => 'listar_usuario'
    // ...
];

if (vg(ACTION)) {
    $vista_a_cargar = vg(ACTION);
    if (isset($mapa_controladores[$vista_a_cargar]) && file_exists(__DIR__.'/../controllers/'.$mapa_controladores[$vista_a_cargar].'.php')) {
        include __DIR__.'/../controllers/'.$mapa_controladores[$vista_a_cargar].'.php';
    } else {
        try {
            echo $blade->run('Error.error', [
                'error' => 'La página solicitada no existe.',
                'sesion_iniciada' => isset($_SESSION) ? true : false,
                'usuario' => isset($_SESSION['usuario']) ? $_SESSION['usuario'] : null,
            ]);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
} else if (!vg(ACTION)) {
    include __DIR__.'/../controllers/'.$mapa_controladores[LT].'.php';
}