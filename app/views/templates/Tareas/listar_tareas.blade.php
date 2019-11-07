<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Garden</title>
</head>

<body>
    <h1>Tareas disponibles</h1>

    <table>
        <thead>
            <tr>
                <td>Acciones: </td>
                <td colspan="11" style="text-align: right">
                    <a href='@relative("views/f_tarea.php?action=1")'>Añadir nueva tarea...</a>
                </td>
            </tr>
            <tr>
                <td>ID</td>
                <td>Descripcion</td>
                <td>Población</td>
                <td>Código Postal</td>
                <td>Provincia</td>
                <td>Persona de contacto</td>
                <td>Estado</td>
                <td>Fecha de creación</td>
                <td>Persona encargada</td>
                <td>Fecha de realización</td>
                <td>Anotación anterior</td>
                <td>Anotación posterior</td>
            </tr>
        </thead>
        <tbody>
            @foreach($tareas as $tarea)
                <tr>
                    <td>{{ $tarea->id }}</td>
                    <td>{{ $tarea->descripcion }}</td>
                    <td>{{ $tarea->poblacion }}</td>
                    <td>{{ $tarea->codigo_postal }}</td>
                    <td>{{ $tarea->provincia }}</td>
                    <td>{{ $tarea->persona_contacto }}</td>
                    <td>{{ $tarea->estado }}</td>
                    <td>{{ $tarea->fecha_creacion }}</td>
                    <td>{{ $tarea->persona_encargada }}</td>
                    <td>{{ $tarea->fecha_realizacion }}</td>
                    <td>{{ $tarea->anotacion_anterior }}</td>
                    <td>{{ $tarea->anotacion_posterior }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td>ID</td>
                <td>Descripcion</td>
                <td>Población</td>
                <td>Código Postal</td>
                <td>Provincia</td>
                <td>Persona de contacto</td>
                <td>Estado</td>
                <td>Fecha de creación</td>
                <td>Persona encargada</td>
                <td>Fecha de realización</td>
                <td>Anotación anterior</td>
                <td>Anotación posterior</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>