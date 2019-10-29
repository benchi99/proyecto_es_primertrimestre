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

<h2>Tarea</h2>

<form action="" method="POST">
    <table>
        <tr>
            <td><label for="descripcion">Descripción</label></td>
            <td><textarea name="descripcion" id="descripcion" cols="30" rows="10"></textarea></td>
        </tr>
        <tr>
            <td><label for="poblacion">Población</label></td>
            <td><input type="text" name="poblacion" id="poblacion"></td>
        </tr>
        <tr>
            <td><label for="cp">Código Postal</label></td>
            <td><input type="text" name="cp" id="cp"></td>
        </tr>
        <tr>
            <td><label for="provincia">Provincia</label></td>
            <td><input type="text" name="provincia" id="provincia"></td>
        </tr>
        <tr>
            <td><label for="persona_contacto">Persona de contacto</label></td>
            <td>
                <select name="persona_contacto" id="persona_contacto">
                    <option value=""> == SELECCIONA UNO == </option>
                </select>
            </td>
        </tr>
        <tr>
            <td><label for="estado">Estado</label></td>
            <td><input type="text" name="estado" id="estado"></td>
        </tr>
        <tr>
            <td><label for="fecha_creacion">Fecha de creación</label></td>
            <td><input type="date" name="fecha_creacion" id="fecha_creacion"></td>
        </tr>
        <tr>
            <td><label for="persona_encargada">Persona encargada de la tarea</label></td>
            <td>
                <select name="persona_encargada" id="persona_encargada">
                    <option value=""> == SELECCIONA UNO ==</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><label for="fecha_realizacion">Fecha de realización</label></td>
            <td><input type="date" name="fecha_realizacion" id="fecha_realizacion"></td>
        </tr>
        <tr>
            <td><label for="anotacion_anterior">Anotación anterior</label></td>
            <td><input type="text" name="anotacion_anterior" id="anotacion_anterior"></td>
        </tr>
        <tr>
            <td><label for="anotacion_posterior">Anotación posterior</label></td>
            <td><input type="text" name="anotacion_posterior" id="anotacion_posterior"></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="Enviar"></td>
        </tr>
    </table>
</form>
</body>
</html>

<?php