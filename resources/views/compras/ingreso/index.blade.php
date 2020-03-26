@extends('layouts.admin')
@section('contenido')
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Listado de Ingresos <a href="ingreso/create"><button class="btn btn-success">Nuevo</button></a></h3>
        @include('compras.ingreso.search')
    </div>
</div>

<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <div class="table-responsive"> <!-- Division de Tabla -->
            <table class="table table-striped table-bordered table-condensed table-hover"> <!--Tabla con estilo BS-->
                <thead>
                    <th>Fecha</th>
                    <th>Proveedor</th>
                    <th>Comprobante</th>
                    <th>Impuesto</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </thead>
                    <!--$articulos es obtenido del controller-->
                    @foreach ($ingresos as $ing) <!-- Por cada articulo -->
                        <tr>
                         <!--Muestra-->
                            <td>{{ $ing -> fecha_hora }}</td>
                            <td>{{ $ing -> nombre }}</td>
                            <td>{{ $ing -> tipo_comprobante.': '.$ing -> serie_comprobante.'-'.$ing -> num_comprobante }}</td>
                            <td>{{ $ing -> impuesto }}</td>
                            <td>{{ $ing -> total }}</td>
                            <td>{{ $ing -> estado }}</td>
                            <td>
                                <!--URL es un metodo de laravel con un metodo action que va tomar como
                                parametros el Controlador a ejecutar y el parametro(s) que va tomar ese
                                controlador-->
                                <a href="{{ URL::action('IngresoController@show',$ing->idingreso) }}"><button class="btn btn-primary">Detalles</button></a>
                                <!--Data target envia los datos al modal-->
                                <a href="" data-target="#modal-delete-{{$ing->idingreso}}" data-toggle="modal"><button class="btn btn-danger">Anular</button></a>
                            </td>
                        </tr>
                    <!--Debe de incluirse el modal debido a que sea crea un modal por c/categoria-->
                    @include('compras.ingreso.modal')
                    @endforeach
            </table>
        </div>
        {{$ingresos->render()}}
    </div>    
</div
@endsection