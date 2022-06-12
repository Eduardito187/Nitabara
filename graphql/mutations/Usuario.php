<?php
use App\Models\Usuario;
use GraphQL\Type\Definition\Type;
$Usuario=[
    'validacion_login'=>[
        'type'=>$validacionLoginType,
        'args'=>[
            'Usuario'=>Type::string(),
            'Contra'=>Type::string()
        ],
        'resolve'=>function($root,$args){
            $pwd=md5($args["Contra"]);
            $cuenta=Usuario::where('Usuario',$args["usuario"])->where('Pwd',$pwd)->first();
            $v=false;
            $id_cuenta=0;
            if ($cuenta!=null) {
                $v=true;
                $id_cuenta=$cuenta->ID;
            }
            return array("estado"=>$v,"id_cuenta"=>$id_cuenta);
        }
    ],
]
?>