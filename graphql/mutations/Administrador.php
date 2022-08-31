<?php

use App\Models\Administrativo;
use App\Models\Cirugia;
use App\Models\CirugiaPago;
use App\Models\Consulta;
use App\Models\ConsultaPago;
use App\Models\ExamenesMedicos;
use App\Models\ExamenesPago;
use App\Models\Pago;
use App\Models\PersonaCirugia;
use App\Models\PersonaConsulta;
use App\Models\PersonaExamen;
use GraphQL\Type\Definition\Type;

$Administrador=[
    'CreateCirugia'=>[
        'type'=>$ResponseType,
        'args'=>[
            'Usuario'=>Type::nonNull(Type::int()),
            'Paciente'=>Type::nonNull(Type::int()),
            'Medico'=>Type::nonNull(Type::int()),
            'Descripcion'=>Type::nonNull(Type::string()),
            'Hora'=>Type::nonNull(Type::string()),
            'Precio'=>Type::nonNull(Type::float())
        ],
        'resolve'=>function($root,$args){
            $date_ahora=date("Y-m-d h:i:s");
            $Administrativo = Administrativo::where("Usuario",$args["Usuario"])->first();
            if ($Administrativo == null) {
                return array("response"=>false);
            }
            
            $Pago_D=new Pago([
                'ID'=>NULL,
                'Monto'=>$args["Precio"],
                'Administrativo'=>$Administrativo->ID,
                'FechaCreado'=>$date_ahora,
                'FechaActualizado'=>NULL,
                'FechaEliminado'=>NULL
            ]);
            $Pago_D->save();

            $Pago = Pago::where("Administrativo",$Administrativo->ID)->where('FechaCreado',$date_ahora)->first();
            if ($Pago == null) {
                return array("response"=>false);
            }
            
            $Cirugia_N=new Cirugia([
                'ID'=>NULL,
                'Persona'=>$args["Paciente"],
                'Descripcion'=>$args["Descripcion"],
                'Medico'=>$args["Medico"],
                'FechaCreado'=>$date_ahora,
                'FechaActualizado'=>NULL,
                'FechaEliminado'=>NULL
            ]);
            $Cirugia_N->save();

            $Cirugia = Cirugia::where("Persona",$args["Paciente"])->where('Medico',$args["Medico"])->where('FechaCreado',$date_ahora)->first();
            if ($Cirugia == null) {
                return array("response"=>false);
            }

            $Cirugia_Pago_N=new CirugiaPago([
                'ID'=>NULL,
                'Cirugia'=>$Cirugia->ID,
                'Pago'=>$Pago->ID,
                'Total'=>$args["Precio"],
                'FechaCreado'=>$date_ahora,
                'FechaActualizado'=>NULL,
                'FechaEliminado'=>NULL
            ]);
            $Cirugia_Pago_N->save();

            $PersonaCirugia_N=new PersonaCirugia([
                'ID'=>NULL,
                'Persona'=>$args["Paciente"],
                'Cirugia'=>$Cirugia->ID,
                'HoraAtencion'=>$args["Hora"],
                'FechaCreado'=>$date_ahora,
                'FechaActualizado'=>NULL,
                'FechaEliminado'=>NULL
            ]);
            $PersonaCirugia_N->save();

            return array("response"=>true);
        }
    ],
    'EditCirugia'=>[
        'type'=>$ResponseType,
        'args'=>[
            'ID'=>Type::nonNull(Type::int()),
            'Usuario'=>Type::nonNull(Type::int()),
            'Paciente'=>Type::nonNull(Type::int()),
            'Medico'=>Type::nonNull(Type::int()),
            'Descripcion'=>Type::nonNull(Type::string()),
            'Hora'=>Type::nonNull(Type::string()),
            'Precio'=>Type::nonNull(Type::float())
        ],
        'resolve'=>function($root,$args){
            $date_ahora=date("Y-m-d h:i:s");
            $Administrativo = Administrativo::where("Usuario",$args["Usuario"])->first();
            if ($Administrativo == null) {
                return array("response"=>false);
            }
            
            $Pago_D=new Pago([
                'ID'=>NULL,
                'Monto'=>$args["Precio"],
                'Administrativo'=>$Administrativo->ID,
                'FechaCreado'=>$date_ahora,
                'FechaActualizado'=>NULL,
                'FechaEliminado'=>NULL
            ]);
            $Pago_D->save();

            $Pago = Pago::where("Administrativo",$Administrativo->ID)->where('FechaCreado',$date_ahora)->first();
            if ($Pago == null) {
                return array("response"=>false);
            }

            $Cirugia = Cirugia::find($args["ID"]);
            if ($Cirugia == null) {
                return array("response"=>false);
            }

            Cirugia::where('ID', $Cirugia->ID)->update([
                'Persona'=>$args["Paciente"],
                'Descripcion'=>$args["Descripcion"],
                'Medico'=>$args["Medico"],
                'FechaActualizado'=>$date_ahora
            ]);
            CirugiaPago::where('Cirugia', $Cirugia->ID)->update([
                'Pago'=>$Pago->ID,
                'Total'=>$args["Precio"],
                'FechaCreado'=>$date_ahora,
                'FechaActualizado'=>$date_ahora
            ]);
            PersonaCirugia::where('Cirugia', $Cirugia->ID)->update([
                'Persona'=>$args["Paciente"],
                'HoraAtencion'=>$args["Hora"],
                'FechaActualizado'=>$date_ahora
            ]);

            return array("response"=>true);
        }
    ],
    'DeleteCirugia'=>[
        'type'=>$ResponseType,
        'args'=>[
            'ID'=>Type::nonNull(Type::int())
        ],
        'resolve'=>function($root,$args){
            $date_ahora=date("Y-m-d h:i:s");
            $Cirugia = Cirugia::find($args["ID"]);
            if ($Cirugia == null) {
                return array("response"=>false);
            }

            Cirugia::where('ID', $Cirugia->ID)->update([
                'FechaEliminado'=>$date_ahora
            ]);
            CirugiaPago::where('Cirugia', $Cirugia->ID)->update([
                'FechaEliminado'=>$date_ahora
            ]);
            PersonaCirugia::where('Cirugia', $Cirugia->ID)->update([
                'FechaEliminado'=>$date_ahora
            ]);

            return array("response"=>true);
        }
    ],
    'CreateConsulta'=>[
        'type'=>$ResponseType,
        'args'=>[
            'Usuario'=>Type::nonNull(Type::int()),
            'Paciente'=>Type::nonNull(Type::int()),
            'Medico'=>Type::nonNull(Type::int()),
            'Descripcion'=>Type::nonNull(Type::string()),
            'Hora'=>Type::nonNull(Type::string()),
            'Precio'=>Type::nonNull(Type::float())
        ],
        'resolve'=>function($root,$args){
            $date_ahora=date("Y-m-d h:i:s");
            $Administrativo = Administrativo::where("Usuario",$args["Usuario"])->first();
            if ($Administrativo == null) {
                return array("response"=>false);
            }
            
            $Pago_D=new Pago([
                'ID'=>NULL,
                'Monto'=>$args["Precio"],
                'Administrativo'=>$Administrativo->ID,
                'FechaCreado'=>$date_ahora,
                'FechaActualizado'=>NULL,
                'FechaEliminado'=>NULL
            ]);
            $Pago_D->save();

            $Pago = Pago::where("Administrativo",$Administrativo->ID)->where('FechaCreado',$date_ahora)->first();
            if ($Pago == null) {
                return array("response"=>false);
            }
            
            $Consulta_N=new Consulta([
                'ID'=>NULL,
                'Persona'=>$args["Paciente"],
                'Medico'=>$args["Medico"],
                'Descripcion'=>$args["Descripcion"],
                'Hora'=>$args["Hora"],
                'FechaCreado'=>$date_ahora,
                'FechaActualizado'=>NULL,
                'FechaEliminado'=>NULL
            ]);
            $Consulta_N->save();

            $Consulta = Consulta::where("Persona",$args["Paciente"])->where('Medico',$args["Medico"])->where('FechaCreado',$date_ahora)->first();
            if ($Consulta == null) {
                return array("response"=>false);
            }

            $ConsultaPago_N=new ConsultaPago([
                'ID'=>NULL,
                'Pago'=>$Pago->ID,
                'Consulta'=>$Consulta->ID,
                'Descripcion'=>$args["Descripcion"],
                'Total'=>$args["Precio"],
                'FechaCreado'=>$date_ahora,
                'FechaActualizado'=>NULL,
                'FechaEliminado'=>NULL
            ]);
            $ConsultaPago_N->save();

            $PersonaConsulta_N=new PersonaConsulta([
                'ID'=>NULL,
                'Persona'=>$args["Paciente"],
                'Consulta'=>$Consulta->ID,
                'FechaCreado'=>$date_ahora,
                'FechaActualizado'=>NULL,
                'FechaEliminado'=>NULL
            ]);
            $PersonaConsulta_N->save();

            return array("response"=>true);
        }
    ],
    'EditConsulta'=>[
        'type'=>$ResponseType,
        'args'=>[
            'ID'=>Type::nonNull(Type::int()),
            'Usuario'=>Type::nonNull(Type::int()),
            'Paciente'=>Type::nonNull(Type::int()),
            'Medico'=>Type::nonNull(Type::int()),
            'Descripcion'=>Type::nonNull(Type::string()),
            'Hora'=>Type::nonNull(Type::string()),
            'Precio'=>Type::nonNull(Type::float())
        ],
        'resolve'=>function($root,$args){
            $date_ahora=date("Y-m-d h:i:s");
            $Administrativo = Administrativo::where("Usuario",$args["Usuario"])->first();
            if ($Administrativo == null) {
                return array("response"=>false);
            }
            
            $Pago_D=new Pago([
                'ID'=>NULL,
                'Monto'=>$args["Precio"],
                'Administrativo'=>$Administrativo->ID,
                'FechaCreado'=>$date_ahora,
                'FechaActualizado'=>NULL,
                'FechaEliminado'=>NULL
            ]);
            $Pago_D->save();

            $Pago = Pago::where("Administrativo",$Administrativo->ID)->where('FechaCreado',$date_ahora)->first();
            if ($Pago == null) {
                return array("response"=>false);
            }

            $Consulta = Consulta::find($args["ID"]);
            if ($Consulta == null) {
                return array("response"=>false);
            }
            Consulta::where('ID', $Consulta->ID)->update([
                'Persona'=>$args["Paciente"],
                'Medico'=>$args["Medico"],
                'Descripcion'=>$args["Descripcion"],
                'Hora'=>$args["Hora"],
                'FechaActualizado'=>$date_ahora
            ]);
            ConsultaPago::where('Consulta', $Consulta->ID)->update([
                'Pago'=>$Pago->ID,
                'Descripcion'=>$args["Descripcion"],
                'Total'=>$args["Precio"],
                'FechaActualizado'=>$date_ahora
            ]);
            PersonaConsulta::where('Consulta', $Consulta->ID)->update([
                'Persona'=>$args["Paciente"],
                'FechaActualizado'=>$date_ahora
            ]);

            return array("response"=>true);
        }
    ],
    'DeleteConsulta'=>[
        'type'=>$ResponseType,
        'args'=>[
            'ID'=>Type::nonNull(Type::int())
        ],
        'resolve'=>function($root,$args){
            $date_ahora=date("Y-m-d h:i:s");
            $Consulta = Consulta::find($args["ID"]);
            if ($Consulta == null) {
                return array("response"=>false);
            }
            Consulta::where('ID', $Consulta->ID)->update([
                'FechaEliminado'=>$date_ahora
            ]);
            ConsultaPago::where('Consulta', $Consulta->ID)->update([
                'FechaEliminado'=>$date_ahora
            ]);
            PersonaConsulta::where('Consulta', $Consulta->ID)->update([
                'FechaEliminado'=>$date_ahora
            ]);

            return array("response"=>true);
        }
    ],
    'CreateExamen'=>[
        'type'=>$ResponseType,
        'args'=>[
            'Usuario'=>Type::nonNull(Type::int()),
            'Paciente'=>Type::nonNull(Type::int()),
            'Medico'=>Type::nonNull(Type::int()),
            'Descripcion'=>Type::nonNull(Type::string()),
            'Precio'=>Type::nonNull(Type::float())
        ],
        'resolve'=>function($root,$args){
            $date_ahora=date("Y-m-d h:i:s");
            $Administrativo = Administrativo::where("Usuario",$args["Usuario"])->first();
            if ($Administrativo == null) {
                return array("response"=>false);
            }
            
            $Pago_D=new Pago([
                'ID'=>NULL,
                'Monto'=>$args["Precio"],
                'Administrativo'=>$Administrativo->ID,
                'FechaCreado'=>$date_ahora,
                'FechaActualizado'=>NULL,
                'FechaEliminado'=>NULL
            ]);
            $Pago_D->save();

            $Pago = Pago::where("Administrativo",$Administrativo->ID)->where('FechaCreado',$date_ahora)->first();
            if ($Pago == null) {
                return array("response"=>false);
            }
            
            $ExamenesMedicos_N=new ExamenesMedicos([
                'ID'=>NULL,
                'Persona'=>$args["Paciente"],
                'Descripcion'=>$args["Descripcion"],
                'Medico'=>$args["Medico"],
                'FechaCreado'=>$date_ahora,
                'FechaActualizado'=>NULL,
                'FechaEliminado'=>NULL
            ]);
            $ExamenesMedicos_N->save();

            $ExamenesMedicos = ExamenesMedicos::where("Persona",$args["Paciente"])->where('Medico',$args["Medico"])->where('FechaCreado',$date_ahora)->first();
            if ($ExamenesMedicos == null) {
                return array("response"=>false);
            }

            $ExamenesPago_N=new ExamenesPago([
                'ID'=>NULL,
                'Examen'=>$ExamenesMedicos->ID,
                'Pago'=>$Pago->ID,
                'Total'=>$args["Precio"],
                'FechaCreado'=>$date_ahora,
                'FechaActualizado'=>NULL,
                'FechaEliminado'=>NULL
            ]);
            $ExamenesPago_N->save();

            $PersonaExamen_N=new PersonaExamen([
                'ID'=>NULL,
                'Persona'=>$args["Paciente"],
                'Examen'=>$ExamenesMedicos->ID,
                'FechaCreado'=>$date_ahora,
                'FechaActualizado'=>NULL,
                'FechaEliminado'=>NULL
            ]);
            $PersonaExamen_N->save();

            return array("response"=>true);
        }
    ],
    'EditExamen'=>[
        'type'=>$ResponseType,
        'args'=>[
            'ID'=>Type::nonNull(Type::int()),
            'Usuario'=>Type::nonNull(Type::int()),
            'Paciente'=>Type::nonNull(Type::int()),
            'Medico'=>Type::nonNull(Type::int()),
            'Descripcion'=>Type::nonNull(Type::string()),
            'Precio'=>Type::nonNull(Type::float())
        ],
        'resolve'=>function($root,$args){
            $date_ahora=date("Y-m-d h:i:s");
            $Administrativo = Administrativo::where("Usuario",$args["Usuario"])->first();
            if ($Administrativo == null) {
                return array("response"=>false);
            }
            
            $Pago_D=new Pago([
                'ID'=>NULL,
                'Monto'=>$args["Precio"],
                'Administrativo'=>$Administrativo->ID,
                'FechaCreado'=>$date_ahora,
                'FechaActualizado'=>NULL,
                'FechaEliminado'=>NULL
            ]);
            $Pago_D->save();

            $Pago = Pago::where("Administrativo",$Administrativo->ID)->where('FechaCreado',$date_ahora)->first();
            if ($Pago == null) {
                return array("response"=>false);
            }
            $ExamenesMedicos = ExamenesMedicos::find($args["ID"]);
            if ($ExamenesMedicos == null) {
                return array("response"=>false);
            }

            ExamenesMedicos::where('ID', $ExamenesMedicos->ID)->update([
                'Persona'=>$args["Paciente"],
                'Descripcion'=>$args["Descripcion"],
                'Medico'=>$args["Medico"],
                'FechaActualizado'=>$date_ahora
            ]);
            ExamenesPago::where('Examen', $ExamenesMedicos->ID)->update([
                'Pago'=>$Pago->ID,
                'Total'=>$args["Precio"],
                'FechaActualizado'=>$date_ahora
            ]);
            PersonaExamen::where('Examen', $ExamenesMedicos->ID)->update([
                'Persona'=>$args["Paciente"],
                'FechaActualizado'=>$date_ahora
            ]);

            return array("response"=>true);
        }
    ],
    'DeleteExamen'=>[
        'type'=>$ResponseType,
        'args'=>[
            'ID'=>Type::nonNull(Type::int())
        ],
        'resolve'=>function($root,$args){
            $date_ahora=date("Y-m-d h:i:s");
            $ExamenesMedicos = ExamenesMedicos::find($args["ID"]);
            if ($ExamenesMedicos == null) {
                return array("response"=>false);
            }

            ExamenesMedicos::where('ID', $ExamenesMedicos->ID)->update([
                'FechaEliminado'=>$date_ahora
            ]);
            ExamenesPago::where('Examen', $ExamenesMedicos->ID)->update([
                'FechaEliminado'=>$date_ahora
            ]);
            PersonaExamen::where('Examen', $ExamenesMedicos->ID)->update([
                'FechaEliminado'=>$date_ahora
            ]);

            return array("response"=>true);
        }
    ],
];
?>