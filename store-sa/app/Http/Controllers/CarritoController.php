<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\DetalleFactura;
use App\Models\EncabezadoFactura;
use App\Models\SucursalProducto;
use App\Models\TipoEnvio;
use Exception;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except("cotizacion");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("Carrito.index", ['carrito' => session()->get('cart')]);
    }

    public function cotizacion()
    {
        return view("Carrito.cotizacion");
    }

    public function pagarCarro()
    {
        $total = 0;
        foreach (session()->get('cart') as $item)
        {
            $total += (intval($item['NoProductos']) * $item['Precio']);
        }
        return view("Carrito.buy", [
            'total' => $total,
            'fecha' => date('d-m-Y'),
            'tiposDeEnvio' => TipoEnvio::all(),
            'departamentos' => Departamento::all()
        ]);
    }

    public function buy(Request $request)
    {
        //return $request;
        $validated = $request->validate([
            'Tarjeta' => 'required|min:16|max:16',
            'Expiracion' => 'required',
            'Codigo' => 'required|min:3',
            'NombreCompleto' => 'required',
            'DireccionEnvio' => 'required',
            'Telefono' => 'required|min:8',
            'NIT' => 'required|min:7',
            'IDTipoEnvio' => 'required',
            'IDDepartamento' => 'required',
        ]);
        /*EN LUGAR DE ESTO SE DEBERÍA CONFIRMAR BIEN LA TARJETA*/
        unset($validated['Tarjeta']);
        unset($validated['Expiracion']);
        unset($validated['Codigo']);
        $validated['FechaCompra'] = date('Y-m-d');
        /*-----------------------------------------------------*/
        
        /*AGREGANDO LOS DETALLES A UN ARRAY ANTES DE GUARDARLO EN LA BD*/
        $detalles = []; $logExitencias = [];
        $carrito = session()->get('cart');
        $total = 0;
        foreach ($carrito as $index => $item)
        {
            $subtotal = (intval($item['NoProductos']) * $item['Precio']);
            $total += $subtotal;

            $cantidad = $item['NoProductos'];
            $sucrusalProducto = SucursalProducto::where('IDProducto', '=', $item['id'])
            ->where('IDSucursal', '=', $item['IDSucursal'])->get()[0];

            if($cantidad <= $sucrusalProducto->Existencia)
            {
                array_push($detalles, [
                    'Subtotal' => $subtotal,
                    'Cantidad' => $cantidad,
                    'IDSucursalProducto' => $sucrusalProducto->id
                ]);
                array_push($logExitencias, ['sumar' => $cantidad, 'idSucursal' => $sucrusalProducto->id]);
                $sucrusalProducto->update(['Existencia' => $sucrusalProducto->Existencia - $cantidad]);
            }
            else
            {
                foreach ($logExitencias as $item)
                {
                    $sucursalProd = SucursalProducto::find($item['idSucursal']);
                    $sucursalProd->update(['Existencia' => $sucursalProd->Existencia + $item['sumar']]);
                }
                $newCarrito = $carrito;
                unset($newCarrito[$index]);
                session()->put('cart', $newCarrito);
                return back()->with("error", "Ya no hay existencia de uno de los productos solicitados, lo hemos eliminado del carrito, por favor realice de nuevo la compra");
            }
        }
        
        /*---------------------------------------------------------------*/

        /*SI NO HAY ERRORES EN LOS DETALLES DE CREA EL ENCABEZADO*/
        $validated['Total'] = $total;
        //return $validated;
        $encabezadoId = EncabezadoFactura::create($validated)->id;
        /*-------------------------------------------------------*/

        /*CREANDO LOS DETALLES EN BASE AL ENCABEZADO*/
        foreach ($detalles as $detalle)
        {
            $detalle['IDEncabezadoFactura'] = $encabezadoId;
            DetalleFactura::create($detalle);
        }
        //AL FINAL SE VACÍA EL CARRITO DE COMPRAS
        session()->put('cart', []);
        session()->put('paymentSuccess', true);
        /*------------------------------------------*/

        //return [$detalles, $validated];
        return redirect()->route('pagoExitoso.carrito');
    }

    public function deleteItem($itemIndex)
    {
        if(session()->has('cart'))
        {
            $carrito = session()->get('cart');
            if(count($carrito) >= 1)
            {
                unset($carrito[$itemIndex]);
                session()->put('cart', $carrito);
                return back()->with('status', "Elemento eliminado correctamente");
            } else back()->with('status', "No hay elementos en el carrito");

        } else return back()->with('status', "No hay elementos en el carrito");
    }

    public function deleteAll()
    {
        session()->put('cart', []);
        return back()->with('status', "El carrito se vació correctamente");
    }
}
