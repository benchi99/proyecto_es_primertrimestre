<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href='@relative("assets/img/favicon.png")' type="image/x-icon">
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- JS BOOTSTRAP -->
    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <!-- FONTAWESOME -->
    <script src="https://kit.fontawesome.com/c2db9669aa.js" crossorigin="anonymous"></script>
    <!-- SCRIPTS PROPIOS -->
    <script src='@relative("assets/js/global.js")'></script>
    <title>Paco's Garden</title>
    <style>
        @import url(@relative("assets/css/estilo_cabecera.css"))
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark d-flex justify-content-between">
    <ul class="navbar-nav ml-auto">
    @if($sesion_iniciada)
        <li class="navbar-item">
            <span class="navbar-text">Hola, {{ $usuario }}.</span>
        </li>
        <li class="navbar-item">
            <a href="?a=10" class="nav-link text-white">Cerrar sesión</a>
        </li>
    @else
        <li class="navbar-item">
            <span class="navbar-text">Hola, invitado.</span>
        </li>
        <li class="navbar-item">
            <a href="?a=9" class="nav-link text-white">Iniciar sesión</a>
        </li>
    @endif
    </ul>
</nav>

<div class="d-flex justify-content-center m-3" id="logo_img">
    <img src='@relative("assets/img/logo.png")' alt="logo_pacos_garden" height="250">
</div>

<div class="container-fluid">
