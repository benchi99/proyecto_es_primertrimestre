@include('General.cabecera')


<div class="d-flex justify-content-center">
    <h1 class="m-3 p-3 border-right">Inicio de sesión</h1>
@if($errores['no_sesion_iniciada'])
    <div class="alert alert-danger" role="alert">
        {{ $errores['no_sesion_iniciada'] }}
    </div>
@endif
    <form action="" method="post" class="m-3">
        <div class="form-group">
            <label for="nombreusu">Nombre de usuario</label>
            @if($errores['nombreusu'])
            <input class="form-control is-invalid" type="text" name="nombreusu" id="nombreusu" value="{{ $campos_insertados['nombreusu'] or '' }}">
                <div class="invalid-feedback">
                    {{ $errores['nombreusu'] }}
                </div>
            @else
                <input class="form-control" type="text" name="nombreusu" id="nombreusu" value="{{ $campos_insertados['nombreusu'] or '' }}">
            @endif
        </div>
        <div class="form-group">
            <label for="pass">Contraseña</label>
            @if($errores['pass'])
                <input class="form-control is-invalid" type="password" name="pass" id="pass" value="{{ $campos_insertados['pass'] or '' }}">
                <div class="invalid-feedback">
                    {{ $errores['pass'] }}
                </div>
            @else
                <input class="form-control" type="password" name="pass" id="pass" value="{{ $campos_insertados['pass'] or '' }}">
            @endif
        </div>
        <input type="submit" value="Iniciar sesión" class="btn btn-primary">
    </form>
</div>

@include('General.pie')