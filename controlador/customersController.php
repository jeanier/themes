<?php
require_once "../ruta.php";
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta. '/modelo/bo/customerBo.php';

switch ($_POST['action']) {

    case 'insert':
    $pagoid     = $_POST['payment_id'];
    $customerid = $_POST['customer_id'];
    $userid     = $_POST['user_id'];
    $companyid  = $_POST['company_id'];
    $email      = $_POST['payment_email'];
    $date       = $_POST['payment_date'];
    $monto      = $_POST['payment_amount'];
    $key        = $_POST['payment_key'];
    $status     = $_POST['payment_status'];    

    $bo = new customerBo();
    $r = $bo->registrarCustomerBo($pagoid,$customerid, $userid,$companyid,$email,$date, $monto, $key, $status);
    print $r;
    break; 

    case 'update':
         $customerid = $_POST['id'];

         $bo = new customerBo();
         $r = $bo->actualizarCustomerBo($customerid);
         print $r;
         break; 

    case 'savedata':
        $id         = $_POST['a'];
        $pagoid     = $_POST['b'];  
        $customerid = $_POST['c'];
        $userid     = $_POST['d'];
        $companyid  = $_POST['e']; 
        $email      = $_POST['f'];    
        $date       = $_POST['g'];
        $monto      = $_POST['h'];        
        $key        = $_POST['i'];
        $status     = $_POST['j'];

        $bo = new customerBo();
        $r = $bo->saveDataCustomerBo($id,$pagoid,$customerid, $userid,$companyid,$email,$date, $monto, $key, $status);
        print $r;
        break;

    case 'delete':
        $customerid = $_POST['id'];

        $bo = new customerBo();
        $r = $bo->eliminarCustomerBo($customerid);
        print $r;
        break;
    case 'select':
        $bo = new customerBo();
        $r = $bo->traeCustomerBo();
        print $r;
        break;
}
  