@extends('layouts.app')

@section('content')
<div class="dashboardShowItem">
  <div class="container card text-center">
    <div class="mt-3">
      <h1><i class="fa-solid fa-shop"></i></h1>
    </div>
    <div class="my-3">
      <h4>Dirección</h4>
      <h5><b>{{$sucursal->Direccion}}</b></h5>
    </div>
    <div class="my-3">
      <h5>Nombre</h5>
      <h6><b>{{$sucursal->Nombre}}</b></h6>
    </div>
    <div class="my-3">
        <h5>Ubicación</h5>
        <h6><b>{{$sucursal->Ubicacion}}</b></h6>
    </div>
    <div class="my-3">
        <h5>Municipio</h5>
        <h6><b>{{$municipio}}</b></h6>
    </div>
  </div>
</div>
@endsection