<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class UsuarioRol extends Model{
    protected $table="usuario_rol";
    public $timestamps=false;
    protected $fillable = ['ID','Rol','Usuario','FechaCreado','FechaActualizado','FechaEliminado'];
}
?>