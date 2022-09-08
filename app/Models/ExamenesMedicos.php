<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Persona;
use App\Models\Medico;
use App\Models\ExamenesPago;
class ExamenesMedicos extends Model{
    protected $table="examenes_medicos";
    public $timestamps=false;
    protected $fillable = ['ID','Persona','Descripcion','Medico','FechaCreado','FechaActualizado','FechaEliminado'];
    public function medico_r(){
        return $this->hasOne(Medico::class,'ID','Medico');
    }
    public function persona_r(){
        return $this->hasOne(Persona::class,'ID','Persona');
    }
    public function examen_pago_r(){
        return $this->hasOne(ExamenesPago::class,'Examen','ID');
    }
}
?>