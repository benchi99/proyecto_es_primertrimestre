<?php
// TODO: añadir bien los usuarios cuando toque por dios tengo que repasar putas sesiones y mierdas de esa hostiaAAAAAAAA
    require __DIR__.'\..\controllers\consultas_comunes.php';

    $tareas = obtain_all_tasks();

    try {
        echo $blade->run("Tareas.listar_tareas", ["tareas" => $tareas]);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
?>