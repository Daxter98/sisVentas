<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //Indica la tabla a utilizar
    protected $table='categoria';
    //LLave primaria de dicha table
    protected $primaryKey='idcategoria';
    //No muestra mensajes
    public $timestamps=false;
    //Indica que campos son los que se
    //Van a llenar con datos en la BD
    protected $fillable =[
        'nombre',
        'descripcion',
        'condicion'
    ];

    //Datos no se asignan al modelo
    protected $guarded =[

    ];
}
