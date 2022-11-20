@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-center">
                    <i class="fa-solid fa-box mx-2"></i>
                    {{ __('Editar categoria') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('actualizar.categoria', $categoria) }}" enctype="multipart/form-data">
                        @method("PUT")
                        @csrf
                        <div class="row mb-3">
                            <div class="input-label col-md-4 col-form-label text-md-end">
                                <i class="fa-solid fa-hashtag"></i>
                                <label for="Nombre">{{ __('Nombre') }}</label>
                            </div>
                        
                            <div class="col-md-6">
                                <input id="Nombre" type="text" class="form-control @error('Nombre') is-invalid @enderror" name="Nombre" value="{{ old('Nombre', $categoria->Nombre) }}" required autocomplete="Nombre" autofocus>

                                @error('Nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>El nombre debe tener al menos 5 dígitos</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="input-label col-md-4 col-form-label text-md-end">
                                <i class="fa-solid fa-font"></i>
                                <label for="Descripcion">{{ __('Descripcion') }}</label>
                            </div>
                        
                            <div class="col-md-6">
                                <input id="Descripcion" type="text" class="form-control @error('Descripcion') is-invalid @enderror" name="Descripcion" value="{{ old('Descripcion', $categoria->Descripcion) }}" required autocomplete="Descripcion" autofocus>

                                @error('Descripcion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>La descripción debe tener al menos 5 dígitos</strong>
                                    </span>
                                @enderror
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
                                    {{ __('Editar') }}
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