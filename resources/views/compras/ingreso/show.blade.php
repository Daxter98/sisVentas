@extends('layouts.admin')
@section('contenido')
    <!--Division principal-->
    <div class="row">
        <!--Formulario dividido por columnas-->
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="form-group">
                <label for="proveedor">Proveedor</label>
                <!--Para selectpicker es necesario bajar la libreria o utilizar COMPOSER y copiar a public-->
                <p>{{$ingreso->nombre}}</p>
            </div>
        </div>
        <!-- Los numero al final de cada etiqueta indican el numero de celdas a utilizar de la plantilla Bootstrap-->

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label>Tipo Comprobante</label>
                <!--CB HTML-->
                <p>{{$ingreso->tipo_comprobante}}</p>
            </div>
        </div>

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="serie_comproabente">Serie Comprobante</label>
                <p>{{$ingreso->serie_comprobante}}</p>
            </div>
        </div>

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="num_comproabente">Número Comprobante</label>
                <p>{{$ingreso->num_comprobante}}</p>
            </div>
        </div>
    </div>
    <!--Bootstrap solo maneja 12 celdas-->
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-body"> 

                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <table id="detalles" class="table table-bordered table-striped table-condensed table-hover">
                        <thead style="background-color:#A9D0F5">
                            <th>Artículo</th>
                            <th>Cantidad</th>
                            <th>Precio Compra</th>
                            <th>Precio Venta</th>
                            <th>Subtotal</th>
                        </thead>

                        <tfoot>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th><h4 id="total">MXN {{$ingreso->total}}</h4></th>
                        </tfoot>

                        <tbody>
                            @foreach($detalles as $det)
                                <tr>
                                    <td>{{$det->articulo}}</td>
                                    <td>{{$det->cantidad}}</td>
                                    <td>{{$det->precio_compra}}</td>
                                    <td>{{$det->precio_venta}}</td>
                                    <td>{{$det->cantidad * $det->precio_compra}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection