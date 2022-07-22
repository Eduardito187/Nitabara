<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\RolPermiso;
class Rol extends Model{
    protected $table="rol";
    public $timestamps=false;
    protected $fillable = ['ID','Rol','FechaCreado','FechaActualizado','FechaEliminado'];
    public function rol_permiso_r(){
        return $this->hasMany(RolPermiso::class,'Rol','ID');
    }
}
?>