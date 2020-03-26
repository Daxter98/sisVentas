@extends('layouts.admin')
@section('contenido')
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Listado de Articulos <a href="articulo/create"><button class="btn btn-success">Nuevo</button></a></h3>
        @include('almacen.articulo.search')
    </div>
</div>

<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <div class="table-responsive"> <!-- Division de Tabla -->
            <table class="table table-striped table-bordered table-condensed table-hover"> <!--Tabla con estilo BS-->
                <thead>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Código</th>
                    <th>Categoría</th>
                    <th>Stock</th>
                    <th>Imagen</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </thead>
                    <!--$articulos es obtenido del controller-->
                    @foreach ($articulos as $art) <!-- Por cada articulo -->
                        <tr>
                            <td>{{ $art -> idarticulo }}</td> <!--Muestra-->
                            <td>{{ $art -> nombre }}</td>
                            <td>{{ $art -> codigo }}</td>
                            <td>{{ $art -> categoria }}</td>
                            <td>{{ $art -> stock }}</td>
                            <td>
                                <img src="{{ asset('imagenes/articulos/'.$art->imagen) }}" alt="{{$art->nombre}}" height="100px" width="100px" class="img-thumbnail">
                            </td>
                            <td>{{ $art -> estado }}</td>
                            <td>
                                <!--URL es un metodo de laravel con un metodo action que va tomar como
                                parametros el Controlador a ejecutar y el parametro(s) que va tomar ese
                                controlador-->
                                <a href="{{ URL::action('ArticuloController@edit',$art->idarticulo) }}"><button class="btn btn-info">Editar</button></a>
                                <!--Data target envia los datos al modal-->
                                <a href="" data-target="#modal-delete-{{$art->idarticulo}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                            </td>
                        </tr>
                    <!--Debe de incluirse el modal debido a que sea crea un modal por c/categoria-->
                    @include('almacen.articulo.modal')
                    @endforeach
            </table>
        </div>
        {{$articulos->render()}}
    </div>    
</div
@endsection