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
                <li class="breadcrumb-item active" aria-current="page">Editar mi cuenta</li>
            </ol>
        </nav>
        <form action='@relative("app/index.php?a=8")' method="POST">
            <input type="hidden" name="id" id="id" value="{{ $usuario_editar->id }}">
            <div class="form-row">
                <div class="form-group col-4">
                    <label for="nombre_usuario">Nombre de usuario</label>
                    <input class="form-control" type="text" name="nombre_usuario" id="nombre_usuario" value="{{ $usuario_editar->nombre_usuario or '' }}">
                </div>
                <div class="form-group col-4">
                    <label for="pass">Contraseña</label>
                    <input class="form-control" type="password" name="pass" id="pass">
                    <small id="password_help" class="form-text text-muted">Si no quieres cambiar la contraseña, deja esto en blanco.</small>
                </div>
                <div class="form-group col-4">
                    <label for="email">E-mail</label>
                    <input class="form-control" type="text" name="email" id="email" placeholder="example@example.com" value="{{ $usuario_editar->email or '' }}">
               </div>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</div>

@include('General.pie')

