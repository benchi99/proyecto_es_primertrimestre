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
        require __DIR__.'/../controllers/consultas_comunes.php';

        $lista = obtain_all_tasks();

        if (!$lista) {
            echo '<p style="color: red;"> Hubo un error al obtener los datos en base de datos</p>';
        } else {
            echo '<table>';
            foreach ($lista as $tarea) {
                echo '<tr>';
                echo '<td>'.$tarea->id.'</td>';
                echo '<td>'.$tarea->descripcion.'</td>';
                echo '<td>'.$tarea->poblacion.'</td>';
                echo '<td>'.$tarea->codigo_postal.'</td>';
                echo '<td>'.$tarea->provincia.'</td>';
                echo '<td>'.$tarea->persona_contacto.'</td>';
                echo '<td>'.$tarea->estado.'</td>';
                echo '<td>'.$tarea->fecha_creacion.'</td>';
                echo '<td>'.$tarea->persona_encargada.'</td>';
                echo '<td>'.$tarea->fecha_realizacion.'</td>';
                echo '<td>'.$tarea->anotacion_anterior.'</td>';
                echo '<td>'.$tarea->anotacion_posterior.'</td>';
                echo '</tr>';
            }
        }


    ?>

    <body>

    </body>
</html>

