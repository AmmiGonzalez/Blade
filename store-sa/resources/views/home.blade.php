@extends('layouts.app')

@section('content')
<div class="home container">
    <header>
        <div class="imageContainer container-fluid d-flex flex-column align-items-center justify-content-center">
            <i class="fa-brands fa-shopify"></i>
        </div>
        <div class="container-fluid d-flex flex-column align-items-center justify-content-center text-center">
            <h2 class="mb-5"><b>Bienvenido a Store online S.A</b></h2>
            <h2>La mejor tienda en línea con gran variedad de productos tecnológicos</h2>
            @guest
                @if (Route::has('login'))
                    <div class="registerText">
                        <h4>Para poder realizar compras debe estár registrado en nuestra aplicación</h4>
                        <a href="/login" class="btn btn-primary mx-2 mt-4"><i class="fa-solid fa-right-to-bracket"></i> Iniciar sesión</a>
                        <a href="/register" class="btn btn-primary mx-2 mt-4"><i class="fa-solid fa-plus-square"></i> ¡Registrarse gratis!</a>
                    </div>
                @endif
                @else
                <div class="registeredText defult-bxshadow">
                    <h4 class="px-5">Puede añadir productos a su carrito de compras y acceder a ellos por medio del ícono</h4>
                    <i class="fa-solid fa-basket-shopping"></i>
                </div>
            @endguest
            <script>
                
                function getLocation() {
                  if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                  } else {
                    x.innerHTML = "Geolocation is not supported by this browser.";
                  }
                }
                
                function showPosition(position) {
                    @php
                        $res = json_encode($locations);
                        echo "var data = $res;\n"
                    @endphp
                    console.log(data);
                    let nombreSucursalCercana = "";
                    let distancias = [];
                    for(let coords of data)
                    {
                        distancias.push(calcCrow(
                                parseFloat(coords['lat']),
                                parseFloat(coords['lon']),
                                parseFloat(position.coords.latitude),
                                parseFloat(position.coords.longitude)
                            )
                        );
                        /*console.log("res: ", calcCrow(
                            parseFloat(coords['lat']),
                            parseFloat(coords['lon']),
                            parseFloat(position.coords.latitude),
                            parseFloat(position.coords.longitude),
                        ));*/
                    }
                    $("#textSucursalMasCercana").text(
                        "La sucursal más cercana es: " +
                        data[distancias.indexOf(Math.min.apply(Math, distancias))]['nombre']
                    )
                  /*x.innerHTML = "Latitude: " + position.coords.latitude +
                  "<br>Longitude: " + position.coords.longitude;*/
                }

                //This function takes in latitude and longitude of two location and returns the distance between them as the crow flies (in km)
                function calcCrow(lat1, lon1, lat2, lon2) 
                {
                    var R = 6371; // km
                    var dLat = toRad(lat2-lat1);
                    var dLon = toRad(lon2-lon1);
                    var lat1 = toRad(lat1);
                    var lat2 = toRad(lat2);

                    var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
                        Math.sin(dLon/2) * Math.sin(dLon/2) * Math.cos(lat1) * Math.cos(lat2); 
                    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
                    var d = R * c;
                    return d;
                }

                // Converts numeric degrees to radians
                function toRad(Value) 
                {
                    return Value * Math.PI / 180;
                }

                getLocation();
            </script>
            <div class="warningText defult-bxshadow">
                <h4><b id="textSucursalMasCercana"></b></h4>
                <i class="fa-solid fa-map-location-dot"></i>
            </div>
        </div>
    </header>
    <main>
        <div class="Products container-fluid d-flex flex-column">
            <div class="title d-flex align-items-center justify-content-center text-center">
                <a class="btn btn-primary icon" href="{{route('ver.productos')}}">
                    <i class="fa-solid fa-tag"></i>
                    ¡Algunos de nuestros productos!
                </a>
            </div>
        </div>
    </main>
</div>
@endsection
