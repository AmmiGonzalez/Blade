<?php

namespace App\Http\Controllers;

use App\Models\Distribuidor;
use Illuminate\Http\Request;

class DistribuidorController extends Controller
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
        return view("Distribuidor.index", ["distribuidores" => Distribuidor::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Distribuidor.create", [
            "distribuidor" => new Distribuidor()
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
            "Nombre" => "required|min:5|max:250",
            "Direccion" => "required|min:5|max:500",
            "Email" => "required|min:5|max:500",
            "Telefono" => "required|min:8|max:8"
        ]);
        Distribuidor::create($validated);

        return back()->with("status", "Se creó el distribuidor correctamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Distribuidor  $distribuidor
     * @return \Illuminate\Http\Response
     */
    public function show(Distribuidor $distribuidor)
    {
        return view("Distribuidor.show", ["distribuidor" => $distribuidor]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Distribuidor  $distribuidor
     * @return \Illuminate\Http\Response
     */
    public function edit(Distribuidor $distribuidor)
    {
        return view("Distribuidor.edit", [
            "distribuidor" => $distribuidor
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Distribuidor  $distribuidor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Distribuidor $distribuidor)
    {
        $validated = $request->validate([
            "Nombre" => "required|min:5|max:250",
            "Direccion" => "required|min:5|max:500",
            "Email" => "required|min:5|max:500",
            "Telefono" => "required|min:8|max:8"
        ]);

        $distribuidor->update($validated);

        return back()->with("status", "Se actualizó el distribuidor correctamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Distribuidor  $distribuidor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $distribuidor = Distribuidor::find($id);
        $distribuidor->delete();
    }
}
