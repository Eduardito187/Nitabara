<?php
require('vendor/autoload.php');
use Illuminate\Database\Capsule\Manager as Capsule;
use App\database;

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
require('graphql/boot.php');

//$a=Rango::find(1);
//var_dump($a->cuenta->toArray());
?>
