@extends('layouts.app')

@section('content')
<div style="margin-left: 10px; margin-right:10px">
    {{print_r($currentUserInfo)}}
    <button onclick="findMe()" type="button" class="btn btn-primary btn-lg">Obtener ubicación actual</button>
    <div id="map"></div>	
    <script>
        function findMe(){
            var output = document.getElementById('map');
            // Verificar si soporta geolocalizacion
            if (navigator.geolocation) {
                output.innerHTML = "<p>Tu navegador soporta Geolocalizacion</p>";
            }else{
                output.innerHTML = "<p>Tu navegador no soporta Geolocalizacion</p>";
            }
            //Obtenemos latitud y longitud
            function localizacion(posicion){

                var latitude = posicion.coords.latitude;
                var longitude = posicion.coords.longitude;
            }

            function error(){
                output.innerHTML = "<p>No se pudo obtener tu ubicación</p>";
            }
            navigator.geolocation.getCurrentPosition(localizacion,error);
        }
    </script>
    <br> 
    <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Departamento</th>
            <th scope="col">Dirección</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
            </tr>
            <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>Thornton</td>
            <td>@fat</td>
            </tr>
            <tr>
            <th scope="row">3</th>
            <td colspan="2">Larry the Bird</td>
            <td>@twitter</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection