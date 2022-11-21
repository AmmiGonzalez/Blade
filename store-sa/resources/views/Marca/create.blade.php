@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-center">
                    <i class="fa-solid fa-registered mx-2"></i>
                    {{ __('Crear marca') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('guardar.marca') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <div class="input-label col-md-4 col-form-label text-md-end">
                                <i class="fa-solid fa-font"></i>
                                <label for="Nombre">{{ __('Nombre') }}</label>
                            </div>
                        
                            <div class="col-md-6">
                                <input id="Nombre" type="text" class="form-control @error('Nombre') is-invalid @enderror" name="Nombre" value="{{ old('Nombre', $marca->Nombre) }}" required autocomplete="Nombre" autofocus>

                                @error('Nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>El nombre debe tener al menos 5 carácteres</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="input-label col-md-4 col-form-label text-md-end">
                                <i class="fa-solid fa-envelope"></i>
                                <label for="Email">{{ __('Email') }}</label>
                            </div>
                        
                            <div class="col-md-6">
                                <input id="Email" type="text" class="form-control @error('Email') is-invalid @enderror" name="Email" value="{{ old('Email', $marca->Email) }}" required autocomplete="Email" autofocus>

                                @error('Email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>El formato de Email no es correcto</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="input-label col-md-4 col-form-label text-md-end">
                                <i class="fa-solid fa-mobile"></i>
                                <label for="Telefono">{{ __('Teléfono') }}</label>
                            </div>
                        
                            <div class="col-md-6">
                                <input id="Telefono" type="text" class="form-control @error('Telefono') is-invalid @enderror" name="Telefono" value="{{ old('Telefono', $marca->Telefono) }}" required autocomplete="Telefono" autofocus>

                                @error('Telefono')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>El teléfono debe tener 8 carácteres</strong>
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
                                    {{ __('Crear') }}
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