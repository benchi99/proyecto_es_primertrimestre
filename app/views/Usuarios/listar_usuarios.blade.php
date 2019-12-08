@include('General.cabecera')

<style>
    @import url(@relative("assets/css/estilos_lista.css"))
</style>

<div class="row d-flex justify-content-center">
    @include('General.lateral')
    <div class="col-8 p-0">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary d-flex justify-content-between">
            <a class="navbar-brand">Acciones</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Activa navegación">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    @if ($rol_actual === 1)
                    <li class="nav-item">
                        <a class="nav-link" href='@relative("app/?a=1")'><i class="fas fa-plus"></i>
                            Añadir nuevo usuario...</a>
                    </li>
                    @endif
                </ul>
            </div>
            <form class="form-inline" method="get">
                <input type="hidden" name="a" id="a" value="8">
                <input class="form-control mr-sm-2" type="search" name="querystr" placeholder="Buscar..." aria-label="Buscar"
                       value="{{$querystr or ''}}">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Buscar</button>
            </form>
        </nav>

        <table class="table table-striped table-bordered table-hover">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Nombre de Usuario</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Teléfono</th>
                <th scope="col">E-mail</th>
                <th scope="col">Dirección</th>
                <th scope="col">Rol</th>
                <th scope="col">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @if($usuarios)
                @for($i = 0; $i < $limite; $i++)
                    @if(($i+$limite_comienzo) < $num_usuarios)
                        @set($usuario = $usuarios[$i+$limite_comienzo])
                        <tr>
                            <td>{{ $usuario->nombre_usuario }}</td>
                            <td>{{ $usuario->nombre }}</td>
                            <td>{{ $usuario->apellidos }}</td>
                            <td>{{ $usuario->telefono }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>{{ $usuario->direccion }}</td>
                            <td>
                                @if($usuario->rol == 0)
                                    Operario
                                @elseif($usuario->rol == 1)
                                    Administrador
                                @endif
                            </td>
                            <td>
                                @if ($usuario->id != 0)
                                <a href='#'>
                                    <i class="fas fa-edit"></i> Editar</a><br>
                                <a href='#'>
                                    <i class="fas fa-eraser"></i> Eliminar</a><br>
                                @endif
                            </td>
                        </tr>
                    @endif
                @endfor
            @else
                <tr>
                    <td colspan="10" style="text-align: center; background-color: white;">Lo sentimos, no hay resultados de la
                        búsqueda.
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
        <br>
        <nav aria-label="pagination">
            <ul class="pagination justify-content-center">
                @for($page = 1; $page <= $total_pgs; $page++)
                    @if($page == $pagina_actual)
                        <li class="page-item active" aria-current="page">
                            <span class="page-link">
                                {{ $page }}
                                <span class="sr-only">(current)</span>
                            </span>
                        </li>
                    @else
                        @if($querystr)
                            <li class="page-item"><a href="?&querystr={{$querystr}}&page={{$page}}"
                                                     class="page-link">{{$page}}</a></li>
                        @else
                            <li class="page-item"><a href="?&page={{$page}}" class="page-link">{{$page}}</a></li>
                        @endif
                    @endif
                @endfor
            </ul>
    </nav>
    </div>
</div>
@include('General.pie')