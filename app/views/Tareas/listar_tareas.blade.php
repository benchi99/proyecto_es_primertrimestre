@include('General.cabecera')

    <h1>Tareas disponibles</h1>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary d-flex justify-content-between" style="margin: auto auto 1rem auto; width: 95% !important;">
        <a class="navbar-brand" style="color: white;">Acciones</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Activa navegación">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav" >
                <li class="nav-item active">
                    <a class="nav-link" href='@relative("app/controllers/f_tarea.php?action=1")'><i class="fas fa-plus"></i> Añadir nueva tarea... <span class="sr-only">(current)</span></a>
                </li>
                <li>
                    <a class="nav-link" data-toggle="collapse" href="#filterCollapse" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fas fa-filter"></i> Filtrar<span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
        <form class="form-inline" method="get">
            <input class="form-control mr-sm-2" type="search" name="querystr" placeholder="Buscar..." aria-label="Buscar" value="{{$querystr or ''}}">
            <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Buscar</button>
        </form>
    </nav>
    <div class="collapse" id="filterCollapse" style="margin: auto auto 1rem auto; width: 95%">
        <div class="card bg-primary card-body">
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
        </div>
    </div>

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
            @if($tareas)
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
            @else
                <tr>
                    <td colspan="10" style="text-align: center; background-color: white;">Lo sentimos, no hay resultados de la búsqueda.</td>
                </tr>
            @endif
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
                    @if($querystr)
                        <li class="page-item"><a href="?querystr={{$querystr}}&page={{$page}}" class="page-link">{{$page}}</a></li>
                    @else
                        <li class="page-item"><a href="?page={{$page}}" class="page-link">{{$page}}</a></li>
                    @endif
                @endif
            @endfor
        </ul>
    </nav>

@include('General.pie')