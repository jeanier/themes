<?php
require_once "../ruta.php";
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta. '/modelo/bo/usuarioBo.php';

switch ($_POST['action']) {
  case "login":  
    $clean =  $_POST['usu'];     
    $usuario  = trim ($clean," \t\n\r\0\x0B");  
    $password = $_POST['pwd']; 

    $bo = new usuarioBo();
    $r = $bo->identificarUsuarioBo($usuario, $password);
    print $r;          
    break;  
    
  case 'insert':
    $apaterno  = $_POST['apaterno'];
    $amaterno  = $_POST['amaterno'];
    $nombre    = $_POST['nombre'];
    $usuario   = $_POST['username'];
    $email     = $_POST['email'];
    $password  = $_POST['password'];
    $tipo      = $_POST['tipo'];
    $status    = $_POST['status'];

    $bo = new usuarioBo();
    $r = $bo->registrarUsuarioBo($apaterno, $amaterno, $nombre, $usuario, $email, $password, $tipo, $status);
    print $r;
    break; 

    case 'update':
         $usuario = $_POST['id'];

         $bo = new usuarioBo();
         $r = $bo->actualizarUsuarioBo($usuario);
         print $r;
         break; 

    case 'savedata':
        $id        = $_POST['a']; 
        $apaterno  = $_POST['b'];
        $amaterno  = $_POST['c'];
        $nombre    = $_POST['d'];
        $usuario   = $_POST['j'];
        $email     = $_POST['k'];
        $password  = $_POST['l'];
        $tipo      = $_POST['m'];
        $status    = $_POST['n'];

        $bo = new usuarioBo();
        $r = $bo->saveDataUsuarioBo($id, $apaterno, $amaterno, $nombre, $usuario,$email,$password , $tipo, $status);
        print $r;
        break;

    case 'delete':
        $usuario = $_POST['id'];

        $bo = new usuarioBo();
        $r = $bo->eliminarUsuarioBo($usuario);
        print $r;
        break;
    case 'select':
        $bo = new usuarioBo();
        $r = $bo->traeUsuariosBo();
        print $r;
        break;
}
  