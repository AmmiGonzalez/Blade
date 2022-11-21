@extends('layouts.app')

@section('content')
<div class="dashboardShowItem">
  <div class="container card text-center">
    <div class="mt-3">
      <h1><i class="fa-solid fa-user-astronaut"></i></h1>
    </div>
    <div class="my-3">
      <h4>Nombre</h4>
      <h5><b>{{$usuario->username}}</b></h5>
    </div>
    <div class="my-3">
      <h5>Email</h5>
      <h6><b>{{$usuario->email}}</b></h6>
    </div>
    <div class="my-3">
        <h5>Rol</h5>
        <h6><b>{{$roles}}</b></h6>
    </div>
  </div>
</div>
@endsection