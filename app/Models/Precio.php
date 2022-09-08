<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Precio extends Model{
    protected $table="precio";
    public $timestamps=false;
    protected $fillable = ['ID','Monto','Tipo','FechaCreado','FechaActualizado','FechaEliminado'];
}
?>