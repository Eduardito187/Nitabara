<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Cirugia extends Model{
    protected $table="cirugia";
    public $timestamps=false;
    protected $fillable = ['ID','Persona','Descripcion','Medico','FechaCreado','FechaActualizado','FechaEliminado'];
}
?>