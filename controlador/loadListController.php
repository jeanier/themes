<?php
require_once "../ruta.php";
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta. '/modelo/bo/usuarioBo.php';
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta. '/modelo/bo/customerBo.php';


switch ($_GET['action']) {
	case "users":  
		$bo = new usuarioBo();
		$r = $bo->traeUsuariosBo();
		print $r;
		break;

	case "customers":  
		$bo = new customerBo();
		$r = $bo->traeCustomerBo();
		print $r;
		break;
}


  