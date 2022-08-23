<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario;
use App\Models\Persona;
use App\Models\Especialidad;
class Medico extends Model{
    protected $table="medico";
    public $timestamps=false;
    protected $fillable = ['ID','Persona','Especialidad','Usuario','FechaCreado','FechaActualizado','FechaEliminado'];
    public function persona_r(){
        return $this->hasOne(Persona::class,'ID','Persona');
    }
    public function especialidad_r(){
        return $this->hasOne(Especialidad::class,'ID','Especialidad');
    }
    public function usuario_r(){
        return $this->hasOne(Usuario::class,'ID','Usuario');
    }
}
?>