<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class CirugiaPago extends Model{
    protected $table="cirugia_pago";
    public $timestamps=false;
    protected $fillable = ['ID','Cirugia','Pago','Total','FechaCreado','FechaActualizado','FechaEliminado'];
}
?>