@extends('layouts.app')

@section('content')
<div class="paymentSuccessContainer h-100">
  @if (session()->has('paymentSuccess'))  
    @if(session()->get('paymentSuccess') == false) <script>window.location = "/home";</script>
    @else
    <div class="container d-flex flex-column align-items-center justify-content-center h-100 w-100">
      <p class="card mb-5 py-3 px-5"><b>Su pago se ha registrado correctamente</b></p>
      <a href="/" class="btn btn-primary">
        <i class="fa-solid fa-home mr"></i>
        Inicio
      </a>
      @php session()->put('paymentSuccess', false) @endphp
    </div>
    @endif
  @else
    <script>window.location = "/home";</script>
  @endif
</div>
@endsection