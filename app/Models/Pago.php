<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Administrativo;
class Pago extends Model{
    protected $table="pago";
    public $timestamps=false;
    protected $fillable = ['ID','Monto','Administrativo','FechaCreado','FechaActualizado','FechaEliminado'];
    public function administrativo_r(){
        return $this->hasOne(Administrativo::class,'ID','Administrativo');
    }
}
?>