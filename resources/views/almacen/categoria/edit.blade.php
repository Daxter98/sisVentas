@extends('layouts.admin')
@section('contenido')
    <div class="row"> <!--Division Principal -->
        <div class ="col-lg-6 col-md-6 col-sm-6 col-xs-12"> <!--Seccion Principal-->
            <h3>Editar Categoría: {{ $categoria -> nombre }}</h3>
            @if (count($errors) > 0) <!--Control de errores-->
            <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
            @endif <!--Fin del Control de errores-->

            <!--Para hacer conexion con la funcion update del Controlador se utiliza Patch-->
            <!--Errores de not defined primero revisar la ruta en route-->
            {!! Form::model($categoria, ['method'=>'PATCH', 'route'=>['categoria.update',$categoria->idcategoria]]) !!}
            {{Form::token()}}
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value ="{{$categoria->nombre}}" placeholder="Nombre">
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <input type="text" name="descripcion" class="form-control" value="{{$categoria->descripcion}}" placeholder="Descripcion">
                </div>
                <div class="form group">
                    <button class="btn btn-primary" type="submit">Guardar</button>
                    <button class="btn btn-danger" type="reset">Cancelar</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div
@endsection