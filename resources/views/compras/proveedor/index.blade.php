@extends('layouts.admin')
@section('contenido')
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Listado de Proveedores <a href="proveedor/create"><button class="btn btn-success">Nuevo</button></a></h3>
        @include('compras.proveedor.search')
    </div>
</div>

<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <div class="table-responsive"> <!-- Division de Tabla -->
            <table class="table table-striped table-bordered table-condensed table-hover"> <!--Tabla con estilo BS-->
                <thead>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Tipo Doc.</th>
                    <th>Num Doc.</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Opciones</th>
                </thead>
                    <!--$articulos es obtenido del controller-->
                    @foreach ($personas as $per) <!-- Por cada articulo -->
                        <tr>
                            <td>{{ $per -> idpersona }}</td> <!--Muestra-->
                            <td>{{ $per -> nombre }}</td>
                            <td>{{ $per -> tipo_documento }}</td>
                            <td>{{ $per -> num_documento }}</td>
                            <td>{{ $per -> telefono }}</td>
                            <td>{{ $per -> email }}</td>
                            <td>
                                <!--URL es un metodo de laravel con un metodo action que va tomar como
                                parametros el Controlador a ejecutar y el parametro(s) que va tomar ese
                                controlador-->
                                <a href="{{ URL::action('ProveedorController@edit',$per->idpersona) }}"><button class="btn btn-info">Editar</button></a>
                                <!--Data target envia los datos al modal-->
                                <a href="" data-target="#modal-delete-{{$per->idpersona}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                            </td>
                        </tr>
                    <!--Debe de incluirse el modal debido a que sea crea un modal por c/categoria-->
                    @include('compras.proveedor.modal')
                    @endforeach
            </table>
        </div>
        {{$personas->render()}}
    </div>    
</div
@endsection