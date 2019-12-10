@include('General.cabecera')

<div class="row d-flex justify-content-center">
    @include('General.lateral')
    <div class="col-8">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="@relative('app/?a=11')">Usuarios</a></li>
                <li class="breadcrumb-item active" aria-current="page">Eliminar Usuario</li>
            </ol>
        </nav>
        <div class="row d-flex justify-content-center mb-4 mt-4 pb-4 pt-4">
            ¿Estás seguro que quieres eliminar el usuario "{{ $usuario_eliminar->nombre_usuario }}?"
        </div>
        <div class="row d-flex justify-content-around mr-10 ml-10 pr-10 pl-10">
            <a class="btn btn-primary text-white">Sí</a>
            <a class="btn btn-primary text-white">No</a>
        </div>
    </div>
</div>

@include('General.pie')