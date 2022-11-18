@extends('layouts.app')

@section('content')
<div class="reportesContainer">
  <h4 class="mx-5 mb-5"><b>Seleccione el tipo de reporte a generar:</b></h4>
  <div class="row mx-5 align-items-center justify-content-center">
    <div class="col-md-5 text-center">
      <b><a href="/" class="card"> Top 100 productos mas vendidos </a></b>
    </div>
    <div class="col-md-5 text-center">
      <b><a href="/" class="card"> Top 100 productos mas vendidos por sucursal </a></b>
    </div>
    <div class="col-md-5 text-center">
      <b><a href="/" class="card"> Productos con existencia menor a 10 </a></b>
    </div>
    <div class="col-md-5 text-center">
      <b><a href="/" class="card"> Productos más vendidos por mes </a></b>
    </div>
    <div class="col-md-5 text-center">
      <b><a href="/" class="card"> Productos más vendidos por sucursal </a></b>
    </div>
    <div class="col-md-5 text-center">
      <b><a href="/" class="card"> Productos más vendidos </a></b>
    </div>
    <div class="col-md-5 text-center">
      <b><a href="/" class="card"> Compradores frecuentes </a></b>
    </div>
    <div class="col-md-5 text-center">
      <b><a href="/" class="card"> Compradores frecuentes por sucursal </a></b>
    </div>
    <div class="col-md-5 text-center">
      <b><a href="/" class="card"> Facturas </a></b>
    </div>
  </div>
</div>
@endsection