@include('General.cabecera')

<h1>Iniciar sesión</h1>

@if($errores['no_sesion_iniciada'])
    <div class="alert alert-danger" role="alert">
        {{ $errores['no_sesion_iniciada'] }}
    </div>
@endif

<form action="" method="post">
    <table>
        <tr>
            <td><label for="nombreusu"></label></td>
            <td><input type="text" name="nombreusu" id="nombreusu" value="{{ $campos_insertados['nombreusu'] or '' }}"></td>
            @if($errores['nombreusu'])
                <td>
                    <div class="alert alert-danger" role="alert">
                        {{ $errores['nombreusu'] }}
                    </div>
                </td>
            @endif
        </tr>
        <tr>
            <td><label for="pass"></label></td>
            <td><input type="password" name="pass" id="pass" value="{{ $campos_insertados['pass'] or '' }}"></td>
            @if($errores['pass'])
                <td>
                    <div class="alert alert-danger" role="alert">
                        {{ $errores['pass'] }}
                    </div>
                </td>
            @endif
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" value="Enviar">
            </td>
        </tr>
    </table>
</form>

@include('General.pie')