<?php
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
    'fields' => function () use(&$Persona_Type,&$FOTO_Type,&$USUARIO_ROL_Type,&$ADMINISTRATIVO_Type,&$HISTORIAL_LOG_Type){
        return [
            'ID'=>Type::int(),
            'Usuario'=>Type::string(),
            'Pwd'=>Type::string(),
            'Perfil'=>[
                "type" => $FOTO_Type,
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
                "type" => Type::listOf($USUARIO_ROL_Type),
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
                "type" => $ADMINISTRATIVO_Type,
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
                "type" => Type::listOf($HISTORIAL_LOG_Type),
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
                "type" => $Persona_Type,
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

$FOTO_Type=new ObjectType([
    'name' => 'FOTO_Type',
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

$ADMINISTRATIVO_Type=new ObjectType([
    'name' => 'ADMINISTRATIVO_Type',
    'description' => 'Data ADMINISTRATIVO',
    'fields'=>[
        'ID'=>Type::int(),
        'Usuario'=>Type::string(),
        'Persona'=>Type::int(),
        'FechaCreado'=>Type::string(),
        'FechaActualizado'=>Type::string(),
        'FechaEliminado'=>Type::string()
    ]
]);

$Persona_Type=new ObjectType([
    'name' => 'Persona_Type',
    'description' => 'Data Persona',
    'fields'=>[
        'ID'=>Type::int(),
        'Nombre'=>Type::string(),
        'Paterno'=>Type::string(),
        'Materno'=>Type::string(),
        'Correo'=>Type::string(),
        'Telefono'=>Type::string(),
        'Nacimiento'=>Type::string(),
        'TipoDocumento'=>Type::int(),
        'Direccion'=>Type::string(),
        'Ciudad'=>Type::string(),
        'Usuario'=>Type::int(),
        'FechaCreado'=>Type::string(),
        'FechaActualizado'=>Type::string(),
        'FechaEliminado'=>Type::string()
    ]
]);

$HISTORIAL_LOG_Type=new ObjectType([
    'name' => 'HISTORIAL_LOG_Type',
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

$USUARIO_ROL_Type=new ObjectType([
    'name' => 'USUARIO_ROL_Type',
    'description' => 'Data USUARIO ROL',
    'fields' => function () use(&$ROL_Type,&$UsuarioType){
        return [
            'ID'=>Type::int(),
            'Rol'=>[
                "type" => $ROL_Type,
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

$ROL_Type=new ObjectType([
    'name' => 'ROL_Type',
    'description' => 'Data ROL',
    'fields'=>[
        'ID'=>Type::int(),
        'Rol'=>Type::string(),
        'FechaCreado'=>Type::string(),
        'FechaActualizado'=>Type::string(),
        'FechaEliminado'=>Type::string()
    ]
]);
?>
