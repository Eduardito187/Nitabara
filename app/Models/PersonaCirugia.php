<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Persona;
use App\Models\Cirugia;
class PersonaCirugia extends Model{
    protected $table="persona_cirugia";
    public $timestamps=false;
    protected $fillable = ['ID','Persona','Cirugia','HoraAtencion','FechaCreado','FechaActualizado','FechaEliminado'];
    public function persona_r(){
        return $this->hasOne(Persona::class,'ID','Persona');
    }
    public function cirugia_r(){
        return $this->hasOne(Cirugia::class,'ID','Cirugia');
    }
}
?>