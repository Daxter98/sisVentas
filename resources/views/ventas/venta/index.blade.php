@extends('layouts.admin')
@section('contenido')
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Listado de Ventas <a href="venta/create"><button class="btn btn-success">Nuevo</button></a></h3>
        @include('ventas.venta.search')
    </div>
</div>

<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <div class="table-responsive"> <!-- Division de Tabla -->
            <table class="table table-striped table-bordered table-condensed table-hover"> <!--Tabla con estilo BS-->
                <thead>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Comprobante</th>
                    <th>Impuesto</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </thead>
                    <!--$articulos es obtenido del controller-->
                    @foreach ($ventas as $ven) <!-- Por cada articulo -->
                        <tr>
                         <!--Muestra-->
                            <td>{{ $ven -> fecha_hora }}</td>
                            <td>{{ $ven -> nombre }}</td>
                            <td>{{ $ven -> tipo_comprobante.': '.$ven -> serie_comprobante.'-'.$ven -> num_comprobante }}</td>
                            <td>{{ $ven -> impuesto }}</td>
                            <td>{{ $ven -> total_venta }}</td>
                            <td>{{ $ven -> estado }}</td>
                            <td>
                                <!--URL es un metodo de laravel con un metodo action que va tomar como
                                parametros el Controlador a ejecutar y el parametro(s) que va tomar ese
                                controlador-->
                                <a href="{{ URL::action('VentaController@show',$ven->idventa) }}"><button class="btn btn-primary">Detalles</button></a>
                                <!--Data target envia los datos al modal-->
                                <a href="" data-target="#modal-delete-{{$ven->idventa}}" data-toggle="modal"><button class="btn btn-danger">Anular</button></a>
                            </td>
                        </tr>
                    <!--Debe de incluirse el modal debido a que sea crea un modal por c/categoria-->
                    @include('ventas.venta.modal')
                    @endforeach
            </table>
        </div>
        {{$ventas->render()}}
    </div>    
</div
@endsection