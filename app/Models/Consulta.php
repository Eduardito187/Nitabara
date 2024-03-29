<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Medico;
use App\Models\ConsultaPago;
use App\Models\Persona;
class Consulta extends Model{
    protected $table="consulta";
    public $timestamps=false;
    protected $fillable = ['ID','Persona','Medico','Descripcion','Hora','FechaCreado','FechaActualizado','FechaEliminado'];
    public function medico_r(){
        return $this->hasOne(Medico::class,'ID','Medico');
    }
    public function consulta_pago_r(){
        return $this->hasOne(ConsultaPago::class,'Consulta','ID');
    }
    public function persona_r(){
        return $this->hasOne(Persona::class,'ID','Persona');
    }
}
?>