<?php
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

require('mutations/Usuario.php');
require('mutations/Rol.php');
require('mutations/Administrador.php');

$mutations=array();
$mutations+=$Usuario;
$mutations+=$Rol;
$mutations+=$Administrador;
$rootMutation=new ObjectType([
    'name'=>'Mutation',
    'fields' => $mutations
]);

?>
