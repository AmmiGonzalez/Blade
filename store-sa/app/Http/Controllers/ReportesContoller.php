<?php

namespace App\Http\Controllers;

use App\Models\EncabezadoFactura;
use App\Models\Producto;
use App\Models\Sucursal;
use App\Models\SucursalProducto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function top100vendidos()
    {
        $queryRes = DB::select(DB::raw(<<<EOD
            SELECT SUM(Cantidad) Cantidad, p.id AS IDProducto FROM detalle_facturas
            INNER JOIN sucursal_productos sp
            ON sp.id = IDSucursalProducto
            INNER JOIN productos p
            ON p.id = sp.IDProducto
            GROUP BY p.id
            ORDER BY Cantidad desc limit 100
        EOD));

        $productos = [];
        foreach ($queryRes as $rows)
        {
            $prdRes = Producto::find($rows->IDProducto)->toArray();
            $prdRes["Cantidad"] = $rows->Cantidad;
            array_push($productos, $prdRes);
        }
        
        return view("Reportes.reportes.top100vendidos", [
            "productos" => $productos
        ]);
    }
    
    public function top100vendidosSucursal(Request $request)
    {
        $IDSucursal = 0;
        if(!$request->has("IDSucursal")) $IDSucursal = Sucursal::all()->first()->id;
        else $IDSucursal = $request->query("IDSucursal");

        $queryRes = DB::select(DB::raw(<<<EOD
            SELECT sp.IDProducto, s.id AS IDSucursal, SUM(Cantidad) Cantidad FROM detalle_facturas df
            INNER JOIN sucursal_productos sp
            ON df.IDSucursalProducto = sp.id
            INNER JOIN sucursals s
            ON s.id = sp.IDSucursal
            WHERE sp.IDSucursal = $IDSucursal 
            GROUP BY IDSucursalProducto ORDER BY Cantidad DESC limit 100
        EOD));

        $productos = [];
        foreach ($queryRes as $rows)
        {
            $prdRes = Producto::find($rows->IDProducto)->toArray();
            $prdRes["Cantidad"] = $rows->Cantidad;
            array_push($productos, $prdRes);
        }
        $sucursalAcutal = Sucursal::find($IDSucursal);
        return view("Reportes.reportes.top100vendidosSucursal", [
            "productos" => $productos,
            "sucursalActual" => [$sucursalAcutal->id, $sucursalAcutal->Nombre],
            "sucursales" => Sucursal::all()
        ]);
    }

    public function existenciaMenor10()
    {
        $productos = [];
        $sucursales = SucursalProducto::selectRaw('SUM(Existencia) as total, IDProducto')
        ->groupBy("IDProducto")
        ->get();
        foreach ($sucursales as $sucursal)
        {
            if($sucursal->total < 10) array_push($productos, Producto::find($sucursal->IDProducto));
        }
        //return $productos;
        return view("Reportes.reportes.existenciaMenor10", ["productos" => $productos]);
    }

    public function masVendidosMes(Request $request)
    {
        $mes = 1;
        if($request->has("mes")) $mes = $request->query('mes');

        $queryRes = DB::select(DB::raw(<<<EOD
            SELECT SUM(Cantidad) Cantidad, p.id AS IDProducto FROM detalle_facturas
            INNER JOIN sucursal_productos sp
            ON sp.id = IDSucursalProducto
            INNER JOIN productos p
            ON p.id = sp.IDProducto
            INNER JOIN encabezado_facturas ef
            ON ef.id = IDEncabezadoFactura
            WHERE YEAR(ef.FechaCompra) = Year(curdate()) and month(ef.FechaCompra) = $mes
            GROUP BY p.id
            ORDER BY Cantidad desc
        EOD));

        $productos = [];
        foreach ($queryRes as $rows)
        {
            $prdRes = Producto::find($rows->IDProducto)->toArray();
            $prdRes["Cantidad"] = $rows->Cantidad;
            array_push($productos, $prdRes);
        }
        
        return view("Reportes.reportes.masVendidosMes", [
            "productos" => $productos,
            "mesIndex" => $mes,
            "nombresMeses" => [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ]
        ]);
    }

    public function masVendidosSucursal(Request $request)
    {
        $IDSucursal = 0;
        if(!$request->has("IDSucursal")) $IDSucursal = Sucursal::all()->first()->id;
        else $IDSucursal = $request->query("IDSucursal");

        $queryRes = DB::select(DB::raw(<<<EOD
            SELECT sp.IDProducto, s.id AS IDSucursal, SUM(Cantidad) Cantidad FROM detalle_facturas df
            INNER JOIN sucursal_productos sp
            ON df.IDSucursalProducto = sp.id
            INNER JOIN sucursals s
            ON s.id = sp.IDSucursal
            WHERE sp.IDSucursal = $IDSucursal 
            GROUP BY IDSucursalProducto ORDER BY Cantidad DESC
        EOD));

        $productos = [];
        foreach ($queryRes as $rows)
        {
            $prdRes = Producto::find($rows->IDProducto)->toArray();
            $prdRes["Cantidad"] = $rows->Cantidad;
            array_push($productos, $prdRes);
        }
        $sucursalAcutal = Sucursal::find($IDSucursal);
        return view("Reportes.reportes.masVendidosSucursal", [
            "productos" => $productos,
            "sucursalActual" => [$sucursalAcutal->id, $sucursalAcutal->Nombre],
            "sucursales" => Sucursal::all()
        ]);
    }

    public function masVendidos()
    {
        $queryRes = DB::select(DB::raw(<<<EOD
            SELECT SUM(Cantidad) Cantidad, p.id AS IDProducto FROM detalle_facturas
            INNER JOIN sucursal_productos sp
            ON sp.id = IDSucursalProducto
            INNER JOIN productos p
            ON p.id = sp.IDProducto
            GROUP BY p.id
            ORDER BY Cantidad desc
        EOD));

        $productos = [];
        foreach ($queryRes as $rows)
        {
            $prdRes = Producto::find($rows->IDProducto)->toArray();
            $prdRes["Cantidad"] = $rows->Cantidad;
            array_push($productos, $prdRes);
        }
        
        return view("Reportes.reportes.masVendidos", [
            "productos" => $productos
        ]);
    }

    public function compradoresFrecuentes()
    {
        $clientes = DB::select(DB::raw(<<<EOD
            SELECT COUNT(NombreCompleto) AS Compras, SUM(Total) AS TotalComprado , NombreCompleto
            FROM encabezado_facturas
            GROUP BY NombreCompleto
            ORDER BY Compras desc
        EOD));
        //return $clientes;
        return view("Reportes.reportes.compradoresFrecuentes", ["clientes" => $clientes]);
    }

    /* public function compradoresSucursal()
    {

    } */

    public function facturas()
    {
        return view("Reportes.reportes.facturas", [
            "facturas" => EncabezadoFactura::all()
        ]);
    }
}
