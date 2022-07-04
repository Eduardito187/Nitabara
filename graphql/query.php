<?php
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
$rootQuery=new ObjectType([
    'name'=>'Query',
    'fields'=>[
        'usuario'=>[
            'type'=>$validacionLoginType,
            'resolve'=>function($root,$args){
                return array("estado"=>false,"id_cuenta"=>0);
            }
        ],
    ]
]);
?>
