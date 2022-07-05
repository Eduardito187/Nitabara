<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Foto;
use App\Models\Administrativo;
use App\Models\HistorialLog;
use App\Models\UsuarioRol;
class Usuario extends Model{
    protected $table="usuario";
    public $timestamps=false;
    protected $fillable = ['ID','Usuario','Pwd','Perfil','FechaCreado','FechaActualizado','FechaEliminado'];
    public function foto(){
        return $this->hasOne(Foto::class,'ID','Perfil');
    }
    public function administrativo(){
        return $this->hasOne(Administrativo::class,'Usuario','ID');
    }
    public function historial_log(){
        return $this->hasMany(HistorialLog::class,'Usuario','ID');
    }
    public function usuario_rol(){
        return $this->hasMany(UsuarioRol::class,'Usuario','ID');
    }
}
?>