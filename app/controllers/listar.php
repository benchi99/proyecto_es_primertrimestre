<?php
// TODO: añadir bien los usuarios cuando toque por dios tengo que repasar putas sesiones y mierdas de esa hostiaAAAAAAAA
    require_once __DIR__ . '/consultas_comunes.php';

    $tareas = obtain_all_tasks();
    $usuarios = obtain_all_users();

    try {
        echo $blade->run("Tareas.listar_tareas", ["tareas" => $tareas,
                                                        "usuarios" => $usuarios]);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
?>