@extends('layouts.admin')
@section('contenido')
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Listado de Categorías <a href="categoria/create"><button class="btn btn-success">Nuevo</button></a></h3>
        @include('almacen.categoria.search')
    </div>
</div>

<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <div class="table-responsive"> <!-- Division de Tabla -->
            <table class="table table-striped table-bordered table-condensed table-hover"> <!--Tabla con estilo BS-->
                <thead>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Opciones</th>
                </thead>
                    @foreach ($categorias as $cat) <!-- Por cada categoria -->
                        <tr>
                            <td>{{ $cat -> idcategoria }}</td> <!--Muestra-->
                            <td>{{ $cat -> nombre }}</td>
                            <td>{{ $cat -> descripcion }}</td>
                            <td>
                                <!--URL es un metodo de laravel con un metodo action que va tomar como
                                parametros el Controlador a ejecutar y el parametro(s) que va tomar ese
                                controlador-->
                                <a href="{{ URL::action('CategoriaController@edit',$cat->idcategoria) }}"><button class="btn btn-info">Editar</button></a>
                                <!--Data target envia los datos al modal-->
                                <a href="" data-target="#modal-delete-{{$cat->idcategoria}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                            </td>
                        </tr>
                    <!--Debe de incluirse el modal debido a que sea crea un modal por c/categoria-->
                    @include('almacen.categoria.modal')
                    @endforeach
            </table>
        </div>
        {{$categorias->render()}}
    </div>    
</div
@endsection