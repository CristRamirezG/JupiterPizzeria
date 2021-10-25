<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrada;
use App\Models\Producto;

class EntradaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');              //Todos los metodos accedidos deben estar con autenticacion
    }

    public function index()
    {

        $Entradas = Entrada::all();
        //$Producto = Producto::all();
        return view('Entrada',compact('Entradas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Producto = Producto::all();
        return view('Entrada.create',compact('Producto'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)     //modifica el valor y la cantidad del producto 
    {
        $ProductoPorId = Producto::findOrFail($request->id_producto);
        $EntradaNew = new Entrada();
        $EntradaNew->id_producto = $request->id_producto;
        $EntradaNew->cantidad = $request->cantidad;
        $EntradaNew->nombre_producto = $ProductoPorId->nombre;
        $ProductoPorId->cantidad = $request->cantidad + $ProductoPorId->cantidad;
        $ProductoPorId->valor = $request->valor + $ProductoPorId->valor;
        $EntradaNew->descripcion = $request->descripcion;
        $EntradaNew->valor = $request->valor;
        $ProductoPorId->save();
        $EntradaNew->save();
        return back();

        return $request;    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $EntradaEliminar = Entrada::findOrFail($id);
        $Producto = Producto::findOrFail($EntradaEliminar->id_producto);
        $Producto->cantidad = $Producto->cantidad - $EntradaEliminar->cantidad;
        $Producto->valor = $Producto->cantidad - $EntradaEliminar->valor;
        $EntradaEliminar->delete();
        $Producto->save();
        return back();
    }
}
