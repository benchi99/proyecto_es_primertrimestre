@include('General.cabecera')

<style>
    @import url(@relative("assets/css/estilo_form.css"))
</style>

<div class="row d-flex justify-content-center">
    @include('General.lateral')
    <div class="col-8">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="@relative('app/?a=8')">Usuarios</a></li>
                @if($action === 1)
                    <li class="breadcrumb-item active" aria-current="page">Crear Usuario</li>
                @else
                    <li class="breadcrumb-item active" aria-current="page">Editar Usuario</li>
                @endif
            </ol>
        </nav>
        <form action='@relative("app/index.php?a={$action}")' method="POST">
            @if($action===2)
                <input type="hidden" name="id" id="id" value="{{ $tarea-> id }}">
            @endIf
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                @if($action===1)
                    <textarea class="form-control" name="descripcion" id="descripcion" cols="30" rows="10">{{ $valores_antiguos['descripcion'] or '' }}</textarea>
                @elseif($action===2)
                    <textarea class="form-control" name="descripcion" id="descripcion" cols="30" rows="10">{{ $tarea->descripcion or '' }}</textarea>
                @endif
                @if($errores['descripcion'])
                    <div class="alert alert-danger" role="alert">
                        {{ $errores['descripcion'] }}
                    </div>
                @endif
            </div>
            <div class="form-row">
                <div class="form-group col-6">
                    <label for="poblacion">Población</label>
                    @if($action===1)
                        <input class="form-control" type="text" name="poblacion" id="poblacion" value="{{ $valores_antiguos['poblacion'] or '' }}">
                    @elseif($action===2)
                        <input class="form-control" type="text" name="poblacion" id="poblacion" value="{{ $tarea->poblacion or '' }}">
                    @endif
                    @if($errores['poblacion'])
                        <div class="alert alert-danger" role="alert">
                            {{ $errores['poblacion'] }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-2">
                    <label for="cp">Código Postal</label>
                    @if($action===1)
                        <input class="form-control" type="text" name="cp" id="cp" value="{{ $valores_antiguos['cp'] or '' }}">
                    @elseif($action===2)
                        <input class="form-control" type="text" name="cp" id="cp" value="{{ $tarea->codigo_postal or '' }}">
                    @endif
                    @if($errores['cp'])
                        <div class="alert alert-danger" role="alert">
                            {{ $errores['cp'] }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-4">
                    <label for="provincia">Provincia</label>
                    <!-- TODO: TIRAR DE BD POR EL AMOR DE DIOS -->
                    <select class="form-control" name="provincia" id="provincia">
                        <option value='alava'>Álava</option>
                        <option value='albacete'>Albacete</option>
                        <option value='alicante'>Alicante/Alacant</option>
                        <option value='almeria'>Almería</option>
                        <option value='asturias'>Asturias</option>
                        <option value='avila'>Ávila</option>
                        <option value='badajoz'>Badajoz</option>
                        <option value='barcelona'>Barcelona</option>
                        <option value='burgos'>Burgos</option>
                        <option value='caceres'>Cáceres</option>
                        <option value='cadiz'>Cádiz</option>
                        <option value='cantabria'>Cantabria</option>
                        <option value='castellon'>Castellón/Castelló</option>
                        <option value='ceuta'>Ceuta</option>
                        <option value='ciudadreal'>Ciudad Real</option>
                        <option value='cordoba'>Córdoba</option>
                        <option value='cuenca'>Cuenca</option>
                        <option value='girona'>Girona</option>
                        <option value='laspalmas'>Las Palmas</option>
                        <option value='granada'>Granada</option>
                        <option value='guadalajara'>Guadalajara</option>
                        <option value='guipuzcoa'>Guipúzcoa</option>
                        <option value='huelva'>Huelva</option>
                        <option value='huesca'>Huesca</option>
                        <option value='illesbalears'>Illes Balears</option>
                        <option value='jaen'>Jaén</option>
                        <option value='acoruña'>A Coruña</option>
                        <option value='larioja'>La Rioja</option>
                        <option value='leon'>León</option>
                        <option value='lleida'>Lleida</option>
                        <option value='lugo'>Lugo</option>
                        <option value='madrid'>Madrid</option>
                        <option value='malaga'>Málaga</option>
                        <option value='melilla'>Melilla</option>
                        <option value='murcia'>Murcia</option>
                        <option value='navarra'>Navarra</option>
                        <option value='ourense'>Ourense</option>
                        <option value='palencia'>Palencia</option>
                        <option value='pontevedra'>Pontevedra</option>
                        <option value='salamanca'>Salamanca</option>
                        <option value='segovia'>Segovia</option>
                        <option value='sevilla'>Sevilla</option>
                        <option value='soria'>Soria</option>
                        <option value='tarragona'>Tarragona</option>
                        <option value='santacruztenerife'>Santa Cruz de Tenerife</option>
                        <option value='teruel'>Teruel</option>
                        <option value='toledo'>Toledo</option>
                        <option value='valencia'>Valencia/Valéncia</option>
                        <option value='valladolid'>Valladolid</option>
                        <option value='vizcaya'>Vizcaya</option>
                        <option value='zamora'>Zamora</option>
                        <option value='zaragoza'>Zaragoza</option>
                    </select>
                    @if($errores['provincia'])
                        <div class="alert alert-danger" role="alert">
                            {{ $errores['provincia'] }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="form-row">
                @if($action===1)
                    <div class="form-group col-6">
                        @else
                            <div class="form-group col-5">
                                @endif
                                <label for="persona_contacto">Persona de contacto</label>
                                <select class="form-control" name="persona_contacto" id="persona_contacto">
                                    <option value=""> == SELECCIONA UNO == </option>
                                    @foreach($usuarios as $usuario)
                                        @if($usuario->id == 0)
                                            @continue
                                        @elseif(($action === 2 and $usuario->id === $tarea->persona_contacto) or (($valores_antiguos['persona_contacto'] and $action === 1) and $usuario->id === $valores_antiguos['persona_contacto']))
                                            <option value="{{ $usuario->id }}" selected>{{ $usuario->nombre }}</option>
                                        @else
                                            <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                                        @endif
                                    @endforeach
                                    @if($errores['persona_contacto'])
                                        <div class="alert alert-danger" role="alert">
                                            {{ $errores['persona_contacto'] }}
                                        </div>
                                    @endif
                                </select>
                            </div>
                            @if($action===1)
                                <div class="form-group col-6">
                                    @else
                                        <div class="form-group col-5">
                                            @endif
                                            <label for="persona_encargada">Persona encargada de la tarea</label>
                                            <select class="form-control" name="persona_encargada" id="persona_encargada">
                                                <option value=""> == SELECCIONA UNO ==</option>
                                                @foreach($usuarios as $usuario)
                                                    @if(($action === 2 and $usuario->id === $tarea->persona_encargada) or ($valores_antiguos['persona_encargada'] and $usuario->id === $valores_antiguos['persona_encargada']))
                                                        <option value="{{ $usuario->id }}" selected>{{ $usuario->nombre }}</option>
                                                    @else
                                                        <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        @if($action===2)
                                            <div class="form-group col-2">
                                                <label for="estado">Estado</label>
                                                <select class="form-control" name="estado" id="estado">
                                                    @if ($tarea->estado == 0)
                                                        <option value="0" selected>Pendiente</option>
                                                        <option value="1">Completado</option>
                                                    @elseif($tarea->estado == 1)
                                                        <option value="0">Pendiente</option>
                                                        <option value="1" selected>Completado</option>
                                                    @endif
                                                </select>
                                            </div>
                                        @endif
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <label for="fecha_creacion">Fecha de creación</label>
                                        <input class="form-control" type="text" name="fecha_creacion" id="fecha_creacion" value="{{ $tarea->fecha_creacion or '' }}" readonly>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="fecha_realizacion">Fecha de realización</label>
                                        @if($action===1)
                                            <input class="form-control" type="text" name="fecha_realizacion" id="fecha_realizacion" value="{{ $valores_antiguos['fecha_realizacion'] or ''}}">
                                        @elseif($action===2)
                                            <input class="form-control" type="text" name="fecha_realizacion" id="fecha_realizacion" value="{{ $tarea->fecha_realizacion or ''}}">
                                        @endif
                                        @if($errores['fecha_realizacion'])
                                            <div class="alert alert-danger" role="alert">
                                                {{ $errores['fecha_realizacion'] }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <label for="anotacion_anterior">Anotación anterior</label>
                                        @if($action===1)
                                            <input class="form-control" type="text" name="anotacion_anterior" id="anotacion_anterior" value="{{ $valores_antiguos['anotacion_anterior'] or '' }}">
                                        @elseif($action===2)
                                            <input class="form-control" type="text" name="anotacion_anterior" id="anotacion_anterior" value="{{ $tarea->anotacion_anterior or '' }}">
                                        @endif
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="anotacion_posterior">Anotación posterior</label>
                                        @if($action===1)
                                            <input class="form-control" type="text" name="anotacion_posterior" id="anotacion_posterior" value="{{ $valores_antiguos['anotacion_posterior'] or '' }}">
                                        @elseif($action===2)
                                            <input class="form-control" type="text" name="anotacion_posterior" id="anotacion_posterior" value="{{ $tarea->anotacion_posterior or '' }}">
                                        @endif
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    @if($action===1)
                                        Añadir
                                    @else
                                        Actualizar
                                    @endif
                                </button>
        </form>
    </div>
</div>

@include('General.pie')

