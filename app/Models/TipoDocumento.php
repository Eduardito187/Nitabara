<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class TipoDocumento extends Model{
    protected $table="tipo_documento";
    public $timestamps=false;
    protected $fillable = ['ID','Nombre','FechaCreado','FechaActualizado','FechaEliminado'];
}
?>