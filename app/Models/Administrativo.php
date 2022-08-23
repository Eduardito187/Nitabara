<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario;
use App\Models\Persona;
class Administrativo extends Model{
    protected $table="historial_log";
    public $timestamps=false;
    protected $fillable = ['ID','Usuario','Persona','FechaCreado','FechaActualizado','FechaEliminado'];
    public function usuario_r(){
        return $this->hasOne(Usuario::class,'ID','Usuario');
    }
    public function persona_r(){
        return $this->hasOne(Persona::class,'ID','Persona');
    }
}
?>