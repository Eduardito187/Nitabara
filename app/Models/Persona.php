<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario;
use App\Models\TipoDocumento;
use App\Models\Ciudad;
use App\Models\Direccion;
use App\Models\Medico;
class Persona extends Model{
    protected $table="persona";
    public $timestamps=false;
    protected $fillable = ['ID','Nombre','Paterno','Materno','CI','Correo','Telefono','Nacimiento','TipoDocumento','Direccion','Ciudad','Usuario','FechaCreado','FechaActualizado','FechaEliminado'];
    public function usuario_r(){
        return $this->hasOne(Usuario::class,'ID','Usuario');
    }
    public function ciudad_r(){
        return $this->hasOne(Ciudad::class,'ID','Ciudad');
    }
    public function direccion_r(){
        return $this->hasOne(Direccion::class,'ID','Direccion');
    }
    public function tipo_documento_r(){
        return $this->hasOne(TipoDocumento::class,'ID','TipoDocumento');
    }
    public function medico_r(){
        return $this->hasOne(Medico::class,'Persona','ID');
    }
}
?>