<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class PersonaExamen extends Model{
    protected $table="persona_examen";
    public $timestamps=false;
    protected $fillable = ['ID','Persona','Examen','FechaCreado','FechaActualizado','FechaEliminado'];
}
?>