<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\ArticuloFormRequest;
use sisVentas\Articulo;
use DB;


class ArticuloController extends Controller
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
            $articulos = DB::table('articulo as a')
            //join hace la union de dos tablas (Tabla a unir, campo A,=,campo B)
            ->join('categoria as c','a.idcategoria','=','c.idcategoria')
            ->select('a.idarticulo', 'a.nombre', 'a.codigo', 'a.stock', 'c.nombre as categoria', 'a.descripcion', 'a.imagen', 'a.estado')
            ->where('a.nombre','LIKE','%'.$query.'%')
            ->orwhere('a.codigo','LIKE','%'.$query.'%')
            //Los ordenara por id de manera descendiente 'mas recientes'
            ->orderBy('a.idarticulo','desc')
            //Mostrara 7 registros
            ->paginate(7);

            return view('almacen.articulo.index',["articulos"=>$articulos,"searchText"=>$query]);
        }
    }

    public function create()
    {
        //Obtiene el listado de las categorias para mostrarlas en un CB
        $categorias = DB::table('categoria')->where('condicion','=','1')->get();


        return view("almacen.articulo.create",["categorias"=>$categorias]);
    }

    public function store(ArticuloFormRequest $request)
    {
        //Crea una instancia de nuestro modelo ORM Eloquent
        $articulo = new Articulo;
        //Provee parametros que requieren ser llenados
        //mediante un request del formulario ('nombre HTML') validado
        $articulo->idcategoria = $request->get('idcategoria');
        $articulo->codigo = $request->get('codigo');
        $articulo->nombre = $request->get('nombre');
        $articulo->stock = $request->get('stock');
        $articulo->descripcion = $request->get('descripcion');
        $articulo->estado = 'Activo';
        
        //Input::hasFile se asegura de que haya una imagen que cargar del formulario HTML 'imagen'
        if($request->file('imagen')->isValid())
        {
            //Almacenamos lo del formulario en una variable
            $file = $request->file('imagen');
            //Sobre esa variable aplicamos el metodo move el cual movera la imagen a la carpeta 'public'
            //Dentro de la ruta (concatenada por .) /imagenes/articulos/
            //Y el segundo parametro indicara el nombre del archivo
            $file->move(public_path().'/imagenes/articulos/', $file->getClientOriginalName());

            //En la BD solo se almacenara el nombre del archivo para despues mostrarlo en el form
            $articulo->imagen = $file->getClientOriginalName();
        }

        //Ejecuta el guardado de los datos
        $articulo->save();

        return Redirect::to('almacen/articulo'); //redirige a otra pagina
    }

    public function show($id) //Detalles del articulo o N cosa
    {
        return view("almacen.articulo.show",["articulo"=>Articulo::findOrFail($id)]);
        //mostrara los datos de una categoria almacenados en el modelo Categoria
        //donde ejecutara una busqueda media findOrFail con la id solicitada
    }

    public function edit($id)
    {
        //Selecciona un articulo en especifico
        $articulo = Articulo::findOrFail($id);
        //Obtiene las categorias activas
        $categorias = DB::table('categoria')->where('condicion','=','1')->get();

        return view("almacen.articulo.edit",["articulo"=>$articulo, "categorias"=>$categorias]);
        //LLamara a la vista edit
    }

    public function update(ArticuloFormRequest $request,$id)
    {
        $articulo=Articulo::findOrFail($id);

        $articulo->idcategoria = $request->get('idcategoria');
        $articulo->codigo = $request->get('codigo');
        $articulo->nombre = $request->get('nombre');
        $articulo->stock = $request->get('stock');
        $articulo->descripcion = $request->get('descripcion');
        
        //Input::hasFile se asegura de que haya una imagen que cargar del formulario HTML 'imagen'
        if($request->file('imagen')->isValid())
        {
            //Almacenamos lo del formulario en una variable
            $file = $request->file('imagen');
            //Sobre esa variable aplicamos el metodo move el cual movera a la carpeta 'public'
            //Dentro de la ruta (concatenada por .) /imagenes/articulos/
            //Y el segundo parametro indicara el nombre del archivo
            $file->move(public_path().'/imagenes/articulos/', $file->getClientOriginalName());
            $articulo->imagen = $file->getClientOriginalName();
        }

        $articulo->update();

        return Redirect::to('almacen/articulo');
    }

    public function destroy($id)
    {
        //declaramos objeto Articulo
        $articulo = Articulo::findOrFail($id); //<-Obtiene los valores del id seleccionado
        $articulo->estado='Inactivo';

        $articulo->update();

        return Redirect::to('almacen/articulo');
    }
}
