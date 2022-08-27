<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pago;
use App\Models\ExamenesMedicos;
class ExamenesPago extends Model{
    protected $table="examenes_pago";
    public $timestamps=false;
    protected $fillable = ['ID','Examen','Pago','Total','FechaCreado','FechaActualizado','FechaEliminado'];
    public function examen_r(){
        return $this->hasOne(ExamenesMedicos::class,'ID','Examen');
    }
    public function pago_r(){
        return $this->hasOne(Pago::class,'ID','Pago');
    }
}
?>