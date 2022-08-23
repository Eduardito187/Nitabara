<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Consulta;
use App\Models\Pago;
class ConsultaPago extends Model{
    protected $table="consulta_pago";
    public $timestamps=false;
    protected $fillable = ['ID','Pago','Consulta','Descripcion','Total','FechaCreado','FechaActualizado','FechaEliminado'];
    public function consulta_r(){
        return $this->hasOne(Consulta::class,'ID','Consulta');
    }
    public function pago_r(){
        return $this->hasOne(Pago::class,'ID','Pago');
    }
}
?>