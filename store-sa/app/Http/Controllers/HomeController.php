<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /* public function __construct()
    {
        $this->middleware('auth');
    } */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $locations = [];
        $sucursales = Sucursal::all();
        foreach ($sucursales as $sucursal) {
            array_push($locations, [
                "lat" => explode('/', $sucursal->Ubicacion)[0],
                "lon" => explode('/', $sucursal->Ubicacion)[1],
                "nombre" => $sucursal->Nombre
            ]);
        }
        return view('home', ['locations' => $locations]);
    }

    function getDistanceBetweenPointsNew($latitude1, $longitude1, $latitude2, $longitude2, $unit = 'miles') {
        $theta = $longitude1 - $longitude2; 
        $distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta))); 
        $distance = acos($distance); 
        $distance = rad2deg($distance); 
        $distance = $distance * 60 * 1.1515; 
        switch($unit) { 
          case 'miles':
            break;
          case 'kilo' : 
            $distance = $distance * 1.609344; 
        }
        return (round($distance,2)); 
    }
}
