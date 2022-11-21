@extends('layouts.app')

@section('content')
<div class="reportesContainer">
  <div class="title mt-4 mx-5">
    <h4><b>Productos más vendidos por mes:</b> {{$nombresMeses[$mesIndex - 1]}}</h4>
  </div>
  <div class="container w-100 d-flex flex-row align-items-center justify-content-center mt-5">
    <select id="selectMes" class="form-select w-auto mr">
      @foreach ($nombresMeses as $index => $nombreMes)
        <option
        @if ($mesIndex == ($index + 1))
            selected
        @endif
        value="{{$index + 1}}">{{$nombreMes}}</option>  
      @endforeach
    </select>
    <button id="genReport" class="btn btn-primary">
      <i class="fa-solid fa-shop"></i>
      generar reporte
    </button>
    <script>
      $("#genReport").on('click', function() {
        window.location.href = '/reportes/masVendidosMes?mes=' + $("#selectMes option:selected").val();
      });
    </script>
  </div>
  @if (count($productos) >= 1)
    <div class="cart m-5">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Miniatura</th>
            <th scope="col">Nombre</th>
            <th class="descripcion" scope="col">Descripción</th>
            <th scope="col">Cantidad</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($productos as $producto)
            <tr>
              <td><img src="/storage/{{$producto['PathImagen']}}"></td>
              <td>{{$producto['Nombre']}}</td>
              <td class="descripcion">{{$producto['Descripcion']}}</td>
              <td>
                <div class="cantidad d-flex flex-row align-items-center justify-content-center">
                  <p class="form-control w-auto">{{$producto['Cantidad']}}</p>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    @else
    <div class="container d-flex align-items-center justify-content-center w-100 mt-5">
      <div class="card">
        <b class="text-red my-3 mx-5">No hay productos vendidos en el mes seleccionado</b>
      </div>
    </div>
  @endif

</div>
@endsection