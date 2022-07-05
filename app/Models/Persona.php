<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Persona extends Model{
    protected $table="persona";
    public $timestamps=false;
    protected $fillable = ['ID','Nombre','Paterno','Materno','Correo','Telefono','Nacimiento','TipoDocumento','Direccion','Ciudad','Usuario','FechaCreado','FechaActualizado','FechaEliminado'];
}
?>