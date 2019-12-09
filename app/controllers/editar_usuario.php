<?php
    $rol_requerido = ROL_ADMIN;

    include __DIR__ . '/validacion_usuarios.php';

    include_once __DIR__ . '/f_usuario.php';

    if (vg('user_id') || vp('id')) {
        if (!$_POST) {
            // Obtener usuario, enviar a vista
            try {
                $usuario = new Usuario(['id' => vg('user_id')]);
                echo $blade->run('Usuarios.f_usuario', [
                    'action' => 2,
                    'usuario_editar' => $usuario,
                    'usuario' => $nombre_usuario,
                    'sesion_iniciada' => $sesion_iniciada,
                    'rol_actual' => intval($_SESSION['rol'])
                ]);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        } else {
            // Se quiere actualizar usuario
            // Obtener tarea y editar
            try {
                $usuario = new Usuario(['id' => vp('id')]);
            } catch (Exception $e) {
                echo $e->getMessage();
            }

            $usuario->nombre_usuario = vp('nombre_usuario');
            if (vp('pass')) {
                $usuario->pass = password_hash(vp('pass'), PASSWORD_DEFAULT);
            }
            $usuario->nombre = vp('nombre');
            $usuario->apellidos = vp('apellidos');
            $usuario->telefono = vp('telefono');
            $usuario->email = vp('email');
            $usuario->direccion = vp('direccion');
            $usuario->rol = vp('rol');

            try {
                if ($usuario->commit_to_database()) {
                    header('Location:index.php?a=8');
                } else {
                    echo $blade->run('Error.error', [
                        'error' => 'Error al actualizar usuario: no se ha podido actualizar el dato. Contácta con el administrador.',
                        'usuario' => $nombre_usuario,
                        'sesion_iniciada' => $sesion_iniciada,
                        'rol_actual' => intval($_SESSION['rol'])
                    ]);
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    } else {
        try {
            echo $blade->run('Error.error', [
                'error' => 'Error al obtener usuario: No se ha especificado ID.',
                'usuario' => $nombre_usuario,
                'sesion_iniciada' => $sesion_iniciada,
                'rol_actual' => intval($_SESSION['rol'])
            ]);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }