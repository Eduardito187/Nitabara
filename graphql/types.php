<?php

use App\Models\Persona;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\Models\Usuario;
use App\Models\UsuarioRol;

$validacionLoginType=new ObjectType([
    'name' => 'Validacion_de_Login',
    'description' => 'Se valida el inicio al sistema',
    'fields'=>[
        'estado'=>Type::boolean(),
        'id_cuenta'=>Type::int()
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
    'fields'=>[
        'ID'=>Type::int(),
        'Usuario'=>Type::string(),
        'Persona'=>Type::int(),
        'FechaCreado'=>Type::string(),
        'FechaActualizado'=>Type::string(),
        'FechaEliminado'=>Type::string()
    ]
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

$CirugiaPagoType=new ObjectType([
    'name' => 'CirugiaType',
    'description' => 'CirugiaPagoType',
    'fields'=>[
        'ID'=>Type::int(),
        'Cirugia'=>Type::int(),
        'Pago'=>Type::int(),
        'Total'=>Type::float(),
        'FechaCreado'=>Type::string(),
        'FechaActualizado'=>Type::string(),
        'FechaEliminado'=>Type::string()
    ]
]);

$CiudadType=new ObjectType([
    'name' => 'CiudadType',
    'description' => 'CiudadType',
    'fields'=>[
        'ID'=>Type::int(),
        'Ciudad'=>Type::string(),
        'FechaCreado'=>Type::string(),
        'FechaActualizado'=>Type::string(),
        'FechaEliminado'=>Type::string()
    ]
]);

$ConsultaType=new ObjectType([
    'name' => 'ConsultaType',
    'description' => 'ConsultaType',
    'fields'=>[
        'ID'=>Type::int(),
        'Medico'=>Type::int(),
        'Descripcion'=>Type::string(),
        'Hora'=>Type::string(),
        'FechaCreado'=>Type::string(),
        'FechaActualizado'=>Type::string(),
        'FechaEliminado'=>Type::string()
    ]
]);

$ConsultaPagoType=new ObjectType([
    'name' => 'ConsultaPagoType',
    'description' => 'ConsultaPagoType',
    'fields'=>[
        'ID'=>Type::int(),
        'Pago'=>Type::int(),
        'Consulta'=>Type::int(),
        'Descripcion'=>Type::string(),
        'Total'=>Type::float(),
        'FechaCreado'=>Type::string(),
        'FechaActualizado'=>Type::string(),
        'FechaEliminado'=>Type::string()
    ]
]);

$DireccionType=new ObjectType([
    'name' => 'DireccionType',
    'description' => 'DireccionType',
    'fields'=>[
        'ID'=>Type::int(),
        'Zona'=>Type::int(),
        'Barrio'=>Type::int(),
        'Calle'=>Type::string(),
        'Casa'=>Type::string(),
        'FechaCreado'=>Type::string(),
        'FechaActualizado'=>Type::string(),
        'FechaEliminado'=>Type::string()
    ]
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
    'fields'=>[
        'ID'=>Type::int(),
        'Rol'=>Type::string(),
        'FechaCreado'=>Type::string(),
        'FechaActualizado'=>Type::string(),
        'FechaEliminado'=>Type::string()
    ]
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
    'fields'=>[
        'ID'=>Type::int(),
        'Persona'=>Type::int(),
        'Especialidad'=>Type::int(),
        'Usuario'=>Type::int(),
        'FechaCreado'=>Type::string(),
        'FechaActualizado'=>Type::string(),
        'FechaEliminado'=>Type::string()
    ]
]);

$PagoType=new ObjectType([
    'name' => 'PagoType',
    'description' => 'PagoType',
    'fields'=>[
        'ID'=>Type::int(),
        'Monto'=>Type::float(),
        'Administrativo'=>Type::int(),
        'FechaCreado'=>Type::string(),
        'FechaActualizado'=>Type::string(),
        'FechaEliminado'=>Type::string()
    ]
]);

$PagoPrecioType=new ObjectType([
    'name' => 'PagoPrecioType',
    'description' => 'PagoPrecioType',
    'fields'=>[
        'ID'=>Type::int(),
        'Pago'=>Type::int(),
        'Precio'=>Type::int(),
        'FechaCreado'=>Type::string(),
        'FechaActualizado'=>Type::string(),
        'FechaEliminado'=>Type::string()
    ]
]);

$PermisoType=new ObjectType([
    'name' => 'PermisoType',
    'description' => 'PermisoType',
    'fields'=>[
        'ID'=>Type::int(),
        'Nombre'=>Type::string(),
        'Codigo'=>Type::string(),
        'FechaCreado'=>Type::string(),
        'FechaActualizado'=>Type::string(),
        'FechaEliminado'=>Type::string()
    ]
]);

$PersonaCirugiaType=new ObjectType([
    'name' => 'PersonaCirugiaType',
    'description' => 'PersonaCirugiaType',
    'fields'=>[
        'ID'=>Type::int(),
        'Persona'=>Type::int(),
        'Cirugia'=>Type::int(),
        'HoraAtencion'=>Type::string(),
        'FechaCreado'=>Type::string(),
        'FechaActualizado'=>Type::string(),
        'FechaEliminado'=>Type::string()
    ]
]);

$PersonaConsultaType=new ObjectType([
    'name' => 'PersonaConsultaType',
    'description' => 'PersonaConsultaType',
    'fields'=>[
        'ID'=>Type::int(),
        'Persona'=>Type::int(),
        'Consulta'=>Type::int(),
        'FechaCreado'=>Type::string(),
        'FechaActualizado'=>Type::string(),
        'FechaEliminado'=>Type::string()
    ]
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

$RolType=new ObjectType([
    'name' => 'RolType',
    'description' => 'RolType',
    'fields'=>[
        'ID'=>Type::int(),
        'Rol'=>Type::string(),
        'FechaCreado'=>Type::string(),
        'FechaActualizado'=>Type::string(),
        'FechaEliminado'=>Type::string()
    ]
]);

$RolPermisoType=new ObjectType([
    'name' => 'RolPermisoType',
    'description' => 'RolPermisoType',
    'fields'=>[
        'ID'=>Type::int(),
        'Rol'=>Type::int(),
        'Permiso'=>Type::int(),
        'FechaCreado'=>Type::string(),
        'FechaActualizado'=>Type::string(),
        'FechaEliminado'=>Type::string()
    ]
]);

$TipoDocumentoType=new ObjectType([
    'name' => 'TipoDocumentoType',
    'description' => 'TipoDocumentoType',
    'fields'=>[
        'ID'=>Type::int(),
        'Tipo'=>Type::string(),
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
    'fields'=>[
        'ID'=>Type::int(),
        'Rol'=>Type::int(),
        'Usuario'=>Type::int(),
        'FechaCreado'=>Type::string(),
        'FechaActualizado'=>Type::string(),
        'FechaEliminado'=>Type::string()
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