<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ExamenesPago extends Model{
    protected $table="examenes_pago";
    public $timestamps=false;
    protected $fillable = ['ID','Examen','Pago','Total','FechaCreado','FechaActualizado','FechaEliminado'];
}
?>