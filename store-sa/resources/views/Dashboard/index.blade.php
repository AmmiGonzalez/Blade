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
          [ 'route' => 'home', 'icon' => 'user-astronaut', 'title' => 'crear' ],
          [ 'route' => 'home', 'icon' => 'receipt', 'title' => 'listar' ],
        ]
      ],
      [
        'title' => 'Roles de usuario',
        'cards' => [
          [ 'route' => 'home', 'icon' => 'hammer', 'title' => 'crear' ],
          [ 'route' => 'home', 'icon' => 'receipt', 'title' => 'listar' ],
        ]
      ],
      [
        'title' => 'Distribuidores',
        'cards' => [
          [ 'route' => 'home', 'icon' => 'truck', 'title' => 'crear' ],
          [ 'route' => 'home', 'icon' => 'receipt', 'title' => 'listar' ],
        ]
      ],
      [
        'title' => 'Marcas',
        'cards' => [
          [ 'route' => 'home', 'icon' => 'registered', 'title' => 'crear' ],
          [ 'route' => 'home', 'icon' => 'receipt', 'title' => 'listar' ],
        ]
      ],
      [
        'title' => 'Categorías',
        'cards' => [
          [ 'route' => 'home', 'icon' => 'shapes', 'title' => 'crear' ],
          [ 'route' => 'home', 'icon' => 'receipt', 'title' => 'listar' ],
        ]
      ],
      [
        'title' => 'Sucursales',
        'cards' => [
          [ 'route' => 'home', 'icon' => 'shop', 'title' => 'crear' ],
          [ 'route' => 'home', 'icon' => 'receipt', 'title' => 'listar' ],
        ]
      ],
    ]
  ])
</div>
@endsection