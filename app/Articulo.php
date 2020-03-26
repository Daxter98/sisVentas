<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    //Indica la tabla a utilizar
    protected $table='articulo';
    //LLave primaria de dicha table
    protected $primaryKey='idarticulo';
    //No muestra mensajes del Query
    public $timestamps=false;
    //Indica que campos son los que se
    //Van a llenar con datos en la BD
    protected $fillable =[
        'idcategoria',
        'codigo',
        'nombre',
        'stock',
        'descripcion',
        'imagen',
        'estado'
    ];

    //Datos no se asignan al modelo
    protected $guarded =[

    ];
}
