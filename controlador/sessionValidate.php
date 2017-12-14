<?php
require_once "../ruta.php";
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta. '/modelo/bo/usuarioBo.php';

$bo = new usuarioBo();
$r = $bo->sessionValidateBo();
