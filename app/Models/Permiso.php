<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\RolPermiso;
class Permiso extends Model{
    protected $table="permiso";
    public $timestamps=false;
    protected $fillable = ['ID','Nombre','Codigo','FechaCreado','FechaActualizado','FechaEliminado'];
    public function rol_permiso_r(){
        return $this->hasMany(RolPermiso::class,'Permiso','ID');
    }
}
?>