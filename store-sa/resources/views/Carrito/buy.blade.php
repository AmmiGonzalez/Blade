@extends('layouts.app')

@section('content')
<div class="buyContainer">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-basket-shopping mx-2"></i>
            {{ __('comprar') }}
          </div>

          <div class="card-body">
            <form method="POST" action="{{ route('realizarCompra.carrito') }}">
              @csrf

              <div class="row mb-3">
                <div class="input-label col-md-4 col-form-label text-md-end">
                  <i class="fa-solid fa-credit-card"></i>
                  <label for="Tarjeta">{{ __('Tarjeta de débito/crédito') }}</label>
                </div>
            
                <div class="col-md-6">
                  <input id="Tarjeta" name="Tarjeta" type="text" class="form-control @error('Tarjeta') is-invalid @enderror" value="{{ old('Tarjeta') }}" required autocomplete="Tarjeta" autofocus>

                  @error('Tarjeta')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{$message}}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <div class="input-label col-md-4 col-form-label text-md-end">
                  <i class="fa-solid fa-calendar-day"></i>
                  <label for="Expiracion">{{ __('Fecha exp') }}</label>
                </div>
            
                <div class="col-md-6">
                  <input id="Expiracion" name="Expiracion" type="date" class="form-control @error('Expiracion') is-invalid @enderror" value="{{ old('Expiracion') }}" required autocomplete="Expiracion" autofocus>

                  @error('Expiracion')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{$message}}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <div class="input-label col-md-4 col-form-label text-md-end">
                  <i class="fa-solid fa-xmarks-lines"></i>
                  <label for="Codigo">{{ __('Codigo de seguridad') }}</label>
                </div>
            
                <div class="col-md-6">
                  <input id="Codigo" name="Codigo" type="number" min="100" max='999' class="form-control @error('Codigo') is-invalid @enderror" value="{{ old('Codigo') }}" required autocomplete="Codigo" autofocus>

                  @error('Codigo')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{$message}}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <div class="input-label col-md-4 col-form-label text-md-end">
                  <i class="fa-solid fa-font"></i>
                  <label for="NombreCompleto">{{ __('Nombre completo') }}</label>
                </div>
            
                <div class="col-md-6">
                  <input id="FechaCompra" name="FechaCompra" value="{{ $fecha }}" hidden class="d-none">
                  <input id="Total" name="Total" value="{{ $total }}" hidden class="d-none">
                  <input id="NombreCompleto" type="text" class="form-control @error('NombreCompleto') is-invalid @enderror" name="NombreCompleto" value="{{ old('NombreCompleto') }}" required autocomplete="NombreCompleto" autofocus>

                  @error('NombreCompleto')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{$message}}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <div class="input-label col-md-4 col-form-label text-md-end">
                  <i class="fa-solid fa-sign-hanging"></i>
                  <label for="DireccionEnvio">{{ __('Dirección') }}</label>
                </div>
            
                <div class="col-md-6">
                  <input id="DireccionEnvio" type="text" class="form-control @error('DireccionEnvio') is-invalid @enderror" name="DireccionEnvio" value="{{ old('DireccionEnvio') }}" required autocomplete="DireccionEnvio" autofocus>

                  @error('DireccionEnvio')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{$message}}</strong>
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
                  <input id="Telefono" type="number" class="form-control @error('Telefono') is-invalid @enderror" name="Telefono" value="{{ old('Telefono') }}" required autocomplete="Telefono" autofocus>

                  @error('Telefono')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{$message}}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <div class="input-label col-md-4 col-form-label text-md-end">
                  <i class="fa-solid fa-hashtag"></i>
                  <label for="NIT">{{ __('NIT') }}</label>
                </div>
            
                <div class="col-md-6">
                  <input id="NIT" type="number" class="form-control @error('NIT') is-invalid @enderror" name="NIT" value="{{ old('NIT') }}" autocomplete="NIT" autofocus>

                  @error('NIT')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{$message}}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              
              <div class="row mb-3">
                <div class="input-label col-md-4 col-form-label text-md-end">
                  <i class="fa-solid fa-truck"></i>
                  <label for="IDTipoEnvio">{{ __('Tipo de envio') }}</label>
                </div>
              
                <div class="col-md-6">
                  {{-- <input id="Marca" type="Marca" class="form-control @error('Marca') is-invalid @enderror" name="Marca" value="{{ old('Marca') }}" required autocomplete="Marca" autofocus> --}}
                  <select id="IDTipoEnvio" name="IDTipoEnvio" class="form-select">
                    @foreach ($tiposDeEnvio as $tipoDeEnvio)
                      <option value="{{$tipoDeEnvio->id}}">{{$tipoDeEnvio->Nombre}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="row mb-3">
                <div class="input-label col-md-4 col-form-label text-md-end">
                  <i class="fa-solid fa-map-location-dot"></i>
                  <label for="IDDepartamento">{{ __('Departamento') }}</label>
                </div>
              
                <div class="col-md-6">
                  {{-- <input id="Marca" type="Marca" class="form-control @error('Marca') is-invalid @enderror" name="Marca" value="{{ old('Marca') }}" required autocomplete="Marca" autofocus> --}}
                  <select id="IDDepartamento" name="IDDepartamento" class="form-select">
                    @foreach ($departamentos as $departamento)
                      <option value="{{$departamento->id}}">{{$departamento->Nombre}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              
              @if (session("error"))
              <div class="d-flex flex-row align-items-center justify-content-center text-center mx-5 my-4">
                <small class="bg-danger bg-opacity-50 px-3 py-2 rounded">{{session('error')}}</small>
              </div>
              @endif

              <div class="d-flex flex-column align-items-center justify-content-center mt-4 mb-0">
                <button type="submit" class="btn btn-primary">
                  {{ __('confirmar compra') }}
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection