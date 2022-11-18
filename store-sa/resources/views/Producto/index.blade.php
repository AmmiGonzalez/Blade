@extends('layouts.app')

@section('content')
<div class="productsList d-flex flex-column">
  <div class="container">
    <h3><b>Todos nuestros productos</b></h3>
  </div>
  <div class="row justify-content-center">
    @foreach ($productos as $producto)
      <div class="col-md-2 mt-3 mx-3 card" style="width: 18rem;">
        <a href="/productos/{{$producto->id}}">
          <div class="img-container">
            <img src="{{asset('storage/'.$producto->PathImagen)}}" class="card-img-top">
          </div>
          <div class="card-body">
            <h5 class="card-title"><b>{{$producto->Nombre}}</b></h5>
            <p class="card-text"> {{$producto->Descripcion}} </p>
          </div>
        </a>
        <div class="product-footer mt-auto d-flex flex-row align-items-center justify-content-start">
          <h5 class="card-title"><b>Q{{$producto->Precio}}</b></h5>
          @guest
            @if(Route::has('login'))
            @endif
            @else
              @if (Auth::user()->IDRol >= 2)
                <button onclick="window.location='{{ route('editar.producto', $producto) }}'" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></button>
                <button data-product-nombre="{{$producto->Nombre}}" data-product-id="{{$producto->id}}" class="btn btn-danger delete" data-bs-toggle="modal" data-bs-target="#deleteProduct"><i class="fa-solid fa-trash-can"></i></button>
                <button onclick="window.location='{{ route('agregarExistencia.producto', $producto) }}'" class="btn btn-info" ><i class="fa-solid fa-plus"></i></button>
              @endif
          @endguest
        </div>
      </div>
    @endforeach
  </div>
  <div class="modal fade" id="deleteProduct" tabindex="-1" aria-labelledby="deleteProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="deleteProductLabel">Eliminar el producto</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body d-flex flex-column align-items-center justify-content-center">
          <i class="fa-solid fa-box mr mb-3"></i>
          <h4>¿Está seguro de eliminar el producto?</h4>
          <h4><b class="text-red" id="modalProductName"></b></h4>
        </div>
        <div class="modal-footer">
          <button id="btnDelete" type="button" class="btn btn-danger">Eliminar</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cerrar</button>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="paginationContainer">
  {!! $productos->links() !!}
</div>
<script>
  let selectedProduct;
  $('.delete').on('click', function() {
    selectedProduct = $(this).data("product-id");
    $("#modalProductName").text($(this).data("product-nombre"));
    console.log("HOLA BOTON: " + selectedProduct);
  });

  $('#btnDelete').on('click', function() {
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "/productos/eliminar/" + selectedProduct,
      type: 'delete',
      success: function (response) {
        window.location.reload();
      }

    })
  });

</script>
@endsection