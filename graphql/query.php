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
use App\Models\ExamenesMedicos;
use App\Models\Medico;
use App\Models\Persona;
use App\Models\UsuarioRol;

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
                $data=Cirugia::where('FechaEliminado', NULL)->get()->toArray();
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
                $data=Consulta::where('FechaEliminado', NULL)->get()->toArray();
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
        'Personas'=>[
            'type'=>Type::listOf($PersonaType),
            'resolve'=>function($root,$args){
                $data=Persona::get()->toArray();
                return $data;
            }
        ],
        'Persona'=>[
            'type'=>$PersonaType,
            'args'=>[
                'ID'=>Type::nonNull(Type::int())
            ],
            'resolve'=>function($root,$args){
                $data=Persona::find($args["ID"])->toArray();
                if ($data==null) {
                    return null;
                }
                return $data;
            }
        ],
        'Medicos'=>[
            'type'=>Type::listOf($MedicoType),
            'resolve'=>function($root,$args){
                $data=Medico::get()->toArray();
                return $data;
            }
        ],
        'Medico'=>[
            'type'=>$MedicoType,
            'args'=>[
                'ID'=>Type::nonNull(Type::int())
            ],
            'resolve'=>function($root,$args){
                $data=Medico::find($args["ID"])->toArray();
                if ($data==null) {
                    return null;
                }
                return $data;
            }
        ],
        'Examenes'=>[
            'type'=>Type::listOf($ExamenesMedicosType),
            'resolve'=>function($root,$args){
                $data=ExamenesMedicos::where('FechaEliminado', NULL)->get()->toArray();
                return $data;
            }
        ],
        'Examen'=>[
            'type'=>$ExamenesMedicosType,
            'args'=>[
                'ID'=>Type::nonNull(Type::int())
            ],
            'resolve'=>function($root,$args){
                $data=ExamenesMedicos::find($args["ID"])->toArray();
                if ($data==null) {
                    return null;
                }
                return $data;
            }
        ],
        'ValidarPermiso'=>[
            'type'=>$ResponseType,
            'args'=>[
                'ID'=>Type::nonNull(Type::int()),
                'Codigo'=>Type::nonNull(Type::string())
            ],
            'resolve'=>function($root,$args){
                $Permisos = Permiso::where("Codigo",$args["Codigo"])->with(['rol_permiso_r'])->get();
                foreach ($Permisos as $permiso) {
                    if ($permiso->rol_permiso_r != null) {
                        print_r($permiso->rol_permiso_r);
                        print_r($permiso->rol_permiso_r->Rol);
                        $roles_user = UsuarioRol::where("Usuario",$args["ID"])->where("Rol",$permiso->rol_permiso_r->Rol)->first();
                        print_r($roles_user);
                        if ($roles_user != null) {
                            return array("response"=>true);
                        }
                    }
                }
                return array("response"=>false);
            }
        ],
    ]
]);
?>