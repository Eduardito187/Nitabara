<?php
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\Models\Usuario;
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
                return $data;
            }
        ],
    ]
]);
?>
