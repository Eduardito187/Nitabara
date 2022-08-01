<?php
use App\Models\Permiso;
use App\Models\Rol;
use App\Models\RolPermiso;
use App\Models\Usuario;
use App\Models\UsuarioRol;
use GraphQL\Type\Definition\Type;
function QuitarRoles($api,$ID){
    foreach ($api as $item) {
        if ($item==$ID) {
            return true;
        }
    }
    return false;
}
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
    'EditRolesUsers'=>[
        'type'=>$ResponseType,
        'args'=>[
            'ID'=>Type::nonNull(Type::int()),
            'Nombre'=>Type::nonNull(Type::string()),
            'Permisos'=>Type::nonNull(Type::listOf(Type::int()))
        ],
        'resolve'=>function($root,$args){
            $Rol=Rol::find($args["ID"]);
            //No existe
            if ($Rol==null) {
                return array("response"=>false);
            }
            
            Rol::where('ID', $args['ID'])->update([
                'Rol' => isset($args["Nombre"])?$args["Nombre"]:$Rol->Rol
            ]);
            //Todos los permisos
            $Roles_Permisos = RolPermiso::where("Rol",$Rol->ID)->get();
            //Quitado de permisos
            /*
            foreach ($Roles_Permisos as $item) {
                if (QuitarRoles($args["Permisos"], $item->Rol)==false) {
                    RolPermiso::where("Rol",$Rol->ID)->where("Permiso",$item->Rol)->delete();
                }
            }
            */

            RolPermiso::where("Rol",$Rol->ID)->delete();
            //Agregado de Permisos
            foreach ($args["Permisos"] as $r_p) {
                $Rango_Permiso = RolPermiso::where("Rol",$Rol->ID)->where("Permiso",$r_p)->first();
                if ($Rango_Permiso==null) {
                    $Rango_P=new RolPermiso([
                        'ID'=>NULL,
                        'Rol'=>$Rol->ID,
                        'Permiso'=>$r_p,
                        'FechaCreado'=>date("Y-m-d h:i:s"),
                        'FechaActualizado'=>NULL,
                        'FechaEliminado'=>NULL
                    ]);
                    $x=$Rango_P->save();
                }
            }
            //Operacion Exitosa
            return array("response"=>true);
        }
    ],
    'AsignadoDeRoles'=>[
        'type'=>$ResponseType,
        'args'=>[
            'ID'=>Type::nonNull(Type::int()),
            'Roles'=>Type::nonNull(Type::listOf(Type::int()))
        ],
        'resolve'=>function($root,$args){
            $Usuario=Usuario::find($args["ID"]);
            //No existe
            if ($Usuario==null) {
                return array("response"=>false);
            }
            
            //Todos los Roles
            $UsuarioRol = UsuarioRol::where("Usuario",$Usuario->ID)->get();
            //Quitado de Roles
            /*
            foreach ($UsuarioRol as $item) {
                if (QuitarRoles($args["Roles"], $item->Rol)==false) {
                    UsuarioRol::where("Usuario",$Usuario->ID)->where("Rol",$item->Rol)->delete();
                }
            }*/
            UsuarioRol::where("Usuario",$Usuario->ID)->delete();
            //Agregado de Permisos
            foreach ($args["Roles"] as $r_p) {
                $Rango_UsuarioRol = UsuarioRol::where("Usuario",$Usuario->ID)->where("Rol",$r_p)->first();
                if ($Rango_UsuarioRol==null) {
                    $Rango_P=new UsuarioRol([
                        'ID'=>NULL,
                        'Rol'=>$r_p,
                        'Usuario'=>$Usuario->ID,
                        'FechaCreado'=>date("Y-m-d h:i:s"),
                        'FechaActualizado'=>NULL,
                        'FechaEliminado'=>NULL
                    ]);
                    $x=$Rango_P->save();
                }
            }
            //Operacion Exitosa
            return array("response"=>true);
        }
    ],
]

?>