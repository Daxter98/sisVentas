<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    //Indica la tabla a utilizar
    protected $table='ingreso';
    //LLave primaria de dicha table
    protected $primaryKey='idingreso';
    //No muestra mensajes
    public $timestamps=false;
    //Indica que campos son los que se
    //Van a llenar con datos en la BD
    protected $fillable =[
        'idproveedor',
        'tipo_comprobante',
        'serie_comprobante',
        'num_comprobante',
        'fecha_hora',
        'impuesto',
        'estado'
    ];

    //Datos no se asignan al modelo
    protected $guarded =[

    ];
}
