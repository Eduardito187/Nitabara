<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pago;
use App\Models\Precio;
class PagoPrecio extends Model{
    protected $table="pago_precio";
    public $timestamps=false;
    protected $fillable = ['ID','Pago','Precio','FechaCreado','FechaActualizado','FechaEliminado'];
    public function pago_r(){
        return $this->hasOne(Pago::class,'ID','Pago');
    }
    public function precio_r(){
        return $this->hasOne(Precio::class,'ID','Precio');
    }
}
?>