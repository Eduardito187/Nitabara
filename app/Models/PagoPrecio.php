<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class PagoPrecio extends Model{
    protected $table="pago_precio";
    public $timestamps=false;
    protected $fillable = ['ID','Pago','Precio','FechaCreado','FechaActualizado','FechaEliminado'];
}
?>