<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use App\Models\Municipio;
use Illuminate\Http\Request;

class SucursalController extends Controller
{
    public function __construct()
    {
        $this->middleware("rol:1");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("Sucursal.index", [
            "sucursales" => Sucursal::paginate(20),
            "municipios" => Municipio::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Sucursal.create", [
            "sucursal" => new Sucursal(),
            "municipios" => Municipio::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "Direccion" => "required|min:5|max:250",
            "Nombre" => "required|min:5|max:500",
            "IDMunicipio"=>"required",
            "latitud"=>"required",
            "longitud"=>"required"
        ]);
        $Ubicacion=$validated["latitud"]."/".$validated["longitud"];
        unset($validated["latitud"]);
        unset($validated["longitud"]);
        $validated["Ubicacion"]=$Ubicacion;
        Sucursal::create($validated);

        return back()->with("status", "Se creó la sucursal correctamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function show(Sucursal $sucursal)
    {
        return view("Sucursal.show", ["sucursal" => $sucursal, "municipio"=>Municipio::find($sucursal->IDMunicipio)->Nombre]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function edit(Sucursal $sucursal)
    {
        return view("Sucursal.edit", [
            "sucursal" => $sucursal,
            "municipios" => Municipio::all(),
            "latitud"=>explode("/", $sucursal->Ubicacion)[0],
            "longitud"=>explode("/", $sucursal->Ubicacion)[1]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sucursal $sucursal)
    {
        $validated = $request->validate([
            "Direccion" => "required|min:5|max:250",
            "Nombre" => "required|min:5|max:500",
            "IDMunicipio"=>"required",
            "latitud"=>"required",
            "longitud"=>"required"
        ]);
        $Ubicacion=$validated["latitud"]."/".$validated["longitud"];
        unset($validated["latitud"]);
        unset($validated["longitud"]);
        $validated["Ubicacion"]=$Ubicacion;
        $sucursal->update($validated);

        return back()->with("status", "Se editó la sucursal correctamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sucursal = Sucursal::find($id);
        $sucursal->delete();
    }
}
