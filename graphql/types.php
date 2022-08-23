<?php

use App\Models\Administrativo;
use App\Models\Cirugia;
use App\Models\CirugiaPago;
use App\Models\Consulta;
use App\Models\ConsultaPago;
use App\Models\Direccion;
use App\Models\Medico;
use App\Models\Pago;
use App\Models\PagoPrecio;
use App\Models\Persona;
use App\Models\PersonaCirugia;
use App\Models\PersonaConsulta;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\Models\Usuario;
use App\Models\UsuarioRol;
use App\Models\Rol;
use App\Models\RolPermiso;

$validacionLoginType=new ObjectType([
    'name' => 'Validacion_de_Login',
    'description' => 'Se valida el inicio al sistema',
    'fields'=>[
        'estado'=>Type::boolean(),
        'id_cuenta'=>Type::int()
    ]
]);

$ResponseType=new ObjectType([
    'name' => 'ResponseType',
    'description' => 'ResponseType',
    'fields'=>[
        'response'=>Type::boolean(),
    ]
]);



$ZonaType=new ObjectType([
    'name' => 'ZonaType',
    'description' => 'ZonaType',
    'fields'=>[
        'ID'=>Type::int(),
        'Nombre'=>Type::string(),
        'FechaCreado'=>Type::string(),
        'FechaActualizado'=>Type::string(),
        'FechaEliminado'=>Type::string()
    ]
]);
?>