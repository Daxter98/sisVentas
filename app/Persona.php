<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    //Indica la tabla a utilizar
    protected $table='persona';
    //LLave primaria de dicha table
    protected $primaryKey='idpersona';
    //No muestra mensajes
    public $timestamps=false;
    //Indica que campos son los que se
    //Van a llenar con datos en la BD
    protected $fillable =[
        'tipo_persona',
        'nombre',
        'tipo_documento',
        'num_documento',
        'direccion',
        'telefono',
        'email'
    ];

    //Datos no se asignan al modelo
    protected $guarded =[

    ];
}
