@extends('layouts.app')

@section('content')
<div class="reportesContainer">
  <div class="title mt-4 mx-5">
    <h4><b>Facturas:</b></h4>
  </div>
  @if (count($facturas) >= 1)
    <div class="cart m-5">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Nombre del cliente</th>
            <th class="descripcion" scope="col">Direccion de envio</th>
            <th scope="col">Telefono</th>
            <th scope="col">Fecha de compra</th>
            <th scope="col">Última actualización</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($facturas as $factura)
            <tr>
              <td>{{$factura->NombreCompleto}}</td>
              <td class="descripcion">{{$factura->DireccionEnvio}}</td>
              <td>{{$factura->Telefono}}</td>
              <td>{{$factura->FechaCompra}}</td>
              <td>{{$factura->updated_at}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    @else
    <div class="container d-flex align-items-center justify-content-center w-100 mt-5">
      <div class="card">
        <b class="text-red my-3 mx-5">No se han registrado ventas</b>
      </div>
    </div>
  @endif

</div>
@endsection