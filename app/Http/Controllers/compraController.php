<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Comprobante;
use App\Models\Producto;
use App\Models\Proveedore;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class compraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compras = Compra::with('comprobante', 'proveedore.persona')
        ->where('estado',1)
        ->latest()
        ->get();
        // dd($compras);
        return view('compra.index', compact('compras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proveedores = Proveedore::whereHas('persona',function($query){
            $query->where('estado',1);

        })->get();
        $comprobantes = Comprobante::all();
        $productos = Producto::where('estado',1)->get();
        return view('compra.create',compact('proveedores', 'comprobantes', 'productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request);
        try {
            DB::beginTransaction();
            // Llenar la tabla de campos
            $compra = Compra::create($request->validated());
            
            DB::commit();
            
        } catch (Exception $e) {
            //throw $th;
            DB::reset();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
