@extends('layouts.app')


@section('content')
<div class='container my-4 '>
    <h1>bienvenido {{auth()->user()->name}}</h1>

    <div class="d-inline-flex p-2">
        <a href="/Producto/create" class="btn btn-outline-primary">Agreagar Producto</a>
    </div>

    <table class="table">
        <thead>
          <tr>
            <th scope="col">id</th>
            <th scope="col">Nombre</th>
            <th scope="col">descripcion</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Valor</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        @foreach ($Producto as $item)
            <tbody>
            <tr>
                <th scope="row">{{$item->id}}</th>
                <td>{{$item->nombre}}</td>
                <td>{{$item->descripcion}}</td>
                <td>{{$item->cantidad}}</td>
                <td>${{$item->valor}}</td>
                <td>
                    <a href="{{route('Producto.edit',$item)}}" class= "btn btn-outline-primary btn-sm ",$item>Modificar</a>

                    <form action="{{route('Producto.destroy',$item)}}" class="d-inline " method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm ">Eliminar</button>
                    </form> 

                    
                    <div class="my-2 mr-2 form-row align-items-center">

                        <button class= "btn btn-outline-success btn-sm">-</button>

                        <div class="col-auto">
                        <form  action="{{route('Producto.ModCantidad',$item->id)}}" method="POST">
                            @method("PUT")
                            @csrf

                            <label class="sr-only" for="inlineFormInput">Name</label>
                            <input type="text submit" name="suma" class="form-control form-control-sm" id="inlineFormInput" placeholder="Agregar">
                        </form>
                        </div>

                        <button class= "btn btn-outline-success btn-sm">+</button>
                        
                    </div>
                    
                    
                </td>

            </tr>
            </tbody>
    
        @endforeach
    </table>
    <button class="btn btn-success" > Tabla a Excel </button>
</div>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <figure class="text-center">
                <div class="card-header">{{ __('Datos Relevantes:') }}</div>
            </figure>
                    <figure class="text-center">
                    <blockquote class="blockquote">
                    <h2>Valorizacion Inventario</h2>
                    <h4>Valor : ${{$suma}} </h4>


                     </blockquote>
                    <blockquote class="blockquote">
                        <h2>Cantidad Produccion Promedio:</h2>
                        <h4>. . . </h4>
                        </blockquote>
                    

                    
                    </figure>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>



@endsection