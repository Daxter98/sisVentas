<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class DetalleIngreso extends Model
{
    //Indica la tabla a utilizar
    protected $table='detalle_ingreso';
    //LLave primaria de dicha table
    protected $primaryKey='iddetalle_ingreso';
    //No muestra mensajes
    public $timestamps=false;
    //Indica que campos son los que se
    //Van a llenar con datos en la BD
    protected $fillable =[
        'idingreso',
        'idarticulo',
        'cantidad',
        'precio_compra',
        'precio_venta'
    ];

    //Datos no se asignan al modelo
    protected $guarded =[

    ];
}
