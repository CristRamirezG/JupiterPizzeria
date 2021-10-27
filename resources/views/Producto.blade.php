@extends('layouts.app')


@section('content')
<div class='container my-4 '>
    <h1>Bienvenido {{auth()->user()->name}}</h1>
    <h2>Seleccione alguna de las siguentes acciones:</h2>

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

                    <!-- boton eliminar con pop up -->
                    <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target=".bd-example-modal-sm">Eliminar</button>
                    <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4>Estas seguro que quieres eliminar el producto?</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <h6>Recuerda que no deben existir Entradas asociadas</h6>
                                    <form action="{{route('Producto.destroy',$item)}}" class="d-inline " method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm ">Eliminar!</button>
                                    </form> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <!---->

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