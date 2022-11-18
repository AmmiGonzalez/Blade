@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-center">
                    <i class="fa-solid fa-box mx-2"></i>
                    {{ __('Agregar existencias a sucursal') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('guardarExistencia.producto') }}">
                        @csrf

                        <div class="row mb-3">
                            <div class="input-label col-md-4 col-form-label text-md-end"> <i class="fa-solid fa-hashtag"></i> <label for="Existencia">{{ __('No. Serie') }}</label> </div>
                            <div class="col-md-6"> <input  class="form-control" value="{{$producto->NoSerie}}" readonly> </div>
                        </div>

                        <div class="row mb-3">
                            <div class="input-label col-md-4 col-form-label text-md-end"> <i class="fa-solid fa-font"></i> <label for="Existencia">{{ __('Nombre del producto') }}</label> </div>
                            <div class="col-md-6"> <input  class="form-control" value="{{$producto->Nombre}}" readonly> </div>
                        </div>

                        <div class="row mb-3">
                            <div class="input-label col-md-4 col-form-label text-md-end">
                                <i class="fa-solid fa-list-ol"></i>
                                <label for="Existencia">{{ __('Existencia') }}</label>
                            </div>
                        
                            <div class="col-md-6">
                                <input id="Existencia" type="number" class="form-control @error('Existencia') is-invalid @enderror" name="Existencia" required autocomplete="Existencia" autofocus>
                                <input id="IDProducto" name="IDProducto" hidden class="d-none" value="{{$producto->id}}">

                                @error('Existencia')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>La existencia debe ser mayor a 0</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="input-label col-md-4 col-form-label text-md-end">
                                <i class="fa-solid fa-store"></i>
                                <label for="IDSucursal">{{ __('Sucursal') }}</label>
                            </div>
                        
                            <div class="col-md-6">
                                {{-- <input id="Marca" type="Marca" class="form-control @error('Marca') is-invalid @enderror" name="Marca" value="{{ old('Marca') }}" required autocomplete="Marca" autofocus> --}}
                                <select id="IDSucursal" name="IDSucursal" class="form-select">
                                    @foreach ($sucursales as $sucursal)
                                        <option value="{{$sucursal->id}}">{{$sucursal->Nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                          <div class="input-label col-md-4 col-form-label text-md-end"> <i class="fa-solid fa-image"></i> <label for="ImagenActual">{{ __('Imagen') }}</label> </div>
                          <div class="col-md-6">
                            <div class="d-flex flex-col algin-items-center justify-content-center col-md-6">
                              <img class="miniature" src="{{asset('storage/'.$producto->PathImagen)}}"/>
                            </div>
                          </div>
                      </div>

                        @if (session("status"))
                            <div class="row my-4">
                                <div class="col-md-8 offset-5">
                                    <small class="bg-success bg-opacity-50 px-3 py-2 rounded">{{session('status')}}</small>
                                </div>
                            </div>
                        @endif
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-6">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('agregar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
