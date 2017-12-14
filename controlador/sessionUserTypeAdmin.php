<?php
require_once "../ruta.php";
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta. '/modelo/bo/usuarioBo.php';


$type = 1;

$np = new usuarioBo();
$r = $np->sessionUserTypeBo($type);
