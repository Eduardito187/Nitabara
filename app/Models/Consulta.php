<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Consulta extends Model{
    protected $table="consulta";
    public $timestamps=false;
    protected $fillable = ['ID','Medico','Descripcion','Hora','FechaCreado','FechaActualizado','FechaEliminado'];
}
?>