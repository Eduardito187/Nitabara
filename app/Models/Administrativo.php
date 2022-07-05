<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Administrativo extends Model{
    protected $table="historial_log";
    public $timestamps=false;
    protected $fillable = ['ID','Usuario','Persona','FechaCreado','FechaActualizado','FechaEliminado'];
}
?>