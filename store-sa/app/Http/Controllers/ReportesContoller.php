<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportesContoller extends Controller
{
    public function __construct()
    {
        $this->middleware("rol:2");
    }

    public function index()
    {
        return view("Reportes.index");
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function top100vendidos()
    {

    }
    
    public function top100vendidosSucursal()
    {

    }

    public function existenciaMenor10()
    {

    }

    public function masVendidosMes()
    {

    }

    public function masVendidosSucursal()
    {

    }

    public function masVendidos()
    {

    }

    public function compradoresFrecuentes()
    {

    }

    public function compradoresSucursal()
    {

    }

    public function facturas()
    {
        
    }
}
