<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Persona extends Model{
    protected $table="persona";
    public $timestamps=false;
    protected $fillable = ['ID','Nombre','Paterno','Materno','Correo','Telefono','CI','Nacimiento','TipoDocumento','Direccion','Ciudad','TipoPago','TipoCobro','N_Cuenta','FechaCreado','FechaActualizado','FechaEliminado'];
}
?>