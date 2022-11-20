@extends('layouts.app')

@section('content')
<div class="contentList d-flex flex-column">
  <div class="container">
    <h3><b>Todas las categorías</b></h3>
  </div>
  <div class="row justify-content-center">
    @foreach ($categorias as $categoria)
      <div class="col-md-2 mt-3 mx-3 card" style="width: 18rem;">
        <a href="/categorias/{{$categoria->id}}">
          <div class="img-container">
            <i class="fa-solid fa-shapes"></i>
          </div>
          <div class="card-body">
            <h5 class="card-title"><b>{{$categoria->Nombre}}</b></h5>
            <p class="card-text"> {{$categoria->Descripcion}} </p>
          </div>
        </a>
        <div class="content-footer mt-auto d-flex flex-row align-items-center justify-content-start">
          <button onclick="window.location='{{ route('editar.categoria', $categoria) }}'" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></button>
          <button data-nombre="{{$categoria->Nombre}}" data-id="{{$categoria->id}}" class="btn btn-danger delete" data-bs-toggle="modal" data-bs-target="#dashboardModal"><i class="fa-solid fa-trash-can"></i></button>
        </div>
      </div>
    @endforeach
  </div>
  <div class="modal fade" id="dashboardModal" tabindex="-1" aria-labelledby="dashboardModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="dashboardModalLabel">Eliminar la categoría</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body d-flex flex-column align-items-center justify-content-center">
          <i class="fa-solid fa-shapes mr mb-3"></i>
          <h4>¿Está seguro de eliminar la categoría?</h4>
          <h4><b class="text-red" id="modalItemName"></b></h4>
        </div>
        <div class="modal-footer">
          <button id="btnDelete" type="button" class="btn btn-danger">Eliminar</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cerrar</button>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  let selectedProduct;
  $('.delete').on('click', function() {
    selectedProduct = $(this).data("id");
    $("#modalItemName").text($(this).data("nombre"));
  });

  $('#btnDelete').on('click', function() {
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "/categorias/eliminar/" + selectedProduct,
      type: 'delete',
      success: function (response) {
        window.location.reload();
      }
    })
  });

</script>
@endsection