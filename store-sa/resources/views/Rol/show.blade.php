@extends('layouts.app')

@section('content')
<div class="dashboardShowItem">
  <div class="container card text-center">
    <div class="mt-3">
      <h1><i class="fa-solid fa-hammer"></i></h1>
    </div>
    <div class="my-3">
      <h4>Nombre</h4>
      <h5><b>{{$rolUsuario->Nombre}}</b></h5>
    </div>
  </div>
</div>
@endsection