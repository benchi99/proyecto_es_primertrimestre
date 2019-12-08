<?php
require_once __DIR__ . '/bd_gest.php';
require_once __DIR__ . '/../config.php';

if (!$_GET) {
    echo "No viene nada por GET!";
} else {
    if (isset($_GET['querytype'])) {
        switch ($_GET['querytype']) {
            case "all":
                $datos = [];

                $usuarios = consulta_tabla("usuarios", null);
                $provincias = consulta_tabla("provincia", null);

                if (isset($usuarios['errorno']) || isset($provincias['errorno'])) {
                    $error = isset($usuarios['errorno']) ? $usuarios : $provincias;

                    echo json_encode($error);
                } else {
                    $datos[] = $usuarios;
                    $datos[] = $provincias;

                    $construccion_final = json_encode($datos);

                    echo $construccion_final;
                }
                break;
            case "municipios":
                if (isset($_GET['provincia'])) {
                    $municipios = consulta_tabla("municipio", $_GET['provincia']);
                    echo json_encode($municipios);
                } else {
                    return "No se ha especificado provincia!";
                }
                break;
            default:
                echo "No viene nada por GET!";
                break;
        }
    }
}

/**
 * Consulta una tabla especificada y devuelve el resultado en json.
 *
 * @param $tabla
 * @param $provincia
 * @return array|bool
 */
function consulta_tabla($tabla, $provincia)
{
    $datos = [];
    $bd = bd_gest::get_instance();
    $conexion = $bd->get_connection();

    switch ($tabla) {
        case "usuarios":
            $sql = "SELECT usr_id, usr_nombre, usr_apellidos FROM pryt1_usuarios";
            break;
        case "provincia":
            $sql = "SELECT id, provincia FROM provincias";
            break;
        case "municipio":
            $sql = "SELECT id, municipio FROM municipios WHERE provincia = " . $provincia;
            break;
        default:
            return false;
    }

    $consulta = $conexion->query($sql);

    if (!$consulta) {
        return ['errorno' => $conexion->errno, 'error' => $conexion->error];
    } else {
        foreach ($consulta->fetch_all(MYSQLI_ASSOC) as $fila) {
            $obj = [];
            foreach ($fila as $col => $value) {
                if (!is_numeric($value))
                    $obj[$col] = utf8_encode($value);
                else
                    $obj[$col] = $value;

            }
            $obj_json = json_encode($obj);
            array_push($datos, $obj_json);
        }
        return $datos;
    }
}

?>

