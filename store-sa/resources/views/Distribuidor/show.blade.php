@extends('layouts.app')

@section('content')
<div class="dashboardShowItem">
  <div class="container card text-center">
    <div class="mt-3">
      <h1><i class="fa-solid fa-truck"></i></h1>
    </div>
    <div class="my-3">
      <h4>Nombre</h4>
      <h5><b>{{$distribuidor->Nombre}}</b></h5>
    </div>
    <div class="my-3">
        <h4>Dirección</h4>
        <h5><b>{{$distribuidor->Direccion}}</b></h5>
    </div>
    <div class="my-3">
      <h5>Email</h5>
      <h6><b>{{$distribuidor->Email}}</b></h6>
    </div>
    <div class="my-3">
        <h5>Teléfono</h5>
        <h6><b>{{$distribuidor->Telefono}}</b></h6>
      </div>
  </div>
</div>
@endsection