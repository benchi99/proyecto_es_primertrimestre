@include('General.cabecera')

    <h1>Tareas disponibles</h1>

    <table class="table table-striped table-bordered table-hover" style="margin: auto; width:95% !important;">
        <thead class="thead-dark">
            <tr>
                <td>Acciones: </td>
                <td colspan="11" style="text-align: right">
                    <a href='@relative("app/controllers/f_tarea.php?action=1")'><i class="fas fa-plus"></i> Añadir nueva tarea...</a>
                </td>
            </tr>
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