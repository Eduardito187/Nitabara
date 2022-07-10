<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Especialidad extends Model{
    protected $table="especialidad";
    public $timestamps=false;
    protected $fillable = ['ID','Nombre','Descripcion','FechaCreado','FechaActualizado','FechaEliminado'];
}
?>