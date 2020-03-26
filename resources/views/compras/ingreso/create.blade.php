@extends('layouts.admin')
@section('contenido')
    <div class="row"> <!--Division de Cabecera y errores -->
        <div class ="col-lg-6 col-md-6 col-sm-6 col-xs-12"> <!--Seccion Principal-->
            <h3>Nuevo Ingreso</h3>
            @if (count($errors) > 0) <!--Control de errores-->
            <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
            @endif <!--Fin del Control de errores-->
        </div>
    </div>

{!! Form::open(array('url'=>'compras/ingreso', 'method'=>'POST', 'autocomplete'=>'off')) !!}
{{Form::token()}}
    <!--Division principal-->
    <div class="row">
        <!--Formulario dividido por columnas-->
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="form-group">
                <label for="nombre">Proveedor</label>
                <!--Para selectpicker es necesario bajar la libreria o utilizar COMPOSER y copiar a public-->
                <select name="idproveedor" id="idproveedor" class="form-control selectpicker" data-live-search="true">
                    @foreach($personas as $persona)
                        <option value="{{$persona->idpersona}}">{{$persona->nombre}} </option>
                    @endforeach
                </select>
            </div>
        </div>
        <!-- Los numero al final de cada etiqueta indican el numero de celdas a utilizar de la plantilla Bootstrap-->

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label>Tipo Comprobante</label>
                <!--CB HTML-->
                <select name="tipo_comprobante" class="form-control">
                        <!-- Opcion del CB-->
                        <option value="Boleta">Boleta</option>
                        <option value="Factura">Factura</option>
                        <option value="Ticket">Ticket</option>
                </select>
            </div>
        </div>

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="serie_comproabente">Serie Comprobante</label>
                <input type="text" name="serie_comprobante" value="{{old('serie_comprobante')}}" class="form-control" placeholder="Serie del comprobante">
            </div>
        </div>

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="num_comproabente">Número Comprobante</label>
                <input type="text" required name="num_comprobante" value="{{old('num_comprobante')}}" class="form-control" placeholder="Numero del comprobante">
            </div>
        </div>
    </div>
    <!--Bootstrap solo maneja 12 celdas-->
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-body"> 

                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                    <div class="from-group">
                        <label for="">Artículo</label>
                        <select name="pidarticulo" id="pidarticulo" class="form-control selectpicker" data-live-search="true">
                            @foreach($articulos as $articulo)
                                <option value="{{$articulo->idarticulo}}">{{$articulo->articulo}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    <div class="form-group">
                        <label for="cantidad">Cantidad</label>
                        <input type="number" name="pcantidad" id="pcantidad" class="form-control" placeholder="Cantidad">
                    </div>
                </div>

                <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    <div class="form-group">
                        <label for="precio_compra">Precio Compra</label>
                        <input type="number" name="pprecio_compra" id="pprecio_compra" class="form-control" placeholder="P. Compra">                        
                    </div>
                </div>

                <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    <div class="form-group">
                        <label for="precio_venta">Precio Venta</label>
                        <input type="number" name="pprecio_venta" id="pprecio_venta" class="form-control" placeholder="P. Venta">
                    </div>
                </div>

                <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    <div class="form-group">
                        <button type="button" id="bt_add" class="btn btn-primary">Agregar</button>
                    </div>
                </div>

                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <table id="detalles" class="table table-bordered table-striped table-condensed table-hover">
                        <thead style="background-color:#A9D0F5">
                            <th>Opciones</th>
                            <th>Artículo</th>
                            <th>Cantidad</th>
                            <th>Precio Compra</th>
                            <th>Precio Venta</th>
                            <th>Subtotal</th>
                        </thead>

                        <tfoot>
                            <th>TOTAL</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th><h4 id="total">MXN 0.00</h4></th>
                        </tfoot>

                        <tbody>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">
            <div class="form group">

                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
        </div>
    </div>
{!! Form::close() !!}
@push('scripts') <!--Permite trabajar los scripts y estos se pasan a admin -->
<script>
    //Esta funcion se ejecuta cuando carga el doc html
    $(document).ready(function(){
        //Al dar click en el boton id =  bt_add
        $('#bt_add').click(function(){
            agregar();
        });
    });

    var cont = 0;
    total = 0;
    subtotal=[]; //Array sirve para capturar todos los subtotales de las lineas de detalles
    $("#guardar").hide(); //Oculta por defecto el div guardar

    function agregar(){
        idarticulo = $('#pidarticulo').val();
        articulo = $('#pidarticulo option:selected').text();
        cantidad = $('#pcantidad').val();
        precio_compra = $("#pprecio_compra").val();
        precio_venta = $("#pprecio_venta").val();

        if(idarticulo != "" && cantidad != "" && cantidad > 0 && precio_compra != "" && precio_venta != "")
        {
            subtotal[cont] = (cantidad * precio_compra);
            total += subtotal[cont];

            var fila =  '<tr class="selected" id="fila' + cont + '"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" value="'+ idarticulo +'">'+articulo+'</td><td><input type="number" name="cantidad[]" value="'+ cantidad +'"></td><td><input type="number" name="precio_compra[]" value="'+ precio_compra +'"></td><td><input type="number" name="precio_venta[]" value="'+ precio_venta +'"></td><td>'+subtotal[cont]+'</td></tr>';            
            cont++;

            limpiar();
            $('#total').html("MXN " + total);

            evaluar();

            //Agrega la fila a la tabla
            $('#detalles').append(fila);
        }
        else
        {
            alert("Error al ingresar el detalle del ingreso, revise los datos del artículo");
        }
    }

    function limpiar(){
        //Jquery utiliza el id para obtener un control #id
        $('#pcantidad').val("");
        $('#pprecio_compra').val("");
        $('#pprecio_venta').val("");
    }

    //Funcion oculta los metodos en caso de que no haya detalles que guardar medianta
    //El div con el id guardar
    function evaluar(){
        if(total>0)
            $('#guardar').show();
        else
            $('#guardar').hide();
    }

    function eliminar(index){
        total -= subtotal[index];
        $('#total').html("MXN " + total);
        $('#fila' + index).remove();
    }
</script>
@endpush
@endsection