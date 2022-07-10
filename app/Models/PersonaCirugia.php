<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class PersonaCirugia extends Model{
    protected $table="persona_cirugia";
    public $timestamps=false;
    protected $fillable = ['ID','Persona','Cirugia','HoraAtencion','FechaCreado','FechaActualizado','FechaEliminado'];
}
?>