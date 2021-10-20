<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
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
        $Producto = Producto::all();
        $suma = ProductoController::Valoracion();
        
        //return $Producto1;
        return view('Producto',compact('Producto','suma'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Producto.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'nombre'=> 'required',
            'descripcion'=> 'required',
            'cantidad' => 'required|numeric'
        ]);

        
        $ProductoNew = new Producto();
        $ProductoNew->nombre = $request->nombre;
        $ProductoNew->descripcion = $request->descripcion;
        $ProductoNew->cantidad = $request->cantidad;
        $ProductoNew->valor = $request->valor;
        $ProductoNew->save();
        return back()->with('mensaje', 'se agrego el Producto a la base');
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
        $ProductoEditar = Producto::findOrFail($id);
        return view('Producto.actualizar',compact('ProductoEditar'));
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
        $ProductoEditar = Producto::findOrFail($id);
        $ProductoEditar->nombre = $request->nombre;
        $ProductoEditar->descripcion = $request->descripcion;
        $ProductoEditar->cantidad = $request->cantidad;
        $ProductoEditar->valor = $request->valor;
        $ProductoEditar->save();
        return back()->with('mensaje','Producto Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ProductoEliminar = Producto::findOrFail($id);
        $ProductoEliminar->delete();

        return back()->with('mensaje', 'Producto Eliminado');
    }

    public function ModCantidad(Request $request,$id){

        $request->validate([
            'suma' => 'required|numeric'
        ]);

        $ProductoCantidad = Producto::findOrFail($id);
        $ProductoCantidad->cantidad = $request->suma + $ProductoCantidad->cantidad;
        $ProductoCantidad->save();
        return back();
    }

    public function Valoracion(){
        $Producto = Producto::all();
        $suma = 0;
        foreach($Producto as $item){
            $suma = $suma + ($item->valor * $item->cantidad);
        }
        return $suma;
    }
}
