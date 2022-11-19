@php
  $total = 0;
@endphp
@extends('layouts.app')

@section('content')
<div class="carritoContainer">
  <div class="title mt-4 mx-5">
    <h2><b>Carrito de compras: </b></h2>
  </div>
  <div class="cart m-5">
    @if (count($carrito) >= 1)
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col"></th>
            <th scope="col">Miniatura</th>
            <th scope="col">Nombre</th>
            <th class="descripcion" scope="col">Descripción</th>
            <th scope="col">Precio</th>
            <th scope="col">SubTotal</th>
            <th scope="col">Cantidad</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($carrito as $item)
            {{-- {{print_r($item)}} --}}
            <tr>
              <form action="{{route('eliminarItem.carrito', $loop->index)}}" method="POST">
                @csrf
                @method('DELETE')
                <td class="remove"><button type="submit" class="btn btn-danger"><i class="fa-solid fa-x"></i></button></td>
              </form>
              <td><img src="/storage/{{$item['PathImagen']}}"></td>
              <td>{{$item['Nombre']}}</td>
              <td class="descripcion">{{$item['Descripcion']}}</td>
              <td>Q{{$item['Precio']}}</td>
              <td>Q{{intval($item['NoProductos']) * intval($item['Precio'])}}</td>
              <td>
                <div class="cantidad d-flex flex-row align-items-center justify-content-center">
                  <p class="form-control w-auto">{{$item['NoProductos']}}</p>
                </div>
              </td>
            </tr>
            @php
              $total += intval($item['NoProductos']) * intval($item['Precio']);
            @endphp
          @endforeach
          <tr class="total">
            <td></td>
            <td></td>
            <td></td>
            <td class="descripcion"></td>
            <td><b>Total:</b></td>
            <td><b>Q{{$total}}</b></td>
            <td></td>
          </tr>
        </tbody>
      </table>
      <div class="options card">
        @if (session("status"))
          <div class="d-flex flex-row align-items-center justify-content-center w-100 mt-3">
            <small class="bg-warning bg-opacity-50 px-3 py-2 rounded">{{session('status')}}</small>
          </div>
        @endif
        <div class="card-body w-100 d-flex flex-row align-items-center justify-content-center">
          <form action="{{route('vaciar.carrito')}}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-secondary mr"> <i class="fa-solid fa-broom"></i> Limpiar carrito </button>
          </form>
          <a href="{{route('confirmar.carrito')}}" class="btn btn-primary"> <i class="fa-solid fa-money-bill"></i> Pagar </a>
        </div>
      </div>
    @else
      <div class="container d-flex align-items-center justify-content-center text-center my-5">
        <h4><b>¡No hay elementos en el carrito!</b></h4>
      </div>
    @endif
  </div>
</div>
@endsection