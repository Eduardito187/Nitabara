<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class TipoMoney extends Model{
    protected $table="tipo_money";
    public $timestamps=false;
    protected $fillable = ['ID','Tipo','FechaCreado','FechaActualizado','FechaEliminado'];
}
?>