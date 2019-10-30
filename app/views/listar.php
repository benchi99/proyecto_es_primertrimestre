<!doctype html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Garden</title>
    </head>
    <?php
        require '../controllers/bd_gest.php';
        require '../config.php';

        $bd = bd_gest::get_instance();

        $consulta_lista = $bd->ejecuta_sql("SELECT * FROM ".TABLA_TAREAS);
    ?>

    <body>

    </body>
</html>

