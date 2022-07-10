<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Medico extends Model{
    protected $table="medico";
    public $timestamps=false;
    protected $fillable = ['ID','Persona','Especialidad','Usuario','FechaCreado','FechaActualizado','FechaEliminado'];
}
?>