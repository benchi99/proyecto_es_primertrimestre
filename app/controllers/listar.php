<?php
// TODO: añadir bien los usuarios cuando toque por dios tengo que repasar putas sesiones y mierdas de esa hostiaAAAAAAAA
    require_once __DIR__.'/../config.php';
    require_once __DIR__.'/../models/utils.php';
    require_once __DIR__.'/../models/consultas_comunes.php';

    $querystr = "";

    if (vg('querystr')) {
        $querystr = vg('querystr');
        $tareas = get_tasks($querystr);
    } else if ($_POST) {
        $filtros_a_buscar = todos_vp();

        $tareas = get_task_fitered_by($filtros_a_buscar);
    } else {
        $tareas = obtain_all_tasks();
    }
    $usuarios = obtain_all_users();

    $limite = 4;
    $num_tareas = count($tareas);
    $total_pgs = intval(ceil($num_tareas/$limite));
    $pagina_actual = get_current_page();

    $limite_comienzo = ($pagina_actual-1) * $limite;

    try {
        echo $blade->run("Tareas.listar_tareas", [
            "tareas" => $tareas,
            "usuarios" => $usuarios,
            "limite" => $limite,
            "limite_comienzo" => $limite_comienzo,
            "num_tareas" => $num_tareas,
            "total_pgs" => $total_pgs,
            "pagina_actual" => $pagina_actual,
            "querystr" => $querystr
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