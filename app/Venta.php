<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    //Indica la tabla a utilizar
    protected $table='venta';
    //LLave primaria de dicha table
    protected $primaryKey='idventa';
    //No muestra mensajes
    public $timestamps=false;
    //Indica que campos son los que se
    //Van a llenar con datos en la BD
    protected $fillable =[
        'idcliente',
        'tipo_comprobante',
        'serie_comprobante',
        'num_comprobante',
        'fecha_hora',
        'impuesto',
        'total_venta',
        'estado'
    ];

    //Datos no se asignan al modelo
    protected $guarded =[

    ];
}
