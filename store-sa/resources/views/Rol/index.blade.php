@extends('layouts.app')

@section('content')
<div class="contentList d-flex flex-column">
  <div class="container">
    <h3><b>Todos los roles</b></h3>
  </div>
  <div class="row justify-content-center">
    @foreach ($roles as $rol) {{-- De donde saca la variable foreach --}}
      <div class="col-md-2 mt-3 mx-3 card" style="width: 18rem;">
        <a href="/categorias/{{$rol->id}}">
          <div class="img-container">
            <i class="fa-solid fa-hammer"></i>
          </div>
          <div class="card-body">
            <h5 class="card-title"><b>{{$rolUsuario->Nombre}}</b></h5>
          </div>
        </a>
        <div class="content-footer mt-auto d-flex flex-row align-items-center justify-content-start">
          <button onclick="window.location='{{ route('editar.rol', $rol) }}'" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></button>
          <button data-nombre="{{$rol->Nombre}}" data-id="{{$rol->id}}" class="btn btn-danger delete" data-bs-toggle="modal" data-bs-target="#dashboardModal"><i class="fa-solid fa-trash-can"></i></button>
        </div>
      </div>
    @endforeach
  </div>
  <div class="modal fade" id="dashboardModal" tabindex="-1" aria-labelledby="dashboardModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="dashboardModalLabel">Eliminar el rol</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body d-flex flex-column align-items-center justify-content-center">
          <i class="fa-solid fa-shapes mr mb-3"></i>
          <h4>¿Está seguro de eliminar el rol?</h4>
          <h4><b class="text-red" id="modalItemName"></b></h4>
        </div>
        <div class="modal-footer">
          <button id="btnDelete" type="button" class="btn btn-danger">Eliminar</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
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
      url: "/roles/eliminar/" + selectedProduct,
      type: 'delete',
      success: function (response) {
        window.location.reload();
      }
    })
  });

</script>
@endsection