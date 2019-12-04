@include('General.cabecera')
<style>
    @import url(@relative("assets/css/estilos_lista.css"))
</style>
<script src='@relative("assets/js/listar.js")'></script>

<h1>Tareas disponibles</h1>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary d-flex justify-content-between">
    <a class="navbar-brand">Acciones</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Activa navegación">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href='@relative("app/?a=1&action=1")'><i class="fas fa-plus"></i>
                    Añadir nueva tarea...</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#filterCollapse" role="button" aria-expanded="false"
                   aria-controls="collapseExample"><i class="fas fa-filter"></i> Filtrar</a>
            </li>
        </ul>
    </div>
    <form class="form-inline" method="get">
        <input class="form-control mr-sm-2" type="search" name="querystr" placeholder="Buscar..." aria-label="Buscar"
               value="{{$querystr or ''}}">
        <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Buscar</button>
    </form>
</nav>
<div class="collapse" id="filterCollapse" style="margin: auto auto 1rem auto; width: 95%">
    <div class="card bg-primary card-body">
        <form class="d-flex bd-highlight" method="post">
            <div class="p-2 flex-fill bd-highlight">
                <h4>Por persona</h4>
                <ul>
                    <li>
                        <label for="persona_contacto">De Contacto</label>
                        <select class="form-control" name="persona_contacto" id="persona_contacto"></select>
                    </li>
                    <li>
                        <label for="persona_encargada">Encargada</label>
                        <select class="form-control" name="persona_encargada" id="persona_encargada"></select>
                    </li>
                </ul>
            </div>
            <div class="p-2 flex-fill bd-highlight" style="width: 30%">
                <h4>Por fecha</h4>
                <ul>
                    <li>
                        <label for="fecha_creacion">De creación</label>
                        <select class="form-control" name="tipo_filtro_fecha_creacion" id="tipo_filtro_fecha_creacion">
                            <option value=">">Antes de</option>
                            <option value="=" selected>Durante</option>
                            <option value="<">Despues de</option>
                        </select>
                        <input class="form-control" type="text" name="fecha_creacion" id="fecha_creacion" placeholder="dd-mm-AAAA">
                    </li>
                    <li>
                        <label for="fecha_realizacion">De realización</label>
                        <select class="form-control" name="tipo_filtro_fecha_realizacion" id="tipo_filtro_fecha_creacion">
                            <option value=">">Antes de</option>
                            <option value="=" selected>Durante</option>
                            <option value="<">Despues de</option>
                        </select>
                        <input class="form-control" type="text" name="fecha_realizacion" id="fecha_realizacion" placeholder="dd-mm-AAAA">
                    </li>
                </ul>
            </div>
            <div class="p-2 flex-fill bd-highlight">
                <h4>Por ubicación</h4>
                <ul>
                    <li>
                        <label for="provincias">Provincia</label>
                        <select class="form-control" name="provincia" id="provincias" onchange="actualizaSelectMunicipios(this.selectedIndex)"></select>
                    </li>
                    <li>
                        <label for="poblaciones">Población</label>
                        <select class="form-control" name="poblacion" id="poblaciones" disabled>
                            <option value="-1" selected>Seleccione provincia</option>
                        </select>
                    </li>

                </ul>
            </div>
            <button type="submit" class="btn btn-outline-light my-2 my-sm-0">Filtrar...</button>
        </form>
    </div>
</div>

<table class="table table-striped table-bordered table-hover">
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
                        <a href='@relative("app/?a=1&action=2&task_id={$tarea->id}")'>
                            <i class="fas fa-edit"></i> Editar</a><br>
                        <a href='@relative("app/?a=1&action=4&task_id={$tarea->id}")'>
                            <i class="fas fa-check"></i> Completar</a><br>
                        <a href='@relative("app/?a=1&action=3&task_id={$tarea->id}")'>
                            <i class="fas fa-eraser"></i> Eliminar</a>
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

@include('General.pie')