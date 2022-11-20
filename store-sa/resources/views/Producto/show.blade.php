@extends('layouts.app')

@section('content')
<div class="showProduct row justify-content-center">
  <form class="col-md-8" method="POST" action="{{ route('agregarProducto.producto', $producto) }}">
    @csrf
    <div class="card">
      <div class="infoBody row card-body">
        <div class="imgContainer d-flex align-items-center justify-content-center col-md">
          <img src="{{asset('storage/'.$producto->PathImagen)}}"/>
        </div>
        <div class="col-md">
          <div class="row">
            <h3>{{$producto->Nombre}}</h3>
          </div>
          <div class="row">
            <h5><small>Precio: </small><b>Q{{$producto->Precio}}</b></h5>
          </div>
          <div class="mt-4 row">
            <h5><b>Marca: </b>{{$marca->Nombre}}</h5>
          </div>
          <div class="mt-4 row">
            <h5>{{$producto->Descripcion}}</h5>
          </div>
          <div class="my-3 row">
            <b>Características: </b>
            <h5>{{$producto->Caracteristicas}}</h5>
          </div>
          @php
              $any = false;
              foreach($sucursales as $sucursal) if($sucursal->Existencia >= 1) $any = true;
          @endphp
          @if (count($sucursales) >= 1 && $any)
            <div class="mt-3 row"> <b>Seleccione la tienda: </b> </div>
            <div class="mt-2 row">
              <div class="col-8 offset-2">
                <select id="storeSelector" class="form-select" name="IDSucursal">
                  @foreach ($sucursales as $sucursal)
                    @if ($sucursal->Existencia >= 1)
                      <option value="{{$sucursal->IDSucursal}}">{{$sucursal->sucursal->Nombre}}: {{$sucursal->Existencia}}</option>
                    @endif
                  @endforeach
                </select>
              </div>
            </div>
          @else <b class="text-red"> sin existencia </b>
          @endif
          <div class="mt-3 row">
            <b>Cantidad:</b>
          </div>
          <div class="my-3 row">
            <div class="col-2"><button onclick="substractProduct()" type="button" class="btn btn-dark"><i class="fa-solid fa-minus"></i></button></div>
            <div class="col-2"><button onclick="addProduct()" type="button" class="btn btn-dark"><i class="fa-solid fa-plus"></i></button></div>
            <div class="col-4"><input id="productCounter" min="1" class="form-control" name="NoProductos" type="number" value="1"/></div>
          </div>

          @if (session("error"))
            <div class="row my-4">
              <div class="col-md-8 offset-2">
                <small class="bg-danger bg-opacity-50 px-3 py-2 rounded">{{session('error')}}</small>
              </div>
            </div>
          @endif
          @if (session("status"))
            <div class="row my-4">
              <div class="col-md-8 offset-2">
                <small class="bg-success bg-opacity-50 px-3 py-2 rounded">{{session('status')}}</small>
              </div>
            </div>
          @endif
        </div>
      </div>
      <div class="d-flex flex-row align-items-center justify-content-center card-footer py-4">
        @guest
          @if (Route::has('login'))
            <div class="col-4 text-center mx-5">
              <h5 class="text-red">Debe <b>registarse</b> para añadir prodcutos al carrito de compras</h5>
            </div>
          @endif
          @else
            @if (count($sucursales) >= 1 && $any)
              <button
                id="addToCart"
                type="submit"
                name="submitted"
                value="addToCart"
                class="btn btn-primary mr"
              ><i class="fa-solid fa-shopping-bag mr"></i>Añadir al carro</button>
            @endif
        @endguest
        <button name="submitted" value="addToQuotation" type="submit" class="btn btn-secondary"><i class="fa-solid fa-receipt mr"></i>Agregar a lista de cotización</button>
      </div>
    </div>
  </form>
</div>
<script>
  function addProduct() {
    let value = 0;
    value = parseInt(document.getElementById("productCounter").value);
    if(isNaN(value)) value = 0;
    document.getElementById("productCounter").value = value + 1;
  }
  function substractProduct() {
    let value = 0;
    value = parseInt(document.getElementById("productCounter").value);
    
    if(isNaN(value)) value = 2;
    if(value >= 2) document.getElementById("productCounter").value = value - 1;
  }
</script>
@endsection