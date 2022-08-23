<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Medico;
class Especialidad extends Model{
    protected $table="especialidad";
    public $timestamps=false;
    protected $fillable = ['ID','Nombre','Descripcion','FechaCreado','FechaActualizado','FechaEliminado'];
    public function medico_r(){
        return $this->hasMany(Medico::class,'Especialidad','ID');
    }
}
?>