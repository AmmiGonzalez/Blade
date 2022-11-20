@extends('layouts.app')

@section('content')
<div class="dashboardShowItem">
  <div class="container card text-center">
    <div class="mt-3">
      <h1><i class="fa-solid fa-shapes"></i></h1>
    </div>
    <div class="my-3">
      <h4>Categoría</h4>
      <h5><b>{{$categoria->Nombre}}</b></h5>
    </div>
    <div class="my-3">
      <h5>Descripcion</h5>
      <h6><b>{{$categoria->Descripcion}}</b></h6>
    </div>
  </div>
</div>
@endsection