<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Rol;
use App\Models\Usuario;
class UsuarioRol extends Model{
    protected $table="usuario_rol";
    public $timestamps=false;
    protected $fillable = ['ID','Rol','Usuario','FechaCreado','FechaActualizado','FechaEliminado'];
    public function rols(){
        return $this->hasOne(Rol::class,'ID','Rol');
    }
    public function usuario(){
        return $this->hasOne(Usuario::class,'ID','Usuario');
    }
}
?>