<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Producto;
use App\Models\Sucursal;
use App\Models\SucursalProducto;
use Exception;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware("rol:1")->except(["index", "show"]);
        //else $this->middleware("auth")->except(["index"]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("Producto.index", [
            "productos" => Producto::paginate(20),
            "marcas" => Marca::all(),
            "categorias" => Categoria::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Producto.create", [
            "producto" => new Producto(),
            "sucProducto" => new SucursalProducto(),
            "sucursales" => Sucursal::all(),
            "marcas" => Marca::all(),
            "categorias" => Categoria::all()
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
            "NoSerie" => "required|min:5|max:500",
            "Nombre" => "required|min:5|max:250",
            "Descripcion" => "required|min:5|max:500",
            "Caracteristicas" => "required|min:5|max:500",
            "Precio" => "required|numeric|min:0|max:999999.99",
            "Descuento" => "required|min:0|max:100",
            "PathImagen" => "required|image|mimes:png,jpg,jpeg",
            "IDMarca" => "required",
            "IDCategoria" => "required",
        ]);

        $path = Storage::disk("public")->put("ProductImages", $request->file("PathImagen"));
        $validated["PathImagen"] = $path;
        //print_r($validated);

        Producto::create($validated);

        return back()->with("status", "Se creó el producto correctamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        $sucursales = SucursalProducto::where("IDProducto", "=", $producto->id)->with("sucursal")->get();
        
        return view("Producto.show", [
            "producto" => $producto,
            "marca" => $producto->marca,
            "sucursales" => $sucursales,
            "categorias" => Categoria::all(),
            "cart" => session()->get("cart")
        ]);
    }

    public function addToCart(Request $request, Producto $producto)
    {
        //session()->flush();
        $validated = $request->validate([
            "IDSucursal" => "required",
            "NoProductos" => "required",
        ]);
        /*
        VERIFICANDO QUE A CANTIDAD DE PRODUCTOS PARA AÑADIR AL
        CARRO NO SUPERE LA EXISTENCIA EN LA SUCURSAL SELECCIONADA
        */
        if($request->input('submitted') == 'addToCart')
        {
            $sucursalProducto = SucursalProducto::
            where('IDProducto', '=', $producto->id)
            ->where('IDSucursal', '=', $request->IDSucursal)->get()[0];
            if($sucursalProducto->Existencia < $request->NoProductos)
                return back()->with('error', 'Cantidad superior a la existencia');
        }
        
        if(!session()->has("cart")) session()->put("cart", []);
        if(!session()->has("quotation")) session()->put("quotation", []);

        $res = array_merge($validated, $producto->toArray());
        
        if($request->input("submitted") == "addToCart")
            session()->push('cart', $res);
        else 
            session()->push('quotation', $res);
            
        return back()->with("status", $request->input("submitted") == "addToCart" ? "Se agregó el producto al carrito" : "Se agregó el producto a la cotización");
        //return session()->all();
    }

    public function addExistencias(Request $request, Producto $producto)
    {
        return view("Producto.addExistencias", [
            "producto" => $producto,
            "sucursales" => Sucursal::all()
        ]);
    }

    public function storeExistencias(Request $request)
    {
        $sucursal = SucursalProducto::where("IDProducto", "=", $request->IDProducto)
            ->where("IDSucursal", "=", $request->IDSucursal)->get();

        if(count($sucursal) == 0)
        {
            $validated = $request->validate([
                'Existencia' => "required|min:1",
                'IDProducto' => "required",
                'IDSucursal' => "required",
            ]);
            
            $sucursal = SucursalProducto::create($validated);
        }
        else
        {
            $sucursal[0]->Existencia += $request->Existencia;
            $sucursal[0]->save();
        }
        return back()->with("status", "Se agregaron las existencias correctamente");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        return view("Producto.edit", [
            "producto" => $producto,
            "sucProducto" => new SucursalProducto(),
            "sucursales" => Sucursal::all(),
            "marcas" => Marca::all(),
            "categorias" => Categoria::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        $validated = $request->validate([
            "NoSerie" => "required|min:5|max:500",
            "Nombre" => "required|min:5|max:250",
            "Descripcion" => "required|min:5|max:500",
            "Caracteristicas" => "required|min:5|max:500",
            "Precio" => "required|numeric|min:0|max:999999.99",
            "Descuento" => "required|min:0|max:100",
            "PathImagen" => "image|mimes:png,jpg,jpeg",
            "IDMarca" => "required",
            "IDCategoria" => "required",
        ]);
        if($request->file("PathImagen") != null)
        {
            Storage::disk("public")->delete($producto->PathImagen);
            $path = Storage::disk("public")->put("ProductImages", $request->file("PathImagen"));
            $validated["PathImagen"] = $path;
        }
        //print_r($validated);

        $producto->update($validated);

        return back()->with("status", "Se actualizó el producto correctamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = Producto::find($id);
        Storage::disk("public")->delete($producto->PathImagen);
        $producto->distribucion()->delete();
        $producto->sucursalProductos()->delete();
        $producto->delete();
    }
}
