<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class HistoriaClinica extends Model{
    protected $table="historia_clinica";
    public $timestamps=false;
    protected $fillable = ['ID','Persona','Tipo','Medico','FechaCreado','FechaActualizado','FechaEliminado'];
}
?>