@extends('layouts.app')

@section('content')
<div class="reportesContainer">
  <h4 class="mx-5 mb-5"><b>Seleccione el tipo de reporte a generar:</b></h4>
  <div class="row mx-5 align-items-center justify-content-center">
    <div class="col-md-5 text-center">
      <b><a href="/reportes/top100vendidos" class="card"> Top 100 productos más vendidos </a></b>
    </div>
    <div class="col-md-5 text-center">
      <b><a href="/reportes/top100vendidosSucursal" class="card"> Top 100 productos más vendidos por sucursal </a></b>
    </div>
    <div class="col-md-5 text-center">
      <b><a href="/reportes/existenciaMenor10" class="card"> Productos con existencia menor a 10 </a></b>
    </div>
    <div class="col-md-5 text-center">
      <b><a href="/reportes/masVendidosMes" class="card"> Productos más vendidos por mes </a></b>
    </div>
    <div class="col-md-5 text-center">
      <b><a href="/reportes/masVendidosSucursal" class="card"> Productos más vendidos por sucursal </a></b>
    </div>
    <div class="col-md-5 text-center">
      <b><a href="/reportes/masVendidos" class="card"> Productos más vendidos </a></b>
    </div>
    <div class="col-md-5 text-center">
      <b><a href="/reportes/compradoresFrecuentes" class="card"> Compradores frecuentes </a></b>
    </div>
    {{-- <div class="col-md-5 text-center">
      <b><a href="/reportes/compradoresSucursal" class="card"> Compradores frecuentes por sucursal </a></b>
    </div> --}}
    <div class="col-md-5 text-center">
      <b><a href="/reportes/facturas" class="card"> Historial facturas </a></b>
    </div>
  </div>
</div>
@endsection