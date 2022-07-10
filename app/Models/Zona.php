<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class PersonaConsulta extends Model{
    protected $table="persona_consulta";
    public $timestamps=false;
    protected $fillable = ['ID','Nombre','FechaCreado','FechaActualizado','FechaEliminado'];
}
?>