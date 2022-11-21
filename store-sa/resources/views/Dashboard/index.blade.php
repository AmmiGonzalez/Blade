@extends('layouts.app')

@section('content')
<div class="dashboardContainer">
  @include('Dashboard.partials.section', [
    'options' => [
      [
        'title' => 'Productos',
        'cards' => [
          [ 'route' => 'crear.producto', 'icon' => 'boxes-stacked', 'title' => 'crear' ],
          //[ 'route' => 'crear.producto', 'icon' => 'box', 'title' => 'agregar existencias' ],
        ]
      ],
      [
        'title' => 'Usuarios',
        'cards' => [
          //[ 'route' => 'home', 'icon' => 'user-astronaut', 'title' => 'crear' ],
          [ 'route' => 'ver.usuario', 'icon' => 'receipt', 'title' => 'listar' ],
        ]
      ],
      [
        'title' => 'Roles de usuario',
        'cards' => [
          [ 'route' => 'crear.rol', 'icon' => 'hammer', 'title' => 'crear' ],
          [ 'route' => 'ver.rol', 'icon' => 'receipt', 'title' => 'listar' ],
        ]
      ],
      [
        'title' => 'Distribuidores',
        'cards' => [
          [ 'route' => 'crear.distribuidor', 'icon' => 'truck', 'title' => 'crear' ],
          [ 'route' => 'ver.distribuidor', 'icon' => 'receipt', 'title' => 'listar' ],
        ]
      ],
      [
        'title' => 'Marcas',
        'cards' => [
          [ 'route' => 'crear.marca', 'icon' => 'registered', 'title' => 'crear' ],
          [ 'route' => 'ver.marca', 'icon' => 'receipt', 'title' => 'listar' ],
        ]
      ],
      [
        'title' => 'Categorías',
        'cards' => [
          [ 'route' => 'crear.categoria', 'icon' => 'shapes', 'title' => 'crear' ],
          [ 'route' => 'ver.categoria', 'icon' => 'receipt', 'title' => 'listar' ],
        ]
      ],
      [
        'title' => 'Sucursales',
        'cards' => [
          [ 'route' => 'crear.sucursal', 'icon' => 'shop', 'title' => 'crear' ],
          [ 'route' => 'ver.sucursal', 'icon' => 'receipt', 'title' => 'listar' ],
        ]
      ],
    ]
  ])
</div>
@endsection