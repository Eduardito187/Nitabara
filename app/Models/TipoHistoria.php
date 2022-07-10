<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class TipoHistoria extends Model{
    protected $table="tipo_historia";
    public $timestamps=false;
    protected $fillable = ['ID','Tipo','Glosa','FechaCreado','FechaActualizado','FechaEliminado'];
}
?>