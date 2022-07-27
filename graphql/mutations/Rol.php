<?php
use App\Models\Permiso;
use App\Models\Rol;
use App\Models\RolPermiso;
use GraphQL\Type\Definition\Type;

$Rol=[
    'CreateRol'=>[
        'type'=>$ResponseType,
        'args'=>[
            'Nombre'=>Type::nonNull(Type::string()),
            'Permisos'=>Type::nonNull(Type::listOf(Type::int()))
        ],
        'resolve'=>function($root,$args){
            $date_ahora=date("Y-m-d h:i:s");
            $Rol=new Rol([
                'ID'=>NULL,
                'Rol'=>$args["Nombre"],
                'FechaCreado'=>$date_ahora,
                'FechaActualizado'=>NULL,
                'FechaEliminado'=>NULL
            ]);
            $x=$Rol->save();
            $ROL= Rol::where("Rol", $args['Nombre'])->first();
            if ($ROL==NULL) {
                return array("response"=>false);
            }
            foreach ($args["Permisos"] as $id_permiso) {
                $RolPermiso=new RolPermiso([
                    'ID'=>NULL,
                    'Rol'=>$ROL->ID,
                    'Permiso'=>$id_permiso,
                    'FechaCreado'=>$date_ahora,
                    'FechaActualizado'=>NULL,
                    'FechaEliminado'=>NULL
                ]);
                $x=$RolPermiso->save();
            }
            return array("response"=>true);
        }
    ],
]
?>