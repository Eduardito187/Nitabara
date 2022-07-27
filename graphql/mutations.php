<?php
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

require('mutations/Usuario.php');
require('mutations/Rol.php');

$mutations=array();
$mutations+=$Usuario;
$mutations+=$Rol;
$rootMutation=new ObjectType([
    'name'=>'Mutation',
    'fields' => $mutations
]);
?>
