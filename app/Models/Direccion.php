<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Zona;
use App\Models\Barrio;
class Direccion extends Model{
    protected $table="direccion";
    public $timestamps=false;
    protected $fillable = ['ID','Zona','Barrio','Calle','Casa','FechaCreado','FechaActualizado','FechaEliminado'];
    public function zona_r(){
        return $this->hasOne(Zona::class,'ID','Zona');
    }
    public function barrio_r(){
        return $this->hasOne(Barrio::class,'ID','Barrio');
    }
}
?>