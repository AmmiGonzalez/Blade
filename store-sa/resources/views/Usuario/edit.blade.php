@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-center">
                    <i class="fa-solid fa-user-astronaut mx-2"></i>
                    {{ __('Editar usuario') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('actualizar.usuario', $usuario) }}" enctype="multipart/form-data">
                        @method("PUT")
                        @csrf
                        <div class="row mb-3">
                            <div class="input-label col-md-4 col-form-label text-md-end">
                                <i class="fa-solid fa-hashtag"></i>
                                <label for="username">{{ __('Nombre de usuario') }}</label>
                            </div>
                        
                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username', $usuario->username) }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>El nombre debe tener al menos 5 dígitos</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="input-label col-md-4 col-form-label text-md-end">
                                <i class="fa-solid fa-font"></i>
                                <label for="email">{{ __('Email') }}</label>
                            </div>
                        
                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $usuario->email) }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>El email debe tener al menos 5 carácteres</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="input-label col-md-4 col-form-label text-md-end">
                                <i class="fa-solid fa-font"></i>
                                <label for="password">{{ __('Contraseña') }}</label>
                            </div>
                        
                            <div class="col-md-6">
                                <input id="password" type="text" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password" autofocus>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>La contraseña debe tener al menos 5 carácteres</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="input-label col-md-4 col-form-label text-md-end">
                                <i class="fa-solid fa-clipboard-list"></i>
                                <label for="IDRol">{{ __('Roles') }}</label>
                            </div>
                        
                            <div class="col-md-6">
                                {{-- <input id="Marca" type="Marca" class="form-control @error('Marca') is-invalid @enderror" name="Marca" value="{{ old('Marca') }}" required autocomplete="Marca" autofocus> --}}
                                <select id="IDRol" name="IDRol" class="form-select">
                                    @foreach ($roles as $rolUsuario)
                                        <option value="{{$rolUsuario->id}}">{{$rolUsuario->Nombre}}</option>
                                    @endforeach
                                </select>
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