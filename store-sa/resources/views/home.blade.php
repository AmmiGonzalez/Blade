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
                        <a class="btn btn-primary mx-2 mt-4"><i class="fa-solid fa-right-to-bracket"></i> Iniciar sesión</a>
                        <a class="btn btn-primary mx-2 mt-4"><i class="fa-solid fa-plus-square"></i> ¡Registrarse gratis!</a>
                    </div>
                @endif
                @else
                <div class="registeredText defult-bxshadow">
                    <h4 class="px-5">Puede añadir productos a su carrito de compras y acceder a ellos por medio del ícono</h4>
                    <i class="fa-solid fa-basket-shopping"></i>
                </div>
            @endguest
            {{-- <div class="warningText defult-bxshadow">
                <h4><b>Aceptamos únicamente pagos con tarjeta de crédito y débito</b></h4>
                <i class="fa-solid fa-warning"></i>
            </div> --}}
        </div>
    </header>
    <main>
        <div class="Products container-fluid d-flex flex-column">
            <div class="title d-flex align-items-center justify-content-center text-center">
                <div class="icon"><i class="fa-solid fa-tag"></i></div>
                <h3>¡Algunos de nuestros productos!</h3>
            </div>
        </div>
    </main>
</div>
@endsection
