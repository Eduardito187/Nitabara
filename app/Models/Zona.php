<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Zona extends Model{
    protected $table="zona";
    public $timestamps=false;
    protected $fillable = ['ID','Nombre','FechaCreado','FechaActualizado','FechaEliminado'];
}
?>