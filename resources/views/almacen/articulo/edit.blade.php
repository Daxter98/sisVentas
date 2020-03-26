@extends('layouts.admin')
@section('contenido')
    <div class="row"> <!--Division Principal -->
        <div class ="col-lg-6 col-md-6 col-sm-6 col-xs-12"> <!--Seccion Principal-->
            <h3>Editar Articulo: {{ $articulo->nombre }}</h3>
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
{!! Form::model($articulo, ['method'=>'PATCH', 'route'=>['articulo.update',$articulo->idarticulo], 'files'=>'true']) !!}
{{Form::token()}}
    <!--Division principal-->
    <div class="row">
        <!--Formulario dividido por columnas-->
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" required value="{{$articulo->nombre}}" class="form-control">
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label>Categoria</label>
                <!--CB HTML-->
                <select name="idcategoria" class="form-control">
                    @foreach($categorias as $cat)
                        <!-- Opcion del CB-->
                        <!--Si la categoria que se muestra es igual a la categoria del articulo
                        se muestra seleccionado si no mostar las demas-->
                        @if($cat->idcategoria == $articulo->idcategoria)
                            <option value="{{$cat->idcategoria}}" selected>{{$cat->nombre}}</option>
                        @else
                            <option value="{{$cat->idcategoria}}">{{$cat->nombre}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="codigo">Código</label>
                <input type="text" name="codigo" required value="{{$articulo->codigo}}" class="form-control">
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="text" name="stock" required value="{{$articulo->stock}}" class="form-control">
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <input type="text" name="descripcion" value="{{$articulo->descripcion}}" class="form-control" placeholder="Descripcion del articulo">
            </div>
        </div>
        
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="imagen">Imagen</label>
                <input type="file" name="imagen" class="form-control">
                <!--Si existe la ruta de la imagen-->
                <h4>Imagen actual:</h4>
                @if(($articulo->imagen) != "")
                    <img src="{{asset('imagenes/articulos/'.$articulo->imagen)}}">
                @endif
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