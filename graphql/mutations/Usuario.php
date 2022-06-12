<?php
use App\Models\Usuario;
use App\Models\HistorialLog;
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
            $cuenta=Usuario::where('Usuario',$args["Usuario"])->where('Pwd',$pwd)->first();
            $v=false;
            $id_cuenta=0;
            if ($cuenta!=null) {
                $v=true;
                $id_cuenta=$cuenta->ID;
                $PublicUser=new PublicUser;
                $History=new HistorialLog([
                    'ID'=>NULL,
                    'Usuario'=>$id_cuenta,
                    'Log'=>true,
                    'IP'=>$PublicUser->getUserIp(),
                    'FechaCreado'=>date("Y-m-d h:i:s")
                ]);
                $x=$History->save();
            }
            return array("estado"=>$v,"id_cuenta"=>$id_cuenta);
        }
    ],
]
?>