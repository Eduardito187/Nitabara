<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cirugia;
use App\Models\Pago;
class CirugiaPago extends Model{
    protected $table="cirugia_pago";
    public $timestamps=false;
    protected $fillable = ['ID','Cirugia','Pago','Total','FechaCreado','FechaActualizado','FechaEliminado'];
    public function cirugia_r(){
        return $this->hasOne(Cirugia::class,'ID','Cirugia');
    }
    public function pago_r(){
        return $this->hasOne(Pago::class,'ID','Pago');
    }
}
?>