@include('General.cabecera)

<h1 class="text-danger">¡Error!</h1>

<div class="alert alert-danger">
    <p>¡Se ha producido un error al procesar esa petición!</p>
    <p>A continuación, viene descrito el error producido:</p>
    <p>{{ $error }}</p>
</div>

@include('General.pie')