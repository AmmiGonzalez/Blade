@extends('layouts.app')

@section('content')
<div class="container w-100">
  <div class="container w-100 d-flex align-items-center justify-content-start">
    <h3><b>Clientes que más consumen en la tienda</b></h3>
  </div>
  @foreach ($clientes as $index => $cliente)
    <div class="card px-5 py-3 mt-5">
      
      <h3 class="mb-4"><b>{{$index + 1}}.</b> {{$cliente->NombreCompleto}}</h3>
      <h5>Total de compras: <b>{{$cliente->Compras}}</b></h5>
      <h5>Gasto total: <b>Q{{$cliente->TotalComprado}}</b></h5>
    </div>
  @endforeach
</div>
@endsection