<?php
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\Models\Usuario;
use App\Models\Ciudad;
use App\Models\Zona;
use App\Models\Barrio;
use App\Models\TipoDocumento;
use App\Models\Rol;
use App\Models\Permiso;
use App\Models\Cirugia;
use App\Models\Consulta;
use App\Models\Especialidad;

$rootQuery=new ObjectType([
    'name'=>'Query',
    'fields'=>[
        'Usuario'=>[
            'type'=>$UsuarioType,
            'args'=>[
                'ID'=>Type::nonNull(Type::int())
            ],
            'resolve'=>function($root,$args){
                $data=Usuario::find($args["ID"])->toArray();
                if ($data==null) {
                    return null;
                }
                return $data;
            }
        ],
        'Usuarios'=>[
            'type'=>Type::listOf($UsuarioType),
            'resolve'=>function($root,$args){
                $data=Usuario::get()->toArray();
                return $data;
            }
        ],
        'Especialidades'=>[
            'type'=>Type::listOf($EspecialidadType),
            'resolve'=>function($root,$args){
                $data=Especialidad::get()->toArray();
                return $data;
            }
        ],
        'Especialidad'=>[
            'type'=>Type::listOf($EspecialidadType),
            'args'=>[
                'ID'=>Type::nonNull(Type::int())
            ],
            'resolve'=>function($root,$args){
                $data=Especialidad::find($args["ID"])->toArray();
                if ($data==null) {
                    return null;
                }
                return $data;
            }
        ],
        'Ciudades'=>[
            'type'=>Type::listOf($CiudadType),
            'resolve'=>function($root,$args){
                $data=Ciudad::get()->toArray();
                return $data;
            }
        ],
        'Zonas'=>[
            'type'=>Type::listOf($ZonaType),
            'resolve'=>function($root,$args){
                $data=Zona::get()->toArray();
                return $data;
            }
        ],
        'Barrios'=>[
            'type'=>Type::listOf($BarrioType),
            'resolve'=>function($root,$args){
                $data=Barrio::get()->toArray();
                return $data;
            }
        ],
        'TipoDocumentos'=>[
            'type'=>Type::listOf($TipoDocumentoType),
            'resolve'=>function($root,$args){
                $data=TipoDocumento::get()->toArray();
                return $data;
            }
        ],
        'Roles'=>[
            'type'=>Type::listOf($RolType),
            'resolve'=>function($root,$args){
                $data=Rol::get()->toArray();
                return $data;
            }
        ],
        'Rol'=>[
            'type'=>$RolType,
            'args'=>[
                'ID'=>Type::nonNull(Type::int())
            ],
            'resolve'=>function($root,$args){
                $data=Rol::find($args["ID"])->toArray();
                if ($data==null) {
                    return null;
                }
                return $data;
            }
        ],
        'Permisos'=>[
            'type'=>Type::listOf($PermisoType),
            'resolve'=>function($root,$args){
                $data=Permiso::get()->toArray();
                return $data;
            }
        ],
        'Permiso'=>[
            'type'=>$PermisoType,
            'args'=>[
                'ID'=>Type::nonNull(Type::int())
            ],
            'resolve'=>function($root,$args){
                $data=Permiso::find($args["ID"])->toArray();
                if ($data==null) {
                    return null;
                }
                return $data;
            }
        ],
        'Cirugias'=>[
            'type'=>Type::listOf($CirugiaType),
            'resolve'=>function($root,$args){
                $data=Cirugia::get()->toArray();
                return $data;
            }
        ],
        'Cirugia'=>[
            'type'=>$CirugiaType,
            'args'=>[
                'ID'=>Type::nonNull(Type::int())
            ],
            'resolve'=>function($root,$args){
                $data=Cirugia::find($args["ID"])->toArray();
                if ($data==null) {
                    return null;
                }
                return $data;
            }
        ],
        'Consultas'=>[
            'type'=>Type::listOf($ConsultaType),
            'resolve'=>function($root,$args){
                $data=Consulta::get()->toArray();
                return $data;
            }
        ],
        'Consulta'=>[
            'type'=>$ConsultaType,
            'args'=>[
                'ID'=>Type::nonNull(Type::int())
            ],
            'resolve'=>function($root,$args){
                $data=Consulta::find($args["ID"])->toArray();
                if ($data==null) {
                    return null;
                }
                return $data;
            }
        ],
    ]
]);
?>