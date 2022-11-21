@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-center">
                    <i class="fa-solid fa-shop mx-2"></i>
                    {{ __('Editar sucursal') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('actualizar.sucursal', $sucursal) }}" enctype="multipart/form-data">
                        @method("PUT")
                        @csrf
                        <div class="row mb-3">
                            <div class="input-label col-md-4 col-form-label text-md-end">
                                <i class="fa-solid fa-sign-hanging"></i>
                                <label for="Direccion">{{ __('Dirección') }}</label>
                            </div>
                        
                            <div class="col-md-6">
                                <input id="Direccion" type="text" class="form-control @error('Direccion') is-invalid @enderror" name="Direccion" value="{{ old('Direccion', $sucursal->Direccion) }}" required autocomplete="Direccion" autofocus>

                                @error('Direccion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>La dirección debe tener al menos 5 dígitos</strong>
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
                                <input id="Nombre" type="text" class="form-control @error('Nombre') is-invalid @enderror" name="Nombre" value="{{ old('Nombre', $sucursal->Nombre) }}" required autocomplete="Nombre" autofocus>

                                @error('Nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>El nombre debe tener al menos 5 carácteres</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="input-label col-md-4 col-form-label text-md-end">
                                <i class="fa-solid fa-map-location-dot"></i>
                                <label for="IDMunicipio">{{ __('Municipios') }}</label>
                            </div>
                        
                            <div class="col-md-6">
                                {{-- <input id="Marca" type="Marca" class="form-control @error('Marca') is-invalid @enderror" name="Marca" value="{{ old('Marca') }}" required autocomplete="Marca" autofocus> --}}
                                <select id="IDMunicipio" name="IDMunicipio" class="form-select">
                                    @foreach ($municipios as $municipio)
                                        <option value="{{$municipio->id}}">{{$municipio->Nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="input-label col-md-4 col-form-label text-md-end">
                                <i class="fa-solid fa-hashtag"></i>
                                <label for="latitud">{{ __('Latitud') }}</label>
                            </div>
                        
                            <div class="col-md-6">
                                <input readonly id="latitud" type="text" class="form-control @error('latitud') is-invalid @enderror" name="latitud" value="{{ old('latitud', $latitud) }}" required autocomplete="latitud" autofocus>

                                @error('latitud')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>La dirección debe tener al menos 5 carácteres</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="input-label col-md-4 col-form-label text-md-end">
                                <i class="fa-solid fa-hashtag"></i>
                                <label for="longitud">{{ __('Longitud') }}</label>
                            </div>
                        
                            <div class="col-md-6">
                                <input readonly id="longitud" type="text" class="form-control @error('longitud') is-invalid @enderror" name="longitud" value="{{ old('longitud', $longitud) }}" required autocomplete="longitud" autofocus>

                                @error('longitud')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>La dirección debe tener al menos 5 carácteres</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div id="mapa" style="width: 100%; height:500px;"></div>
                            </div>
                        </div>
                        <script>
                            function iniciarMapa(){
                                var latitud={{$latitud}};
                                var longitud={{$longitud}};

                                coordenadas={
                                    lng: longitud,
                                    lat: latitud
                                }
                                generarMapa(coordenadas);
                            }
                            function generarMapa(coordenadas){
                                var mapa = new google.maps.Map(document.getElementById('mapa'),{
                                    zoom:12,
                                    center: new google.maps.LatLng(coordenadas.lat, coordenadas.lng)
                                });

                                marcador=new google.maps.Marker({
                                    map:mapa,
                                    draggable:true,
                                    position: new google.maps.LatLng(coordenadas.lat, coordenadas.lng)
                                });

                                marcador.addListener('dragend',function(event){
                                    document.getElementById("latitud").value=this.getPosition().lat();
                                    document.getElementById("longitud").value=this.getPosition().lng();
                                })
                            }
                        </script>
                        <script src="https://maps.googleapis.com/maps/api/js?key=&callback=iniciarMapa"></script>
                        
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