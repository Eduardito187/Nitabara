<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Persona;
use App\Models\Medico;
use App\Models\CirugiaPago;
use App\Models\PersonaCirugia;
class Cirugia extends Model{
    protected $table="cirugia";
    public $timestamps=false;
    protected $fillable = ['ID','Persona','Descripcion','Medico','FechaCreado','FechaActualizado','FechaEliminado'];
    public function medico_r(){
        return $this->hasOne(Medico::class,'ID','Medico');
    }
    public function persona_r(){
        return $this->hasOne(Persona::class,'ID','Persona');
    }
    public function cirugia_pago_r(){
        return $this->hasOne(CirugiaPago::class,'Cirugia','ID');
    }
    public function persona_cirugia_r(){
        return $this->hasOne(PersonaCirugia::class,'Cirugia','ID');
    }
}
?>