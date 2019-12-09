<?php
require_once __DIR__ . '/../models/Tarea.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../models/consultas_comunes.php';
require_once __DIR__ . '/../models/utils.php';

$errores = [
    "descripcion" => null,
    "poblacion" => null,
    "cp" => null,
    "provincia" => null,
    "persona_contacto" => null,
    "fecha_realizacion" => null
];

$campos_insertados = [
    "descripcion" => null,
    "poblacion" => null,
    "cp" => null,
    "provincia" => null,
    "persona_contacto" => null,
    "estado" => null,
    "persona_encargada" => null,
    "fecha_realizacion" => null,
    "anotacion_anterior" => null,
    "anotacion_posterior" => null
];

try {
    $usuarios = obtain_all_users();
} catch (Exception $e) {
    echo $e->getMessage();
}

/**
 * Valido los datos insertados según las especificaciones de la tarea.
 *
 * @return bool
 */
function valida_datos() {
    $estado = true;

    // DESCRIPCION
    if (empty(vp('descripcion'))) {
        $GLOBALS['errores']['descripcion'] = "No se ha insertado ninguna descripción.";
        $estado = false;
    }

    // POBLACIÓN
    if (empty(vp('poblacion'))) {
        $GLOBALS['errores']['poblacion'] = "No se ha insertado ninguna población.";
        $estado = false;
    }

    // CP
    if (empty(vp('cp'))) {
        $GLOBALS['errores']['cp'] = "No se ha insertado ningún código postal." ;
        $estado = false;
    } else if (strlen(vp('cp')) < 5) {
        $GLOBALS['errores']['cp'] = "El código postal insertado es inválido.";
        $estado = false;
    }

    // Provincia
    if (empty(vp('provincia'))) {
        $GLOBALS['errores']['provincia'] = "No se ha seleccionado provincia.";
        $estado = false;
    }

    if (empty(vp('persona_contacto'))) {
        $GLOBALS['errores']['persona_contacto'] = "No se ha seleccionado ninguna persona de contacto.";
        $estado = false;
    }

    // Fecha realización
    if (empty(vp('fecha_realizacion'))) {
        $GLOBALS['errores']['fecha_realizacion'] = "No se ha insertado fecha de realización.";
        $estado = false;
    } else if (!preg_match("/[0-9]{2}\W[0-9]{2}\W[0-9]{4}/", vp('fecha_realizacion'))) {
        $GLOBALS['errores']['fecha_realizacion'] = "La estructura de la fecha es incorrecta.";
        $estado = false;
    } else if (!valida_fecha(vp('fecha_realizacion'))) {
        $GLOBALS['errores']['fecha_realizacion'] = "La fecha insertada es inválida.";
        $estado = false;
    }  else if (strtotime(vp('fecha_realizacion')) < strtotime(date('d-m-Y'))) {
        $GLOBALS['errores']['fecha_realizacion'] = "La fecha establecida es anterior a la fecha actual.";
        $estado = false;
    }

    return $estado;
}

function valida_fecha($fecha, $formato = 'd-m-Y') {
    $d = DateTime::createFromFormat($formato, $fecha);
    return $d && $d->format($formato) == $fecha;
}