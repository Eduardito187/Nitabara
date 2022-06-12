<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class PersonaPermiso extends Model{
    protected $table="persona_permiso";
    public $timestamps=false;
    protected $fillable = ['ID','Rango','Permisos','FechaCreado','FechaActualizado','FechaEliminado'];
}
?>