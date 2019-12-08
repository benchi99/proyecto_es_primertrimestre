<style>
    @import url(@relative("assets/css/estilo_panel_lateral.css"))
</style>

<div class="listgroup text-center col-2 sidemenu border border-disabled rounded">
    <h3 class="pt-1">Ir a</h3>
    <a href="" class="list-group-item list-group-item-action">Tareas</a>
    @if($rol_actual === 1)
    <a href="" class="list-group-item list-group-item-action">Usuarios</a>
    @endif
</div>