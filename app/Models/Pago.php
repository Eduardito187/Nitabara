<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Pago extends Model{
    protected $table="pago";
    public $timestamps=false;
    protected $fillable = ['ID','Monto','Administrativo','FechaCreado','FechaActualizado','FechaEliminado'];
}
?>