<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ConsultaPago extends Model{
    protected $table="consulta_pago";
    public $timestamps=false;
    protected $fillable = ['ID','Pago','Consulta','Descripcion','Total','FechaCreado','FechaActualizado','FechaEliminado'];
}
?>