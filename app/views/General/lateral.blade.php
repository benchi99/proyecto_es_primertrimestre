<style>
    @import url(@relative("assets/css/estilo_panel_lateral.css"))
</style>

<div class="listgroup text-center col-2 sidemenu border border-disabled rounded">
    <h3 class="pt-1">Ir a</h3>
    <a href="@relative('app/')" class="list-group-item list-group-item-action">Tareas</a>
    @if($rol_actual === 1)
    <a href="@relative('app/?a=11')" class="list-group-item list-group-item-action">Usuarios</a>
    @endif
    <a href="@relative('app/?a=8')" class="list-group-item list-group-item-action">Editar mi cuenta</a>
</div>