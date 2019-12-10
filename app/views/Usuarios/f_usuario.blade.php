@include('General.cabecera')

<style>
    @import url(@relative("assets/css/estilo_form.css"))
</style>

<div class="row d-flex justify-content-center">
    @include('General.lateral')
    <div class="col-8">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="@relative('app/?a=11')">Usuarios</a></li>
                @if($action === 1)
                    <li class="breadcrumb-item active" aria-current="page">Crear Usuario</li>
                @else
                    <li class="breadcrumb-item active" aria-current="page">Editar Usuario</li>
                @endif
            </ol>
        </nav>
        <form action='@relative("app/index.php?a={$action}")' method="POST">
            @if($action===6)
                <input type="hidden" name="id" id="id" value="{{ $usuario_editar->id }}">
            @endIf
            <div class="form-row">
                <div class="form-group col-4">
                    <label for="nombre_usuario">Nombre de usuario</label>
                    @if($action===5)
                        <input class="form-control" type="text" name="nombre_usuario" id="nombre_usuario" value="{{ $valores_antiguos['nombre_usuario'] or '' }}">
                    @elseif($action===6)
                        <input class="form-control" type="text" name="nombre_usuario" id="nombre_usuario" value="{{ $usuario_editar->nombre_usuario or '' }}">
                    @endif
                    @if($errores['nombre_usuario'])
                        <div class="alert alert-danger" role="alert">
                            {{ $errores['nombre_usuario'] }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-4">
                    <label for="pass">Contraseña</label>
                    <input class="form-control" type="password" name="pass" id="pass">
                    <small id="password_help" class="form-text text-muted">Si no quieres cambiar la contraseña, deja esto en blanco.</small>
                </div>
                <div class="form-group col-4">
                    <label for="email">E-mail</label>
                    @if($action===5)
                        <input class="form-control" type="text" name="email" id="email" placeholder="example@example.com" value="{{ $valores_antiguos['email'] or '' }}">
                    @elseif($action===6)
                        <input class="form-control" type="text" name="email" id="email" placeholder="example@example.com" value="{{ $usuario_editar->email or '' }}">
                    @endif
                </div>
            </div>
                <div class="form-row">
                    <div class="form-group col-4">
                        <label for="nombre">Nombre</label>
                        @if($action===5)
                            <input class="form-control" type="text" name="nombre" id="nombre" value="{{ $valores_antiguos['nombre'] or '' }}">
                        @elseif($action===6)
                            <input class="form-control" type="text" name="nombre" id="nombre" value="{{ $usuario_editar->nombre or '' }}">
                        @endif
                    </div>
                    <div class="form-group col-4">
                        <label for="apellidos">Apellidos</label>
                        @if($action===5)
                            <input class="form-control" type="text" name="apellidos" id="apellidos" value="{{ $valores_antiguos['apellidos'] or '' }}">
                        @elseif($action===6)
                            <input class="form-control" type="text" name="apellidos" id="apellidos" value="{{ $usuario_editar->apellidos or '' }}">
                        @endif
                    </div>
                    <div class="form-group col-4">
                        <label for="telefono">Teléfono</label>
                        @if($action===5)
                            <input class="form-control" type="text" name="telefono" id="telefono" value="{{ $valores_antiguos['telefono'] or '' }}">
                        @elseif($action===6)
                            <input class="form-control" type="text" name="telefono" id="telefono" value="{{ $usuario_editar->telefono or '' }}">
                        @endif
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-10">
                        <label for="direccion">Dirección</label>
                        @if($action===5)
                            <input class="form-control" type="text" name="direccion" id="direccion" value="{{ $valores_antiguos['direccion'] or '' }}">
                        @elseif($action===6)
                            <input class="form-control" type="text" name="direccion" id="direccion" value="{{ $usuario_editar->direccion or '' }}">
                        @endif
                    </div>
                    <div class="form-group col-2">
                        <label for="rol">Rol</label>
                        <select name="rol" id="rol" class="form-control">
                            @if($action===5)
                                <option value="0">Operario</option>
                                <option value="1">Administrador</option>
                            @elseif($action===6)
                                @if($usuario_editar->rol === 0)
                                    <option value="0" selected>Operario</option>
                                    <option value="1">Administrador</option>
                                @else
                                    <option value="0">Operario</option>
                                    <option value="1" selected>Administrador</option>
                                @endif
                            @endif
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">
                    @if($action===1)
                        Añadir
                    @else
                        Actualizar
                    @endif
                </button>
        </form>
    </div>
</div>

@include('General.pie')

