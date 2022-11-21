<?php

namespace App\Http\Controllers;

use App\Models\RolUsuario;
use App\Models\User;
use Illuminate\Http\Request;

class UsuarioController extends Controller
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
        return view("Usuario.index", [
            "usuarios" => User::paginate(20),
            "roles" => RolUsuario::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Usuario.create", [
            "usuario" => new User(),
            "roles" => RolUsuario::all()
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
            "username" => "required|min:5|max:250",
            "email" => "required|min:5|max:500",
            "password" => "required|min:5|max:500",
            "IDRol" => "required"
        ]);
        User::create($validated);

        return back()->with("status", "Se creó el usuario correctamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $usuario)
    {
        return view("Usuario.show", ["usuario" => $usuario, "roles"=>RolUsuario::find($usuario->IDRol)->Nombre]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $usuario)
    {
        return view("Usuario.edit", [
            "usuario" => $usuario,
            "roles" => RolUsuario::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $usuario)
    {
        $validated = $request->validate([
            "username" => "required|min:5|max:250",
            "email" => "required|min:5|max:500",
            "password" => "required|min:5|max:500",
            "IDRol" => "required"
        ]);

        $usuario->update($validated);

        return back()->with("status", "Se actualizó el usuario correctamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = User::find($id);
        $usuario->delete();
    }
}
