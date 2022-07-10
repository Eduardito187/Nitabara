<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class RolPermiso extends Model{
    protected $table="rol_permiso";
    public $timestamps=false;
    protected $fillable = ['ID','Rol','Permiso','FechaCreado','FechaActualizado','FechaEliminado'];
}
?>