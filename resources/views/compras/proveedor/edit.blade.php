@extends('layouts.admin')
@section('contenido')
    <div class="row"> <!--Division Principal -->
        <div class ="col-lg-6 col-md-6 col-sm-6 col-xs-12"> <!--Seccion Principal-->
            <h3>Editar Proveedor: {{ $persona->nombre }}</h3>
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

<!--Para hacer conexion con la funcion update del Controlador se utiliza Patch-->
<!--Errores de not defined primero revisar la ruta en route-->
{!! Form::model($persona, ['method'=>'PATCH', 'route'=>['proveedor.update',$persona->idpersona]]) !!}
{{Form::token()}}
    <!--Division principal-->
    <div class="row">
        <!--Formulario dividido por columnas-->
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" required value="{{$persona->nombre}}" class="form-control" placeholder="Nombre">
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">Dirección</label>
                <input type="text" name="direccion" value="{{$persona->direccion}}" class="form-control" placeholder="Direccion">
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label>Documento</label>
                <!--CB HTML-->
                <select name="tipo_documento" class="form-control">
                        <!-- Opcion del CB Asi con todos los documentos-->
                    @if($persona->tipo_documento == 'INE')
                        <option value="INE" selected>INE</option>
                        <option value="CAR">CAR</option>
                        <option value="PAS">PAS</option>
                    @elseif($persona->tipo_documento == 'CAR')
                        <option value="INE">INE</option>
                        <option value="CAR" selected>CAR</option>
                        <option value="PAS">PAS</option>
                    @else
                        <option value="INE">INE</option>
                        <option value="CAR">CAR</option>
                        <option value="PAS" selected>PAS</option>
                    @endif
                </select>
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="num_documento">Número documento</label>
                <input type="text" name="num_documento" value="{{$persona->num_documento}}" class="form-control" placeholder="Núm Documento">
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="stock">Telefono</label>
                <input type="text" name="telefono" value="{{$persona->telefono}}" class="form-control" placeholder="Teléfono">
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="descripcion">E-Mail</label>
                <input type="email" name="email" value="{{$persona->email}}" class="form-control" placeholder="E-Mail">
            </div>
        </div>
        
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form group">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
        </div>
    </div>

{!! Form::close() !!}
@endsection