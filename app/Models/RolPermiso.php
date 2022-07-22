<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Rol;
use App\Models\Permiso;
class RolPermiso extends Model{
    protected $table="rol_permiso";
    public $timestamps=false;
    protected $fillable = ['ID','Rol','Permiso','FechaCreado','FechaActualizado','FechaEliminado'];
    public function rol_r(){
        return $this->hasOne(Rol::class,'ID','Rol');
    }
    public function permiso_r(){
        return $this->hasOne(Permiso::class,'ID','Permiso');
    }
}
?>