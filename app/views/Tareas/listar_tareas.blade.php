@include('General.cabecera')

    <h1>Tareas disponibles</h1>

    <table>
        <thead>
            <tr>
                <td>Acciones: </td>
                <td colspan="11" style="text-align: right">
                    <a href='@relative("app/controllers/f_tarea.php?action=1")'><i class="fas fa-plus"></i> Añadir nueva tarea...</a>
                </td>
            </tr>
            <tr>
{{--                <td>ID</td>--}}
                <td>Descripcion</td>
                <td>Población</td>
{{--                <td>Código Postal</td>--}}
{{--                <td>Provincia</td>--}}
                <td>Persona de contacto</td>
                <td>Estado</td>
                <td>Fecha de creación</td>
                <td>Persona encargada</td>
                <td>Fecha de realización</td>
                <td>Anotación anterior</td>
                <td>Anotación posterior</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @foreach($tareas as $tarea)
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
                            <i class="fas fa-edit"></i> Editar</a>
                        <a href='@relative("app/controllers/f_tarea.php?action=4&task_id={$tarea->id}")'>
                            <i class="fas fa-check"></i> Completar</a>
                        <a href='@relative("app/controllers/f_tarea.php?action=3&task_id={$tarea->id}")'>
                            <i class="fas fa-eraser"></i> Eliminar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td>Descripcion</td>
                <td>Población</td>
                <td>Persona de contacto</td>
                <td>Estado</td>
                <td>Fecha de creación</td>
                <td>Persona encargada</td>
                <td>Fecha de realización</td>
                <td>Anotación anterior</td>
                <td>Anotación posterior</td>
                <td></td>
            </tr>
        </tfoot>
    </table>

@include('General.pie')