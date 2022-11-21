<?php

namespace App\Http\Controllers;

use App\Models\RolUsuario;
use Illuminate\Http\Request;

class RolUsuarioController extends Controller
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
        return view("Dashboard.index");
    }

    public function roles()
    {
        return view("Rol.index", ["roles" => RolUsuario::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Rol.create");
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
            "Descripcion" => "required",
        ]);
        RolUsuario::create($validated);

        return back()->with("status", "Se creó el rol correctamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RolUsuario  $rolUsuario
     * @return \Illuminate\Http\Response
     */
    public function show(RolUsuario $rolUsuario)
    {
        return view("Rol.show", ["rolUsuario" => $rolUsuario]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RolUsuario  $rolUsuario
     * @return \Illuminate\Http\Response
     */
    /* El segundo parámetros (con signo de dolar) es el que se indica en la ruta  */
    public function edit(RolUsuario $rolUsuario)
    {
        return view("Rol.edit", [
            "rolUsuario" => $rolUsuario
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RolUsuario  $rolUsuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RolUsuario $rolUsuario)
    {
        $validated = $request->validate([
            "Nombre" => "required|min:5|max:250",
            "Descripcion" => "required"
        ]);

        $rolUsuario->update($validated);

        return back()->with("status", "Se actualizó el rol correctamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RolUsuario  $rolUsuario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rolUsuario = RolUsuario::find($id);
        $rolUsuario->delete();
    }
}
