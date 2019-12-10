<?php
    require_once __DIR__.'/../config.php';
    require_once __DIR__.'/../models/utils.php';
    require_once __DIR__.'/../models/consultas_comunes.php';

    $rol_requerido = ROL_ADMIN;

    include __DIR__.'/validacion_usuarios.php';

    $querystr = "";

    if (vg('querystr')) {
        $querystr = vg('querystr');
        $usuarios = get_users($querystr);
    } else {
        $usuarios = obtain_all_users();
    }

    $limite = 4;
    $num_usuarios = count($usuarios);
    $total_pgs = intval(ceil($num_usuarios/$limite));
    $pagina_actual = get_current_page();

    $limite_comienzo = ($pagina_actual-1) * $limite;

    try {
        echo $blade->run("Usuarios.listar_usuarios", [
            "usuarios" => $usuarios,
            "limite" => $limite,
            "limite_comienzo" => $limite_comienzo,
            "num_usuarios" => $num_usuarios,
            "total_pgs" => $total_pgs,
            "pagina_actual" => $pagina_actual,
            "querystr" => $querystr,
            'sesion_iniciada' => $sesion_iniciada,
            'usuario' => $nombre_usuario,
            'rol_actual' => intval($_SESSION['rol'])
        ]);
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    function get_current_page() {
        if (!vg('page')) {
            return 1;
        } else {
            return vg('page');
        }
    }
?>