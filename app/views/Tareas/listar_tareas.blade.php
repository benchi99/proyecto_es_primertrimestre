@include('General.cabecera')

    <h1>Tareas disponibles</h1>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary d-flex justify-content-between" style="margin: auto auto 1rem; width: 95% !important;">
        <a class="navbar-brand" style="color: white;">Acciones</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Activa navegación">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href='@relative("app/controllers/f_tarea.php?action=1")'><i class="fas fa-plus"></i> Añadir nueva tarea... <span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
        <form class="form-inline" method="get">
            <input class="form-control mr-sm-2" type="search" placeholder="Buscar..." aria-label="Buscar">
            <button class="btn btn-outline-light my-2 my-sm-0" type="submit" name="querystr">Buscar</button>
        </form>
    </nav>

    <table class="table table-striped table-bordered table-hover" style="margin: auto; width:95% !important;">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Descripcion</th>
                <th scope="col">Población</th>
                <th scope="col">Persona de contacto</th>
                <th scope="col">Estado</th>
                <th scope="col">Fecha de creación</th>
                <th scope="col">Persona encargada</th>
                <th scope="col">Fecha de realización</th>
                <th scope="col">Anotación anterior</th>
                <th scope="col">Anotación posterior</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @for($i = 0; $i < $limite; $i++)
                @if(($i+$limite_comienzo) < $num_tareas)
                @set($tarea = $tareas[$i+$limite_comienzo])
                <tr>
                    <td>{{ $tarea->descripcion }}</td>
                    <td>{{ $tarea->poblacion }}</td>
                    <td>
                        @foreach($usuarios as $usuario)
                             @if($usuario->id === $tarea->persona_contacto)
                                {{ $usuario->nombre }}
                             @endif
                        @endforeach
                    </td>
                    <td>
                        @if($tarea->estado == 0)
                            Pendiente
                        @elseif($tarea->estado == 1)
                            Completado
                        @endif
                    </td>
                    <td>{{ $tarea->fecha_creacion }}</td>
                    <td>
                        @foreach($usuarios as $usuario)
                            @if($usuario->id === $tarea->persona_encargada)
                                {{ $usuario->nombre }}
                            @endif
                        @endforeach
                    </td>
                    <td>{{ $tarea->fecha_realizacion }}</td>
                    <td>{{ $tarea->anotacion_anterior }}</td>
                    <td>{{ $tarea->anotacion_posterior }}</td>
                    <td>
                        <a href='@relative("app/controllers/f_tarea.php?action=2&task_id={$tarea->id}")'>
                            <i class="fas fa-edit"></i> Editar</a><br>
                        <a href='@relative("app/controllers/f_tarea.php?action=4&task_id={$tarea->id}")'>
                            <i class="fas fa-check"></i> Completar</a><br>
                        <a href='@relative("app/controllers/f_tarea.php?action=3&task_id={$tarea->id}")'>
                            <i class="fas fa-eraser"></i> Eliminar</a>
                    </td>
                </tr>
                @endif
            @endfor
        </tbody>
    </table>
    <br>
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
                    <li class="page-item"><a href="?page={{$page}}" class="page-link">{{$page}}</a></li>
                @endif
            @endfor
        </ul>
    </nav>

@include('General.pie')