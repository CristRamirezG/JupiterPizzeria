@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Generar Entrada</span>
                    <a href="/Entrada" class="btn btn-primary btn-sm">Volver a lista...</a>
                </div>
                <div class="card-body">
                    

                    @error('nombre')                <!-- llega el error desde el metodo Producto.store --> 
                    <div class="alert alert-danger" role="alert">
                        El nombre del producto es obligatorio
                    </div>
                    @enderror
                    @error('descripcion')                <!-- llega el error desde el metodo Producto.store --> 
                        <div class="alert alert-danger" role="alert">
                        la descripcion es obligatoria
                        </div>
                    @enderror 
                    @error('cantidad')                <!-- llega el error desde el metodo Producto.store --> 
                        <div class="alert alert-danger" role="alert">
                        cantidad debe ser un numero entero y es obligatorio
                        </div>
                    @enderror  
                    
                    
                  @if ( session('mensaje') )
                    <div class="alert alert-success">{{ session('mensaje') }}</div>
                  @endif
                  <form method="POST" action="/Entrada">
                    @csrf
                    
                    
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="id_producto">Productos</label>
                        </div>

                                                
                        <select class="custom-select" id="id_producto" name="id_producto">
                          <option selected>. . .</option>
                        @foreach ($Producto as $ProductoItem)
                            <option  value="{{$ProductoItem->id}}">{{$ProductoItem->nombre}}</option>
                        @endforeach
                        </select>
                      </div>

                    <input
                      type="text"
                      name="descripcion"
                      placeholder="descripcion"
                      class="form-control mb-2"
                    />
                    <input
                      type="text"
                      name="cantidad"
                      placeholder="cantidad"
                      class="form-control mb-2"
                    />
                    <input
                      type="text"
                      name="valor"
                      placeholder="Valor"
                      class="form-control mb-2"
                    />
                    <input type="hidden" name="autor" value="{{auth()->user()->name}}" />

                    <button class="btn btn-primary btn-block" type="submit">Agregar</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection