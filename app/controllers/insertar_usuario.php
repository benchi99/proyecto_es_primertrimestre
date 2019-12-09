<?php

    $rol_requerido = ROL_ADMIN;

    include __DIR__.'/validacion_usuarios.php';

    include_once __DIR__.'/f_usuario.php';

    if (!$_POST) {
        // Ir a formulario.
        try {
            echo $blade->run('Usuarios.f_usuario', [
               "action" => 1,
               "usuario" => $nombre_usuario,
               "sesion_iniciada" => $sesion_iniciada,
               "rol_actual" => intval($_SESSION['rol'])
            ]);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    } else {
        // Se está insertando informacion.
        try {
            $usuario_nuevo = new Usuario([
                'nombre_usuario' => vp('nombre_usuario'),
                'pass' => password_hash(vp('pass'), PASSWORD_DEFAULT),
                'nombre' => vp('nombre'),
                'apellidos' => vp('apellidos'),
                'telefono' => vp('telefono'),
                'email' => vp('email'),
                'direccion' => vp('direccion'),
                'rol' => vp('rol')
            ]);

            if ($usuario_nuevo->commit_to_database()) {
                header('Location:index.php?a=8');
            } else {
                echo $blade->run('Error.error', [
                    'error' => 'El usuario no ha sido insertado correctamente. Contacte con el administrador.',
                    'usuario' => $nombre_usuario,
                    'sesion_iniciada' => $sesion_iniciada,
                    'rol_actual' => intval($_SESSION['rol'])
                ]);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }