<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ExamenesMedicos extends Model{
    protected $table="examenes_medicos";
    public $timestamps=false;
    protected $fillable = ['ID','Persona','Descripcion','Medico','FechaCreado','FechaActualizado','FechaEliminado'];
}
?>