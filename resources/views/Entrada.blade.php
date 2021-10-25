@extends('layouts.app')

@section('content')

<div class='container my-4 '>
    <h1>bienvenido {{auth()->user()->name}}</h1>

    <div class="d-inline-flex p-2">
        <a href="/Entrada/create" class="btn btn-outline-primary">Generar Nueva Entrada</a>
    </div>

    <table class="table">
        <thead>
          <tr>
            <th scope="col">id</th>
            <th scope="col">Producto</th>
            <th scope="col">descripcion</th>
            <th scope="col">Cantidad Agregada</th>
            <th scope="col">Valor</th>
            <th scope="col">Acciones</th>   
          </tr>
        </thead>
        @foreach ($Entradas as $item)
            <tbody>
            <tr>
                <th scope="row">{{$item->id}}</th>
                <td>{{$item->nombre_producto}}</td>
                <td>{{$item->descripcion}}</td>
                <td>{{$item->cantidad}}</td>
                <td>${{$item->valor}}</td>

                <td>
                    <form action="{{route('Entrada.destroy',$item,$item->id_producto)}}" class="d-inline " method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm ">Eliminar</button>
                    </form> 

                </td>
            </tr>
            </tbody>
    
        @endforeach
    </table>
    <button class="btn btn-success" > Tabla a Excel </button>
    
</div>

    
@endsection








<!-- Comentario abajo



--->