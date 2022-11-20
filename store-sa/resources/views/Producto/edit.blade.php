@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-center">
                    <i class="fa-solid fa-box mx-2"></i>
                    {{ __('Editar producto') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('actualizar.producto', $producto) }}" enctype="multipart/form-data">
                        @method("PUT")
                        @csrf

                        <div class="row mb-3">
                            <div class="input-label col-md-4 col-form-label text-md-end">
                                <i class="fa-solid fa-hashtag"></i>
                                <label for="NoSerie">{{ __('Número de serie') }}</label>
                            </div>
                        
                            <div class="col-md-6">
                                <input id="NoSerie" type="text" class="form-control @error('NoSerie') is-invalid @enderror" name="NoSerie" value="{{ old('NoSerie', $producto->NoSerie) }}" required autocomplete="NoSerie" autofocus>

                                @error('NoSerie')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>El número de serie debe tener al menos 5 dígitos</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="input-label col-md-4 col-form-label text-md-end">
                                <i class="fa-solid fa-font"></i>
                                <label for="Nombre">{{ __('Nombre') }}</label>
                            </div>
                        
                            <div class="col-md-6">
                                <input id="Nombre" type="text" class="form-control @error('Nombre') is-invalid @enderror" name="Nombre" value="{{ old('Nombre', $producto->Nombre) }}" required autocomplete="Nombre" autofocus>

                                @error('Nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>El producto debe tener al menos 5 carácteres</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="input-label col-md-4 col-form-label text-md-end">
                                <i class="fa-solid fa-quote-left"></i>
                                <label for="Descripcion">{{ __('Descripción') }}</label>
                            </div>
                        
                            <div class="col-md-6">
                                <textarea id="Descripcion" rows="3" class="form-control @error('Descripcion') is-invalid @enderror" name="Descripcion" required autocomplete="Descripcion" autofocus>{{ old('Descripcion', $producto->Descripcion) }}</textarea>

                                @error('Descripcion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="input-label col-md-4 col-form-label text-md-end">
                                <i class="fa-solid fa-receipt"></i>
                                <label for="Caracteristicas">{{ __('Características') }}</label>
                            </div>
                        
                            <div class="col-md-6">
                                <textarea id="Caracteristicas" rows="4" class="form-control @error('Caracteristicas') is-invalid @enderror" name="Caracteristicas" required autocomplete="Caracteristicas" autofocus>{{ old('Caracteristicas', $producto->Caracteristicas) }}</textarea>

                                @error('Caracteristicas')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="input-label col-md-4 col-form-label text-md-end">
                                <i class="fa-solid fa-hand-holding-dollar"></i>
                                <label for="Precio">{{ __('Precio') }}</label>
                            </div>
                        
                            <div class="col-md-6">
                                <input id="Precio" type="number" class="form-control @error('Precio') is-invalid @enderror" name="Precio" value="{{ old('Precio', $producto->Precio) }}" required autocomplete="Precio" autofocus>

                                @error('Precio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="input-label col-md-4 col-form-label text-md-end">
                                <i class="fa-solid fa-percent"></i>
                                <label for="Descuento">{{ __('Descuento') }}</label>
                            </div>
                        
                            <div class="col-md-6">
                                <input id="Descuento" min="0" type="number" class="form-control @error('Descuento') is-invalid @enderror" name="Descuento" value="{{ old('Descuento', $producto->Descuento) }}" required autocomplete="Descuento" autofocus>

                                @error('Descuento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="input-label col-md-4 col-form-label text-md-end">
                                <i class="fa-solid fa-copyright"></i>
                                <label for="IDMarca">{{ __('Marca') }}</label>
                            </div>
                        
                            <div class="col-md-6">
                                {{-- <input id="Marca" type="Marca" class="form-control @error('Marca') is-invalid @enderror" name="Marca" value="{{ old('Marca') }}" required autocomplete="Marca" autofocus> --}}
                                <select id="IDMarca" name="IDMarca" class="form-select">
                                    @foreach ($marcas as $marca)
                                        <option @if ($marca->id == $producto->IDMarca)
                                            selected="selected"
                                        @endif value="{{$marca->id}}">{{$marca->Nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="input-label col-md-4 col-form-label text-md-end">
                                <i class="fa-solid fa-clipboard-list"></i>
                                <label for="IDCategoria">{{ __('Categorías') }}</label>
                            </div>
                        
                            <div class="col-md-6">
                                {{-- <input id="Marca" type="Marca" class="form-control @error('Marca') is-invalid @enderror" name="Marca" value="{{ old('Marca') }}" required autocomplete="Marca" autofocus> --}}
                                <select id="IDCategoria" name="IDCategoria" class="form-select">
                                    @foreach ($categorias as $categoria)
                                        <option @if ($categoria->id == $producto->IDCategoria)
                                          selected="selected"
                                        @endif value="{{$categoria->id}}">{{$categoria->Nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="input-label col-md-4 col-form-label text-md-end">
                                <i class="fa-solid fa-image"></i>
                                <label for="PathImagen">{{ __('Imagen del producto') }}</label>
                            </div>
                        
                            <div class="col-md-6">
                                <input id="PathImagen" type="file" class="form-control @error('PathImagen') is-invalid @enderror" name="PathImagen" value="{{ old('PathImagen') }}" autocomplete="PathImagen" autofocus accept=".png, .jpg, .jpeg">

                                @error('PathImagen')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                          <div class="input-label col-md-4 col-form-label text-md-end">
                            <i class="fa-solid fa-image"></i>
                            <label for="PathImagen">{{ __('Imagen actual') }}</label>
                          </div>
                          
                          <div class="d-flex flex-col algin-items-center justify-content-center col-md-6">
                            <img class="miniature" src="{{asset('storage/'.$producto->PathImagen)}}"/>
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
