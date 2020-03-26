<!--'url'=>'almacen/articulo' indica a donde seran enviados los valoers/archivos-->
{!! Form::open(array('url'=>'almacen/articulo','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
<div class="form-group">
    <div class="input-group">
     <!--Value muestra el parametro recibido por el Request-->
        <input type="text" class="form-control" name="searchText" placeholder="Buscar" value="{{$searchText}}">
        <span class="input-group-btn"> <!--Division en linea-->
            <button type="submit" class="btn btn-primary">Buscar</button>
        </span>
    </div>
</div>
{{Form::close()}}