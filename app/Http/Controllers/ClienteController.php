<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Persona;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\PersonaFormRequest;
use DB;

class ClienteController extends Controller
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
            $personas = DB::table('persona')
            //Busqueda por nombre
            ->where('nombre','LIKE','%'.$query.'%')
            //Donde la persona sea cliente
            ->where('tipo_persona','=','Cliente')
            //Num de documento
            ->orwhere('num_documento','LIKE','%'.$query.'%')
            //Donde la persona
            ->where('tipo_persona','=','Cliente')
            //Los ordenara por id de manera descendiente
            ->orderBy('idpersona','desc')
            //Mostrara 7 registros
            ->paginate(7);

            return view('ventas.cliente.index',["personas"=>$personas,"searchText"=>$query]);
        }
    }

    public function create()
    {
        return view("ventas.cliente.create");
    }

    public function store(PersonaFormRequest $request)
    {
        //Crea una instancia de nuestro modelo ORM Eloquent
        $persona = new Persona;
        //Provee parametros que requieren ser llenados
        //mediante un request del formulario validado

        $persona->tipo_persona = 'Cliente';
        $persona->nombre = $request->get('nombre');
        //condicion set to 1
        $persona->tipo_documento = $request->get('tipo_documento');
        $persona->num_documento = $request->get('num_documento');
        $persona->direccion = $request->get('direccion');
        $persona->telefono = $request->get('telefono');
        $persona->email = $request->get('email');
        //Ejecuta el guardado de los datos
        $persona->save();

        return Redirect::to('ventas/cliente'); //redirige a otra pagina index
    }

    public function show($id)
    {
        return view("ventas.cliente.show",["persona"=>Persona::findOrFail($id)]);
        //mostrara los datos de una categoria almacenados en el modelo Categoria
        //donde ejecutara una busqueda media findOrFail con la id solicitada
    }

    public function edit($id)
    {
        return view("ventas.cliente.edit",["persona"=>Persona::findOrFail($id)]);
        //LLamara a la vista edit
    }

    public function update(PersonaFormRequest $request, $id)
    {
        $persona=Persona::findOrFail($id);
        $persona->nombre = $request->get('nombre');
        $persona->tipo_documento = $request->get('tipo_documento');
        $persona->num_documento = $request->get('num_documento');
        $persona->direccion = $request->get('direccion');
        $persona->telefono = $request->get('telefono');
        $persona->email = $request->get('email');

        $persona->update();
        
        return Redirect::to('ventas/cliente');
    }

    public function destroy($id)
    {
        //declaramos objeto categoria
        $persona = Persona::findOrFail($id); //<-Obtiene los valores del id seleccionado
        $persona->tipo_persona='Inactivo';

        $persona->update();

        return Redirect::to('ventas/cliente');
    }
}
