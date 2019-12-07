<?php

$rol_requerido = 0;

include __DIR__.'/validacion_usuarios.php';

session_unset();
session_destroy();
session_abort();

header('Location:index.php');