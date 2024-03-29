<?php

use App\Models\Administrativo;
use App\Models\Persona;
use App\Models\Usuario;
use App\Models\Direccion;
use App\Models\Medico;
use GraphQL\Type\Definition\Type;
use App\Models\UsuarioRol;

function getUserIp(){
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';    
    return $ipaddress;
}

$Usuario=[
    'validacion_login'=>[
        'type'=>$validacionLoginType,
        'args'=>[
            'Usuario'=>Type::nonNull(Type::string()),
            'Contra'=>Type::nonNull(Type::string())
        ],
        'resolve'=>function($root,$args){
            $pwd=md5($args["Contra"]);
            $cuenta=Usuario::where('Usuario',$args["Usuario"])->where('Pwd',$pwd)->first();
            $v=false;
            $id_cuenta=0;
            $id_rol=0;
            if ($cuenta!=null) {
                
                if ($cuenta->FechaEliminado == NULL && $cuenta->State == 1) {
                    $roles_user = UsuarioRol::where("Usuario",$cuenta->ID)->first();
                    if ($roles_user != null) {
                        $v=true;
                        $id_cuenta=$cuenta->ID;
                        $id_rol = $roles_user->Rol;
                    }
                }
            }
            return array("estado"=>$v,"id_cuenta"=>$id_cuenta, "id_rol"=>$id_rol);
        }
    ],
    'Registrar_Usuario'=>[
        'type'=>$ResponseType,
        'args'=>[
            'Email'=>Type::nonNull(Type::string()),
            'Telefono'=>Type::nonNull(Type::string()),
            'barrio'=>Type::nonNull(Type::int()),
            'calle'=>Type::nonNull(Type::string()),
            'casa'=>Type::nonNull(Type::string()),
            'ci'=>Type::nonNull(Type::string()),
            'ciudad'=>Type::nonNull(Type::int()),
            'contra'=>Type::nonNull(Type::string()),
            'documento'=>Type::nonNull(Type::int()),
            'materno'=>Type::nonNull(Type::string()),
            'paterno'=>Type::nonNull(Type::string()),
            'nombre'=>Type::nonNull(Type::string()),
            'usuario'=>Type::nonNull(Type::string()),
            'zona'=>Type::nonNull(Type::int()),
            'nacimiento'=>Type::nonNull(Type::string())
        ],
        'resolve'=>function($root,$args){
            $date_ahora=date("Y-m-d h:i:s");
            $user=new Usuario([
                'ID'=>NULL,
                'Usuario'=>$args["usuario"],
                'Pwd'=>md5($args["contra"]),
                'Perfil'=>1,
                'State'=>1,
                'FechaCreado'=>$date_ahora,
                'FechaActualizado'=>NULL,
                'FechaEliminado'=>NULL
            ]);
            $x=$user->save();

            $INFO = Usuario::where('Pwd', md5($args["contra"]))->where('FechaCreado',$date_ahora)->get()->toArray();
            if ($INFO==null) {
                return array("response"=>false);
            }
            $cod_ID=$INFO[0]["ID"];

            $date_ahora_d=date("Y-m-d h:i:s");
            $dir=new Direccion([
                'ID'=>NULL,
                'Zona'=>$args["zona"],
                'Barrio'=>$args["barrio"],
                'Calle'=>$args["calle"],
                'Casa'=>$args["casa"],
                'FechaCreado'=>$date_ahora_d,
                'FechaActualizado'=>NULL,
                'FechaEliminado'=>NULL
            ]);
            $x=$dir->save();

            $Dir = Direccion::where('Casa', $args["casa"])->where('FechaCreado',$date_ahora_d)->get()->toArray();
            if ($Dir==null) {
                return array("response"=>false);
            }
            $cod__DIR_ID=$Dir[0]["ID"];

            $date_ahora_p=date("Y-m-d h:i:s");
            $persona=new Persona([
                'ID'=>NULL,
                'Nombre'=>$args["nombre"],
                'Paterno'=>$args["paterno"],
                'Materno'=>$args["materno"],
                'CI'=>$args["ci"],
                'Correo'=>$args["Email"],
                'Telefono'=>$args["Telefono"],
                'Nacimiento'=>$args["nacimiento"],
                'TipoDocumento'=>$args["documento"],
                'Direccion'=>$cod__DIR_ID,
                'Ciudad'=>$args["ciudad"],
                'Usuario'=>$cod_ID,
                'FechaCreado'=>$date_ahora_p,
                'FechaActualizado'=>NULL,
                'FechaEliminado'=>NULL
            ]);
            $x=$persona->save();
            $Per_SONA = Persona::where('CI', $args["ci"])->where('FechaCreado',$date_ahora_p)->get()->toArray();
            if ($Per_SONA==null) {
                return array("response"=>false);
            }

            $admin=new Administrativo([
                'ID'=>NULL,
                'Usuario'=>$cod_ID,
                'Persona'=>$Per_SONA[0]["ID"],
                'FechaCreado'=>$date_ahora_p,
                'FechaActualizado'=>NULL,
                'FechaEliminado'=>NULL
            ]);
            $x=$admin->save();
            

            return array("response"=>true);
        }
    ],
    'Editar_Usuario'=>[
        'type'=>$ResponseType,
        'args'=>[
            'ID'=>Type::nonNull(Type::int()),
            'Email'=>Type::nonNull(Type::string()),
            'Telefono'=>Type::nonNull(Type::string()),
            'barrio'=>Type::nonNull(Type::int()),
            'calle'=>Type::nonNull(Type::string()),
            'casa'=>Type::nonNull(Type::string()),
            'ci'=>Type::nonNull(Type::string()),
            'ciudad'=>Type::nonNull(Type::int()),
            'documento'=>Type::nonNull(Type::int()),
            'materno'=>Type::nonNull(Type::string()),
            'paterno'=>Type::nonNull(Type::string()),
            'nombre'=>Type::nonNull(Type::string()),
            'usuario'=>Type::nonNull(Type::string()),
            'zona'=>Type::nonNull(Type::int()),
            'nacimiento'=>Type::nonNull(Type::string())
        ],
        'resolve'=>function($root,$args){
            $date_ahora=date("Y-m-d h:i:s");
            $a=Usuario::find($args['ID']);
            $v=false;
            if ($a!=null) {
                Usuario::where('ID', $args['ID'])->update([
                    'Usuario'=>$args["usuario"],
                    'FechaActualizado'=>$date_ahora
                ]);
                $Persona= Persona::where("Usuario", $args['ID'])->first();
                Direccion::where('ID', $Persona->Direccion)->update([
                    'Zona'=>$args["zona"],
                    'Barrio'=>$args["barrio"],
                    'Calle'=>$args["calle"],
                    'Casa'=>$args["casa"],
                    'FechaActualizado'=>$date_ahora
                ]);
                Persona::where('Usuario', $args['ID'])->update([
                    'Nombre'=>$args["nombre"],
                    'Paterno'=>$args["paterno"],
                    'Materno'=>$args["materno"],
                    'CI'=>$args["ci"],
                    'Correo'=>$args["Email"],
                    'Telefono'=>$args["Telefono"],
                    'Nacimiento'=>$args["nacimiento"],
                    'TipoDocumento'=>$args["documento"],
                    'Ciudad'=>$args["ciudad"],
                    'FechaActualizado'=>$date_ahora
                ]);
                $v=true;
            }
            return array("response"=>$v);
        }
    ],
    'Eliminar_Usuario'=>[
        'type'=>$ResponseType,
        'args'=>[
            'ID'=>Type::nonNull(Type::int())
        ],
        'resolve'=>function($root,$args){
            $date_ahora=date("Y-m-d h:i:s");
            $a=Usuario::find($args['ID']);
            $v=false;
            if ($a!=null) {
                Usuario::where('ID', $args['ID'])->update([
                    'FechaEliminado'=>$date_ahora
                ]);
                $Persona= Persona::where("Usuario", $args['ID'])->first();
                Direccion::where('ID', $Persona->Direccion)->update([
                    'FechaEliminado'=>$date_ahora
                ]);
                Persona::where('Usuario', $args['ID'])->update([
                    'FechaEliminado'=>$date_ahora
                ]);
                $v=true;
            }
            return array("response"=>$v);
        }
    ],
    'Bloquear_Usuario'=>[
        'type'=>$ResponseType,
        'args'=>[
            'ID'=>Type::nonNull(Type::int()),
            'Estado'=>Type::nonNull(Type::boolean())
        ],
        'resolve'=>function($root,$args){
            $date_ahora=date("Y-m-d h:i:s");
            $a=Usuario::find($args['ID']);
            $v=false;
            if ($a!=null) {
                Usuario::where('ID', $args['ID'])->update([
                    'State'=>$args["Estado"],
                    'FechaActualizado'=>$date_ahora,
                    'FechaEliminado'=>$date_ahora
                ]);
                $Persona= Persona::where("Usuario", $args['ID'])->first();
                Direccion::where('ID', $Persona->Direccion)->update([
                    'FechaActualizado'=>$date_ahora,
                    'FechaEliminado'=>$date_ahora
                ]);
                Persona::where('Usuario', $args['ID'])->update([
                    'FechaActualizado'=>$date_ahora,
                    'FechaEliminado'=>$date_ahora
                ]);
                $v=true;
            }
            return array("response"=>$v);
        }
    ],
    'UpdateContra'=>[
        'type'=>$ResponseType,
        'args'=>[
            'ID'=>Type::nonNull(Type::int()),
            'Contra'=>Type::nonNull(Type::string())
        ],
        'resolve'=>function($root,$args){
            $pwd=md5($args["Contra"]);
            $a=Usuario::find($args['ID']);
            $v=false;
            if ($a!=null) {
                Usuario::where('ID', $args['ID'])->update([
                    'Pwd'=>$pwd,
                    'FechaActualizado'=>date("Y-m-d h:i:s")
                ]);
                $v=true;
            }
            return array("response"=>$v);
        }
    ],
    'Registrar_Medico'=>[
        'type'=>$ResponseType,
        'args'=>[
            'Email'=>Type::nonNull(Type::string()),
            'Telefono'=>Type::nonNull(Type::string()),
            'barrio'=>Type::nonNull(Type::int()),
            'calle'=>Type::nonNull(Type::string()),
            'casa'=>Type::nonNull(Type::string()),
            'ci'=>Type::nonNull(Type::string()),
            'ciudad'=>Type::nonNull(Type::int()),
            'contra'=>Type::nonNull(Type::string()),
            'documento'=>Type::nonNull(Type::int()),
            'materno'=>Type::nonNull(Type::string()),
            'paterno'=>Type::nonNull(Type::string()),
            'nombre'=>Type::nonNull(Type::string()),
            'usuario'=>Type::nonNull(Type::string()),
            'zona'=>Type::nonNull(Type::int()),
            'especialidad'=>Type::nonNull(Type::int()),
            'nacimiento'=>Type::nonNull(Type::string())
        ],
        'resolve'=>function($root,$args){
            $date_ahora=date("Y-m-d h:i:s");
            $user=new Usuario([
                'ID'=>NULL,
                'Usuario'=>$args["usuario"],
                'Pwd'=>md5($args["contra"]),
                'Perfil'=>1,
                'State'=>1,
                'FechaCreado'=>$date_ahora,
                'FechaActualizado'=>NULL,
                'FechaEliminado'=>NULL
            ]);
            $x=$user->save();

            $INFO = Usuario::where('Pwd', md5($args["contra"]))->where('FechaCreado',$date_ahora)->get()->toArray();
            if ($INFO==null) {
                return array("response"=>false);
            }
            $cod_ID=$INFO[0]["ID"];

            $date_ahora_d=date("Y-m-d h:i:s");
            $dir=new Direccion([
                'ID'=>NULL,
                'Zona'=>$args["zona"],
                'Barrio'=>$args["barrio"],
                'Calle'=>$args["calle"],
                'Casa'=>$args["casa"],
                'FechaCreado'=>$date_ahora_d,
                'FechaActualizado'=>NULL,
                'FechaEliminado'=>NULL
            ]);
            $x=$dir->save();

            $Dir = Direccion::where('Casa', $args["casa"])->where('FechaCreado',$date_ahora_d)->get()->toArray();
            if ($Dir==null) {
                return array("response"=>false);
            }
            $cod__DIR_ID=$Dir[0]["ID"];

            $date_ahora_p=date("Y-m-d h:i:s");
            $persona=new Persona([
                'ID'=>NULL,
                'Nombre'=>$args["nombre"],
                'Paterno'=>$args["paterno"],
                'Materno'=>$args["materno"],
                'CI'=>$args["ci"],
                'Correo'=>$args["Email"],
                'Telefono'=>$args["Telefono"],
                'Nacimiento'=>$args["nacimiento"],
                'TipoDocumento'=>$args["documento"],
                'Direccion'=>$cod__DIR_ID,
                'Ciudad'=>$args["ciudad"],
                'Usuario'=>$cod_ID,
                'FechaCreado'=>$date_ahora_p,
                'FechaActualizado'=>NULL,
                'FechaEliminado'=>NULL
            ]);
            $x=$persona->save();
            $Per_SONA = Persona::where('CI', $args["ci"])->where('FechaCreado',$date_ahora_p)->get()->toArray();
            if ($Per_SONA==null) {
                return array("response"=>false);
            }

            $medico=new Medico([
                'ID'=>NULL,
                'Persona'=>$Per_SONA[0]["ID"],
                'Especialidad'=>$args["especialidad"],
                'Usuario'=>$cod_ID,
                'FechaCreado'=>$date_ahora_p,
                'FechaActualizado'=>NULL,
                'FechaEliminado'=>NULL
            ]);
            $x=$medico->save();
            

            return array("response"=>true);
        }
    ],
]
?>