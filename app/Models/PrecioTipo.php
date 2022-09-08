<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class PrecioTipo extends Model{
    protected $table="precio_tipo";
    public $timestamps=false;
    protected $fillable = ['ID','Tipo','FechaCreado','FechaActualizado','FechaEliminado'];
}
?>