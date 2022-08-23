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


$UsuarioType=new ObjectType([
    'name' => 'UsuarioType',
    'description' => 'Se valida el inicio al sistema',
    'fields' => function () use(&$PersonaType,&$FotoType,&$UsuarioRolType,&$AdministrativoType,&$HistorialLogType){
        return [
            'ID'=>Type::int(),
            'Usuario'=>Type::string(),
            'Pwd'=>Type::string(),
            'Perfil'=>[
                "type" => $FotoType,
                "resolve" => function ($root, $args) {
                    $id = $root['ID'];
                    $data = Usuario::where('ID', $id)->with(['foto'])->first();
                    if ($data->foto==null) {
                        return null;
                    }
                    return $data->foto->toArray();
                }
            ],
            'State'=>Type::boolean(),
            'FechaCreado'=>Type::string(),
            'FechaActualizado'=>Type::string(),
            'FechaEliminado'=>Type::string(),
            'Roles'=>[
                "type" => Type::listOf($UsuarioRolType),
                "resolve" => function ($root, $args) {
                    $id = $root['ID'];
                    $data = Usuario::where('ID', $id)->with(['usuario_rol'])->first();
                    if ($data->usuario_rol==null) {
                        return null;
                    }
                    return $data->usuario_rol->toArray();
                }
            ],
            'Administrativo'=>[
                "type" => $AdministrativoType,
                "resolve" => function ($root, $args) {
                    $id = $root['ID'];
                    $data = Usuario::where('ID', $id)->with(['administrativo'])->first();
                    if ($data->administrativo==null) {
                        return null;
                    }
                    return $data->administrativo->toArray();
                }
            ],
            'HistorialLog'=>[
                "type" => Type::listOf($HistorialLogType),
                "resolve" => function ($root, $args) {
                    $id = $root['ID'];
                    $data = Usuario::where('ID', $id)->with(['historial_log'])->first();
                    if ($data->historial_log==null) {
                        return null;
                    }
                    return $data->historial_log->toArray();
                }
            ],
            'Persona'=>[
                "type" => $PersonaType,
                "resolve" => function ($root, $args) {
                    $id = $root['ID'];
                    $data = Usuario::where('ID', $id)->with(['persona'])->first();
                    if ($data->persona==null) {
                        return null;
                    }
                    return $data->persona->toArray();
                }
            ],
        ];
    }
]);

$FotoType=new ObjectType([
    'name' => 'FotoType',
    'description' => 'Data FOTO',
    'fields'=>[
        'ID'=>Type::int(),
        'URLPublica'=>Type::string(),
        'Direccion'=>Type::string(),
        'Peso'=>Type::string(),
        'Formato'=>Type::string(),
        'FechaCreado'=>Type::string(),
        'FechaActualizado'=>Type::string(),
        'FechaEliminado'=>Type::string()
    ]
]);

$AdministrativoType=new ObjectType([
    'name' => 'AdministrativoType',
    'description' => 'AdministrativoType',
    'fields' => function () use(&$UsuarioType,&$PersonaType){
        return [
            'ID'=>Type::int(),
            'Usuario'=>[
                "type" => $UsuarioType,
                "resolve" => function ($root, $args) {
                    $id = $root['ID'];
                    $data = Administrativo::where('ID', $id)->with(['usuario_r'])->first();
                    if ($data->usuario_r==null) {
                        return null;
                    }
                    return $data->usuario_r->toArray();
                }
            ],
            'Persona'=>[
                "type" => $PersonaType,
                "resolve" => function ($root, $args) {
                    $id = $root['ID'];
                    $data = Administrativo::where('ID', $id)->with(['persona_r'])->first();
                    if ($data->persona_r==null) {
                        return null;
                    }
                    return $data->persona_r->toArray();
                }
            ],
            'FechaCreado'=>Type::string(),
            'FechaActualizado'=>Type::string(),
            'FechaEliminado'=>Type::string()
        ];
    }
]);

$BarrioType=new ObjectType([
    'name' => 'BarrioType',
    'description' => 'BarrioType',
    'fields'=>[
        'ID'=>Type::int(),
        'Nombre'=>Type::string(),
        'FechaCreado'=>Type::string(),
        'FechaActualizado'=>Type::string(),
        'FechaEliminado'=>Type::string()
    ]
]);

$CirugiaType=new ObjectType([
    'name' => 'CirugiaType',
    'description' => 'CirugiaType',
    'fields' => function () use(&$MedicoType,&$PersonaType,&$CirugiaPagoType){
        return [
            'ID'=>Type::int(),
            'Persona'=>[
                "type" => $PersonaType,
                "resolve" => function ($root, $args) {
                    $id = $root['ID'];
                    $data = Cirugia::where('ID', $id)->with(['persona_r'])->first();
                    if ($data->persona_r==null) {
                        return null;
                    }
                    return $data->persona_r->toArray();
                }
            ],
            'Descripcion'=>Type::string(),
            'Medico'=>[
                "type" => $MedicoType,
                "resolve" => function ($root, $args) {
                    $id = $root['ID'];
                    $data = Cirugia::where('ID', $id)->with(['medico_r'])->first();
                    if ($data->medico_r==null) {
                        return null;
                    }
                    return $data->medico_r->toArray();
                }
            ],
            'Pago'=>[
                "type" => $CirugiaPagoType,
                "resolve" => function ($root, $args) {
                    $id = $root['ID'];
                    $data = Cirugia::where('ID', $id)->with(['cirugia_pago_r'])->first();
                    if ($data->cirugia_pago_r==null) {
                        return null;
                    }
                    return $data->cirugia_pago_r->toArray();
                }
            ],
            'FechaCreado'=>Type::string(),
            'FechaActualizado'=>Type::string(),
            'FechaEliminado'=>Type::string()
        ];
    }
]);

$CirugiaPagoType=new ObjectType([
    'name' => 'CirugiaType',
    'description' => 'CirugiaPagoType',
    'fields' => function () use(&$CirugiaType,&$PagoType){
        return [
            'ID'=>Type::int(),
            'Cirugia'=>[
                "type" => $CirugiaType,
                "resolve" => function ($root, $args) {
                    $id = $root['ID'];
                    $data = CirugiaPago::where('ID', $id)->with(['cirugia_r'])->first();
                    if ($data->cirugia_r==null) {
                        return null;
                    }
                    return $data->cirugia_r->toArray();
                }
            ],
            'Pago'=>[
                "type" => $PagoType,
                "resolve" => function ($root, $args) {
                    $id = $root['ID'];
                    $data = CirugiaPago::where('ID', $id)->with(['pago_r'])->first();
                    if ($data->pago_r==null) {
                        return null;
                    }
                    return $data->pago_r->toArray();
                }
            ],
            'Total'=>Type::float(),
            'FechaCreado'=>Type::string(),
            'FechaActualizado'=>Type::string(),
            'FechaEliminado'=>Type::string()
        ];
    }
]);

$CiudadType=new ObjectType([
    'name' => 'CiudadType',
    'description' => 'CiudadType',
    'fields'=>[
        'ID'=>Type::int(),
        'Nombre'=>Type::string(),
        'FechaCreado'=>Type::string(),
        'FechaActualizado'=>Type::string(),
        'FechaEliminado'=>Type::string()
    ]
]);

$ConsultaType=new ObjectType([
    'name' => 'ConsultaType',
    'description' => 'ConsultaType',
    'fields' => function () use(&$MedicoType,&$ConsultaPagoType){
        return [
            'ID'=>Type::int(),
            'Medico'=>[
                "type" => $MedicoType,
                "resolve" => function ($root, $args) {
                    $id = $root['ID'];
                    $data = Consulta::where('ID', $id)->with(['medico_r'])->first();
                    if ($data->medico_r==null) {
                        return null;
                    }
                    return $data->medico_r->toArray();
                }
            ],
            'Descripcion'=>Type::string(),
            'Hora'=>Type::string(),
            'FechaCreado'=>Type::string(),
            'FechaActualizado'=>Type::string(),
            'FechaEliminado'=>Type::string(),
            'Pago'=>[
                "type" => $ConsultaPagoType,
                "resolve" => function ($root, $args) {
                    $id = $root['ID'];
                    $data = Consulta::where('ID', $id)->with(['consulta_pago_r'])->first();
                    if ($data->consulta_pago_r==null) {
                        return null;
                    }
                    return $data->consulta_pago_r->toArray();
                }
            ],
        ];
    }
]);

$ConsultaPagoType=new ObjectType([
    'name' => 'ConsultaPagoType',
    'description' => 'ConsultaPagoType',
    'fields' => function () use(&$ConsultaType,&$PagoType){
        return [
            'ID'=>Type::int(),
            'Pago'=>[
                "type" => $PagoType,
                "resolve" => function ($root, $args) {
                    $id = $root['ID'];
                    $data = ConsultaPago::where('ID', $id)->with(['pago_r'])->first();
                    if ($data->pago_r==null) {
                        return null;
                    }
                    return $data->pago_r->toArray();
                }
            ],
            'Consulta'=>[
                "type" => $ConsultaType,
                "resolve" => function ($root, $args) {
                    $id = $root['ID'];
                    $data = ConsultaPago::where('ID', $id)->with(['consulta_r'])->first();
                    if ($data->consulta_r==null) {
                        return null;
                    }
                    return $data->consulta_r->toArray();
                }
            ],
            'Descripcion'=>Type::string(),
            'Total'=>Type::float(),
            'FechaCreado'=>Type::string(),
            'FechaActualizado'=>Type::string(),
            'FechaEliminado'=>Type::string()
        ];
    }
]);

$DireccionType=new ObjectType([
    'name' => 'DireccionType',
    'description' => 'DireccionType',
    'fields' => function () use(&$ZonaType,&$BarrioType){
        return [
            'ID'=>Type::int(),
            'Zona'=>[
                "type" => $ZonaType,
                "resolve" => function ($root, $args) {
                    $id = $root['ID'];
                    $data = Direccion::where('ID', $id)->with(['zona_r'])->first();
                    if ($data->zona_r==null) {
                        return null;
                    }
                    return $data->zona_r->toArray();
                }
            ],
            'Barrio'=>[
                "type" => $BarrioType,
                "resolve" => function ($root, $args) {
                    $id = $root['ID'];
                    $data = Direccion::where('ID', $id)->with(['barrio_r'])->first();
                    if ($data->barrio_r==null) {
                        return null;
                    }
                    return $data->barrio_r->toArray();
                }
            ],
            'Calle'=>Type::string(),
            'Casa'=>Type::string(),
            'FechaCreado'=>Type::string(),
            'FechaActualizado'=>Type::string(),
            'FechaEliminado'=>Type::string()
        ];
    }
]);

$EspecialidadType=new ObjectType([
    'name' => 'EspecialidadType',
    'description' => 'EspecialidadType',
    'fields'=>[
        'ID'=>Type::int(),
        'Nombre'=>Type::string(),
        'Descripcion'=>Type::string(),
        'FechaCreado'=>Type::string(),
        'FechaActualizado'=>Type::string(),
        'FechaEliminado'=>Type::string()
    ]
]);

$ExamenesMedicosType=new ObjectType([
    'name' => 'ExamenesMedicosType',
    'description' => 'ExamenesMedicosType',
    'fields'=>[
        'ID'=>Type::int(),
        'Persona'=>Type::int(),
        'Descripcion'=>Type::string(),
        'Medico'=>Type::int(),
        'FechaCreado'=>Type::string(),
        'FechaActualizado'=>Type::string(),
        'FechaEliminado'=>Type::string()
    ]
]);

$ExamenesPagosType=new ObjectType([
    'name' => 'ExamenesPagosType',
    'description' => 'ExamenesPagosType',
    'fields'=>[
        'ID'=>Type::int(),
        'Examen'=>Type::int(),
        'Pago'=>Type::int(),
        'Total'=>Type::float(),
        'FechaCreado'=>Type::string(),
        'FechaActualizado'=>Type::string(),
        'FechaEliminado'=>Type::string()
    ]
]);

$PersonaType=new ObjectType([
    'name' => 'PersonaType',
    'description' => 'Data Persona',
    'fields' => function () use(&$TipoDocumentoType,&$DireccionType,&$CiudadType,&$UsuarioType){
        return [
            'ID'=>Type::int(),
            'Nombre'=>Type::string(),
            'Paterno'=>Type::string(),
            'Materno'=>Type::string(),
            'CI'=>Type::string(),
            'Correo'=>Type::string(),
            'Telefono'=>Type::string(),
            'Nacimiento'=>Type::string(),
            'TipoDocumento'=>[
                "type" => $TipoDocumentoType,
                "resolve" => function ($root, $args) {
                    $id = $root['ID'];
                    $data = Persona::where('ID', $id)->with(['tipo_documento_r'])->first();
                    if ($data->tipo_documento_r==null) {
                        return null;
                    }
                    return $data->tipo_documento_r->toArray();
                }
            ],
            'Direccion'=>[
                "type" => $DireccionType,
                "resolve" => function ($root, $args) {
                    $id = $root['ID'];
                    $data = Persona::where('ID', $id)->with(['direccion_r'])->first();
                    if ($data->direccion_r==null) {
                        return null;
                    }
                    return $data->direccion_r->toArray();
                }
            ],
            'Ciudad'=>[
                "type" => $CiudadType,
                "resolve" => function ($root, $args) {
                    $id = $root['ID'];
                    $data = Persona::where('ID', $id)->with(['ciudad_r'])->first();
                    if ($data->ciudad_r==null) {
                        return null;
                    }
                    return $data->ciudad_r->toArray();
                }
            ],
            'Usuario'=>[
                "type" => $UsuarioType,
                "resolve" => function ($root, $args) {
                    $id = $root['ID'];
                    $data = Persona::where('ID', $id)->with(['usuario_r'])->first();
                    if ($data->usuario_r==null) {
                        return null;
                    }
                    return $data->usuario_r->toArray();
                }
            ],
            'FechaCreado'=>Type::string(),
            'FechaActualizado'=>Type::string(),
            'FechaEliminado'=>Type::string()
        ];
    }
]);

$HistorialLogType=new ObjectType([
    'name' => 'HistorialLogType',
    'description' => 'Data HISTORIAL LOG',
    'fields'=>[
        'ID'=>Type::int(),
        'Usuario'=>Type::int(),
        'Log'=>Type::boolean(),
        'IP'=>Type::string(),
        'FechaCreado'=>Type::string(),
        'FechaActualizado'=>Type::string(),
        'FechaEliminado'=>Type::string()
    ]
]);

$UsuarioRolType=new ObjectType([
    'name' => 'UsuarioRolType',
    'description' => 'Data USUARIO ROL',
    'fields' => function () use(&$RolType,&$UsuarioType){
        return [
            'ID'=>Type::int(),
            'Rol'=>[
                "type" => $RolType,
                "resolve" => function ($root, $args) {
                    $id = $root['ID'];
                    $data = UsuarioRol::where('ID', $id)->with(['rols'])->first();
                    if ($data->rols==null) {
                        return null;
                    }
                    return $data->rols->toArray();
                }
            ],
            'Usuario'=>[
                "type" => $UsuarioType,
                "resolve" => function ($root, $args) {
                    $id = $root['ID'];
                    $data = UsuarioRol::where('ID', $id)->with(['usuario'])->first();
                    if ($data->usuario==null) {
                        return null;
                    }
                    return $data->usuario->toArray();
                }
            ],
            'FechaCreado'=>Type::string(),
            'FechaActualizado'=>Type::string(),
            'FechaEliminado'=>Type::string()
        ];
    }
]);

$RolType=new ObjectType([
    'name' => 'RolType',
    'description' => 'Data ROL',
    'fields' => function () use(&$RolPermisoType){
        return [
            'ID'=>Type::int(),
            'Rol'=>Type::string(),
            'FechaCreado'=>Type::string(),
            'FechaActualizado'=>Type::string(),
            'FechaEliminado'=>Type::string(),
            'RolPermiso'=>[
                "type" => Type::listOf($RolPermisoType),
                "resolve" => function ($root, $args) {
                    $id = $root['ID'];
                    $data = Rol::where('ID', $id)->with(['rol_permiso_r'])->first();
                    if ($data->rol_permiso_r==null) {
                        return null;
                    }
                    return $data->rol_permiso_r->toArray();
                }
            ],
        ];
    }
]);

$HistoriaClinicaType=new ObjectType([
    'name' => 'HistoriaClinicaType',
    'description' => 'HistoriaClinicaType',
    'fields'=>[
        'ID'=>Type::int(),
        'Persona'=>Type::int(),
        'Tipo'=>Type::int(),
        'Medico'=>Type::int(),
        'FechaCreado'=>Type::string(),
        'FechaActualizado'=>Type::string(),
        'FechaEliminado'=>Type::string()
    ]
]);

$MedicoType=new ObjectType([
    'name' => 'MedicoType',
    'description' => 'MedicoType',
    'fields' => function () use(&$PersonaType,&$EspecialidadType,&$UsuarioType){
        return [
            'ID'=>Type::int(),
            'Persona'=>[
                "type" => $PersonaType,
                "resolve" => function ($root, $args) {
                    $id = $root['ID'];
                    $data = Medico::where('ID', $id)->with(['persona_r'])->first();
                    if ($data->persona_r==null) {
                        return null;
                    }
                    return $data->persona_r->toArray();
                }
            ],
            'Especialidad'=>[
                "type" => $EspecialidadType,
                "resolve" => function ($root, $args) {
                    $id = $root['ID'];
                    $data = Medico::where('ID', $id)->with(['especialidad_r'])->first();
                    if ($data->especialidad_r==null) {
                        return null;
                    }
                    return $data->especialidad_r->toArray();
                }
            ],
            'Usuario'=>[
                "type" => $UsuarioType,
                "resolve" => function ($root, $args) {
                    $id = $root['ID'];
                    $data = Medico::where('ID', $id)->with(['usuario_r'])->first();
                    if ($data->usuario_r==null) {
                        return null;
                    }
                    return $data->usuario_r->toArray();
                }
            ],
            'FechaCreado'=>Type::string(),
            'FechaActualizado'=>Type::string(),
            'FechaEliminado'=>Type::string()
        ];
    }
]);

$PagoType=new ObjectType([
    'name' => 'PagoType',
    'description' => 'PagoType',
    'fields' => function () use(&$AdministrativoType){
        return [
            'ID'=>Type::int(),
            'Monto'=>Type::float(),
            'Administrativo'=>[
                "type" => $AdministrativoType,
                "resolve" => function ($root, $args) {
                    $id = $root['ID'];
                    $data = Pago::where('ID', $id)->with(['administrativo_r'])->first();
                    if ($data->administrativo_r==null) {
                        return null;
                    }
                    return $data->administrativo_r->toArray();
                }
            ],
            'FechaCreado'=>Type::string(),
            'FechaActualizado'=>Type::string(),
            'FechaEliminado'=>Type::string()
        ];
    }
]);

$PagoPrecioType=new ObjectType([
    'name' => 'PagoPrecioType',
    'description' => 'PagoPrecioType',
    'fields' => function () use(&$PagoType,&$PrecioType){
        return [
            'ID'=>Type::int(),
            'Pago'=>[
                "type" => $PagoType,
                "resolve" => function ($root, $args) {
                    $id = $root['ID'];
                    $data = PagoPrecio::where('ID', $id)->with(['pago_r'])->first();
                    if ($data->pago_r==null) {
                        return null;
                    }
                    return $data->pago_r->toArray();
                }
            ],
            'Precio'=>[
                "type" => $PrecioType,
                "resolve" => function ($root, $args) {
                    $id = $root['ID'];
                    $data = PagoPrecio::where('ID', $id)->with(['precio_r'])->first();
                    if ($data->precio_r==null) {
                        return null;
                    }
                    return $data->precio_r->toArray();
                }
            ],
            'FechaCreado'=>Type::string(),
            'FechaActualizado'=>Type::string(),
            'FechaEliminado'=>Type::string()
        ];
    }
]);

$PermisoType=new ObjectType([
    'name' => 'PermisoType',
    'description' => 'PermisoType',
    'fields' => function () use(&$RolPermisoType){
        return [
            'ID'=>Type::int(),
            'Nombre'=>Type::string(),
            'Codigo'=>Type::string(),
            'FechaCreado'=>Type::string(),
            'FechaActualizado'=>Type::string(),
            'FechaEliminado'=>Type::string(),
            'RolPermiso'=>[
                "type" => Type::listOf($RolPermisoType),
                "resolve" => function ($root, $args) {
                    $id = $root['ID'];
                    $data = Rol::where('ID', $id)->with(['rol_permiso_r'])->first();
                    if ($data->rol_permiso_r==null) {
                        return null;
                    }
                    return $data->rol_permiso_r->toArray();
                }
            ],
        ];
    }
]);

$PersonaCirugiaType=new ObjectType([
    'name' => 'PersonaCirugiaType',
    'description' => 'PersonaCirugiaType',
    'fields' => function () use(&$PersonaType,&$CirugiaType){
        return [
            'ID'=>Type::int(),
            'Persona'=>[
                "type" => $PersonaType,
                "resolve" => function ($root, $args) {
                    $id = $root['ID'];
                    $data = PersonaCirugia::where('ID', $id)->with(['persona_r'])->first();
                    if ($data->persona_r==null) {
                        return null;
                    }
                    return $data->persona_r->toArray();
                }
            ],
            'Cirugia'=>[
                "type" => $CirugiaType,
                "resolve" => function ($root, $args) {
                    $id = $root['ID'];
                    $data = PersonaCirugia::where('ID', $id)->with(['cirugia_r'])->first();
                    if ($data->cirugia_r==null) {
                        return null;
                    }
                    return $data->cirugia_r->toArray();
                }
            ],
            'HoraAtencion'=>Type::string(),
            'FechaCreado'=>Type::string(),
            'FechaActualizado'=>Type::string(),
            'FechaEliminado'=>Type::string()
        ];
    }
]);

$PersonaConsultaType=new ObjectType([
    'name' => 'PersonaConsultaType',
    'description' => 'PersonaConsultaType',
    'fields' => function () use(&$PersonaType,&$ConsultaType){
        return [
            'ID'=>Type::int(),
            'Persona'=>[
                "type" => $PersonaType,
                "resolve" => function ($root, $args) {
                    $id = $root['ID'];
                    $data = PersonaConsulta::where('ID', $id)->with(['persona_r'])->first();
                    if ($data->persona_r==null) {
                        return null;
                    }
                    return $data->persona_r->toArray();
                }
            ],
            'Consulta'=>[
                "type" => $ConsultaType,
                "resolve" => function ($root, $args) {
                    $id = $root['ID'];
                    $data = PersonaConsulta::where('ID', $id)->with(['consulta_r'])->first();
                    if ($data->consulta_r==null) {
                        return null;
                    }
                    return $data->consulta_r->toArray();
                }
            ],
            'FechaCreado'=>Type::string(),
            'FechaActualizado'=>Type::string(),
            'FechaEliminado'=>Type::string()
        ];
    }
]);

$PersonaExamenType=new ObjectType([
    'name' => 'PersonaExamenType',
    'description' => 'PersonaExamenType',
    'fields'=>[
        'ID'=>Type::int(),
        'Persona'=>Type::int(),
        'Examen'=>Type::int(),
        'FechaCreado'=>Type::string(),
        'FechaActualizado'=>Type::string(),
        'FechaEliminado'=>Type::string()
    ]
]);

$PrecioType=new ObjectType([
    'name' => 'PrecioType',
    'description' => 'PrecioType',
    'fields'=>[
        'ID'=>Type::int(),
        'Monto'=>Type::float(),
        'Tipo'=>Type::int(),
        'FechaCreado'=>Type::string(),
        'FechaActualizado'=>Type::string(),
        'FechaEliminado'=>Type::string()
    ]
]);

$PrecioTipoType=new ObjectType([
    'name' => 'PrecioTipoType',
    'description' => 'PrecioTipoType',
    'fields'=>[
        'ID'=>Type::int(),
        'Tipo'=>Type::string(),
        'FechaCreado'=>Type::string(),
        'FechaActualizado'=>Type::string(),
        'FechaEliminado'=>Type::string()
    ]
]);

$RolPermisoType=new ObjectType([
    'name' => 'RolPermisoType',
    'description' => 'RolPermisoType',
    'fields' => function () use(&$RolType,&$PermisoType){
        return [
            'ID'=>Type::int(),
            'Rol'=>[
                "type" => $RolType,
                "resolve" => function ($root, $args) {
                    $id = $root['ID'];
                    $data = RolPermiso::where('ID', $id)->with(['rol_r'])->first();
                    if ($data->rol_r==null) {
                        return null;
                    }
                    return $data->rol_r->toArray();
                }
            ],
            'Permiso'=>[
                "type" => $PermisoType,
                "resolve" => function ($root, $args) {
                    $id = $root['ID'];
                    $data = RolPermiso::where('ID', $id)->with(['permiso_r'])->first();
                    if ($data->permiso_r==null) {
                        return null;
                    }
                    return $data->permiso_r->toArray();
                }
            ],
            'FechaCreado'=>Type::string(),
            'FechaActualizado'=>Type::string(),
            'FechaEliminado'=>Type::string()
        ];
    }
]);

$TipoDocumentoType=new ObjectType([
    'name' => 'TipoDocumentoType',
    'description' => 'TipoDocumentoType',
    'fields'=>[
        'ID'=>Type::int(),
        'Nombre'=>Type::string(),
        'FechaCreado'=>Type::string(),
        'FechaActualizado'=>Type::string(),
        'FechaEliminado'=>Type::string()
    ]
]);

$TipoHistoriaType=new ObjectType([
    'name' => 'TipoHistoriaType',
    'description' => 'TipoHistoriaType',
    'fields'=>[
        'ID'=>Type::int(),
        'Tipo'=>Type::int(),
        'Glosa'=>Type::string(),
        'FechaCreado'=>Type::string(),
        'FechaActualizado'=>Type::string(),
        'FechaEliminado'=>Type::string()
    ]
]);

$UsuarioRolType=new ObjectType([
    'name' => 'UsuarioRolType',
    'description' => 'UsuarioRolType',
    'fields' => function () use(&$RolType,&$UsuarioType){
            return [
            'ID'=>Type::int(),
            'Rol'=>[
                "type" => $RolType,
                "resolve" => function ($root, $args) {
                    $id = $root['ID'];
                    $data = UsuarioRol::where('ID', $id)->with(['rols'])->first();
                    if ($data->rols==null) {
                        return null;
                    }
                    return $data->rols->toArray();
                }
            ],
            'Usuario'=>[
                "type" => $UsuarioType,
                "resolve" => function ($root, $args) {
                    $id = $root['ID'];
                    $data = UsuarioRol::where('ID', $id)->with(['usuario'])->first();
                    if ($data->usuario==null) {
                        return null;
                    }
                    return $data->usuario->toArray();
                }
            ],
            'FechaCreado'=>Type::string(),
            'FechaActualizado'=>Type::string(),
            'FechaEliminado'=>Type::string()
        ];
    }
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