<?php
require('vendor/autoload.php');
use Illuminate\Database\Capsule\Manager as Capsule;
use App\database;
use App\Models\Foto;
use App\Models\Usuario;

$capsule = new Capsule;

$capsule->addConnection([
    'driver' => 'mysql',
    'host' => database::server,
    'database' => database::database,
    'username' => database::user,
    'password' => database::password,
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();

header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

if (isset($_FILES["file"]) && isset($_GET["ID"])) {
    $cuenta=Usuario::find($_GET["ID"]);
    if ($cuenta==null) {
        echo "Cuenta Invalida.";
    }else{
        $extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
        $n=$cuenta->Usuario.".".$extension;
        $dir="./graphql/perfiles/".$n;
        
        $Foto = Foto::find($cuenta->Perfil);
        chmod("./graphql/perfiles/", 0755);
        if (file_exists($Foto->Direccion)) {
            unlink($Foto->Direccion);
        }
        
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $dir)) {

            $publi = "http://nitabara.grazcompany.com/graphql/perfiles/".$n;
            $date_ahora_p=date("Y-m-d h:i:s");
            $admin=new Foto([
                'ID'=>NULL,
                'URLPublica'=>$publi,
                'Direccion'=>$dir,
                'Peso'=>"",
                'Formato'=>"",
                'FechaCreado'=>$date_ahora_p,
                'FechaActualizado'=>NULL,
                'FechaEliminado'=>NULL
            ]);
            $x=$admin->save();

            $FT = Foto::where('URLPublica',$publi)->where('FechaCreado',$date_ahora_p)->first(); 

            Usuario::where('ID', $_GET["ID"])->update([
                'Perfil' => $FT->ID,
                'FechaActualizado' => $date_ahora_p
            ]);
            echo "Archivo Subido.";
        } else {
            echo "Error al subir la foto.";
        }
    }
}else{
    echo "Error en envio.";
}
?>
