<?php
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\Models\Usuario;
use App\Models\Ciudad;
use App\Models\Zona;
use App\Models\Barrio;
use App\Models\TipoDocumento;
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
        ]
    ]
]);
?>
