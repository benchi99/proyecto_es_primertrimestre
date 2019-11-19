@include('General.cabecera')

<h2>Tarea</h2>

<form action='@relative("app/controllers/f_tarea.php?action={$action}")' method="POST">
    @if($action===2)
        <input type="hidden" name="id" id="id" value="{{ $tarea-> id }}">
    @endIf
    <table>
        <tr>
            <td><label for="descripcion">Descripción</label></td>
            <td>
            @if($action===1)
                <textarea name="descripcion" id="descripcion" cols="30" rows="10">{{ $valores_antiguos['descripcion'] or '' }}</textarea>
            @elseif($action===2)
                <textarea name="descripcion" id="descripcion" cols="30" rows="10">{{ $tarea->descripcion or '' }}</textarea>
            @endif
            </td>
            @if($errores['descripcion'])
                <td>
                    <div class="alert alert-danger" role="alert">
                        {{ $errores['descripcion'] }}
                    </div>
                </td>
            @endif
        </tr>
        <tr>
            <td><label for="poblacion">Población</label></td>
            @if($action===1)
                <td><input type="text" name="poblacion" id="poblacion" value="{{ $valores_antiguos['poblacion'] or '' }}"></td>
            @elseif($action===2)
                <td><input type="text" name="poblacion" id="poblacion" value="{{ $tarea->poblacion or '' }}"></td>
            @endif
            @if($errores['poblacion'])
                <td>
                    <div class="alert alert-danger" role="alert">
                        {{ $errores['poblacion'] }}
                    </div>
                </td>
            @endif
        </tr>
        <tr>
            <td><label for="cp">Código Postal</label></td>
            @if($action===1)
                <td><input type="text" name="cp" id="cp" value="{{ $valores_antiguos['cp'] or '' }}"></td>
            @elseif($action===2)
                <td><input type="text" name="cp" id="cp" value="{{ $tarea->codigo_postal or '' }}"></td>
            @endif
        @if($errores['cp'])
                <td>
                    <div class="alert alert-danger" role="alert">
                        {{ $errores['cp'] }}
                    </div>
                </td>
            @endif
        </tr>
        <tr>
            <td><label for="provincia">Provincia</label></td>
            <td>
                <!-- Dios santo tirar de db ok? ok-->
                <select name="provincia" id="provincia">
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
            </td>
            @if($errores['provincia'])
                <td>
                    <div class="alert alert-danger" role="alert">
                        {{ $errores['provincia'] }}
                    </div>
                </td>
            @endif
        </tr>
        <tr>
            <td><label for="persona_contacto">Persona de contacto</label></td>
            <td>
                <select name="persona_contacto" id="persona_contacto">
                    <option value=""> == SELECCIONA UNO == </option>
                    @foreach($usuarios as $usuario)
                        @if($usuario->id === 0)
                            @continue
                        @elseif(($action === 2 and $usuario->id === $tarea->persona_contacto) or (($valores_antiguos['persona_contacto'] and $action === 1) and $usuario->id === $valores_antiguos['persona_contacto']))
                            <option value="{{ $usuario->id }}" selected>{{ $usuario->nombre }}</option>
                        @else
                            <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                        @endif
                    @endforeach
                </select>
            </td>
            @if($errores['persona_contacto'])
                <td>
                    <div class="alert alert-danger" role="alert">
                        {{ $errores['persona_contacto'] }}
                    </div>
                </td>
            @endif
        </tr>
        @if($action===2)
            <tr>
                <td><label for="estado">Estado</label></td>
                <td><input type="text" name="estado" id="estado" value="{{ $tarea->estado or '' }}"></td>
            </tr>
        @endif
        @if($action===2)
            <tr>
                <td><label for="fecha_creacion">Fecha de creación</label></td>
                <td><input type="text" name="fecha_creacion" id="fecha_creacion" value="{{ $tarea->fecha_creacion or '' }}" readonly></td>
            </tr>
        @endif
        <tr>
            <td><label for="persona_encargada">Persona encargada de la tarea</label></td>
            <td>
                <select name="persona_encargada" id="persona_encargada">
                    <option value=""> == SELECCIONA UNO ==</option>
                    @foreach($usuarios as $usuario)
                        @if(($action === 2 and $usuario->id === $tarea->persona_encargada) or ($valores_antiguos['persona_encargada'] and $usuario->id === $valores_antiguos['persona_encargada']))
                            <option value="{{ $usuario->id }}" selected>{{ $usuario->nombre }}</option>
                        @else
                            <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                        @endif
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td><label for="fecha_realizacion">Fecha de realización</label></td>
            @if($action===1)
                <td><input type="text" name="fecha_realizacion" id="fecha_realizacion" value="{{ $valores_antiguos['fecha_realizacion'] or ''}}"></td>
            @elseif($action===2)
                <td><input type="text" name="fecha_realizacion" id="fecha_realizacion" value="{{ $tarea->fecha_realizacion or ''}}"></td>
            @endif
            @if($errores['fecha_realizacion'])
                <td>
                    <div class="alert alert-danger" role="alert">
                        {{ $errores['fecha_realizacion'] }}
                    </div>
                </td>
            @endif
        </tr>
        <tr>
            <td><label for="anotacion_anterior">Anotación anterior</label></td>
            @if($action===1)
                <td><input type="text" name="anotacion_anterior" id="anotacion_anterior" value="{{ $valores_antiguos['anotacion_anterior'] or '' }}"></td>
            @elseif($action===2)
                <td><input type="text" name="anotacion_anterior" id="anotacion_anterior" value="{{ $tarea->anotacion_anterior or '' }}"></td>
            @endif
        </tr>
        <tr>
            <td><label for="anotacion_posterior">Anotación posterior</label></td>
            @if($action===1)
                <td><input type="text" name="anotacion_posterior" id="anotacion_posterior" value="{{ $valores_antiguos['anotacion_posterior'] or '' }}"></td>
            @elseif($action===2)
                <td><input type="text" name="anotacion_posterior" id="anotacion_posterior" value="{{ $tarea->anotacion_posterior or '' }}"></td>
            @endif
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="Enviar"></td>
        </tr>
    </table>
</form>

@include('General.pie')

