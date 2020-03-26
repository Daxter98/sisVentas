<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Categoria;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\CategoriaFormRequest;
use DB;

class CategoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if($request)
        {
            //Obtenemos el valor de un futuro txtBox nombrado searchText mediante metodo GET
            //Trim remueve espacios
            $query = trim($request->get('searchText'));
            //Categoria buscara en la tabla del mismo nombre
            //donde el nombre sea parecido al texto de $query 
            $categoria = DB::table('categoria')->where('nombre','LIKE','%'.$query.'%')
            //Donde la condicion este activa
            ->where('condicion','=','1')
            //Los ordenara por id de manera descendiente
            ->orderBy('idcategoria','desc')
            //Mostrara 7 registros
            ->paginate(7);

            return view('almacen.categoria.index',["categorias"=>$categoria,"searchText"=>$query]);
        }
    }

    public function create()
    {
        return view("almacen.categoria.create");
    }

    public function store(CategoriaFormRequest $request)
    {
        //Crea una instancia de nuestro modelo ORM Eloquent
        $categoria = new Categoria;
        //Provee parametros que requieren ser llenados
        //mediante un request del formulario validado
        $categoria->nombre = $request->get('nombre');
        $categoria->descripcion = $request->get('descripcion');
        //condicion set to 1
        $categoria->condicion='1';
        //Ejecuta el guardado de los datos
        $categoria->save();

        return Redirect::to('almacen/categoria'); //redirige a otra pagina
    }

    public function show($id)
    {
        return view("almacen.categoria.show",["categoria"=>Categoria::findOrFail($id)]);
        //mostrara los datos de una categoria almacenados en el modelo Categoria
        //donde ejecutara una busqueda media findOrFail con la id solicitada
    }

    public function edit($id)
    {
        return view("almacen.categoria.edit",["categoria"=>Categoria::findOrFail($id)]);
        //LLamara a la vista edit
    }

    public function update(CategoriaFormRequest $request,$id)
    {
        $categoria=Categoria::findOrFail($id);
        $categoria->nombre=$request->get('nombre');
        $categoria->descripcion=$request->get('descripcion');
        $categoria->update();
        
        return Redirect::to('almacen/categoria');
    }

    public function destroy($id)
    {
        //declaramos objeto categoria
        $categoria = Categoria::findOrFail($id); //<-Obtiene los valores del id seleccionado
        $categoria->condicion='0';

        $categoria->update();

        return Redirect::to('almacen/categoria');
    }
}
