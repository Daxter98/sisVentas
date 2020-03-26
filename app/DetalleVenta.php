<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    //Indica la tabla a utilizar
    protected $table='detalle_venta';
    //LLave primaria de dicha table
    protected $primaryKey='iddetalle_venta';
    //No muestra mensajes
    public $timestamps=false;
    //Indica que campos son los que se
    //Van a llenar con datos en la BD
    protected $fillable =[
        'idventa',
        'idarticulo',
        'cantidad',
        'precio_venta',
        'descuento'
    ];

    //Datos no se asignan al modelo
    protected $guarded =[

    ];
}
