<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Persona;
use App\Models\Consulta;
class PersonaConsulta extends Model{
    protected $table="persona_consulta";
    public $timestamps=false;
    protected $fillable = ['ID','Persona','Consulta','FechaCreado','FechaActualizado','FechaEliminado'];
    public function persona_r(){
        return $this->hasOne(Persona::class,'ID','Persona');
    }
    public function consulta_r(){
        return $this->hasOne(Consulta::class,'ID','Consulta');
    }
}
?>