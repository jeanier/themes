<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/themes/ruta.php';
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta. '/modelo/dao/customer/customerDao.php';

class customerBo{

    var $dao;

    function __construct() {
        $this->dao=new customerDao();
    }

    function identificarCustomerBo($pagoid, $customerid) {
        $resultado = $this->dao->identificarCustomerDao($pagoid, $customerid);
        return $resultado;
    }

    function registrarCustomerBo($pagoid,$customerid, $userid,$companyid,$email,$date, $monto, $key, $status) {
        $resultado = $this->dao->registrarCustomerDao($pagoid,$customerid, $userid,$companyid,$email,$date, $monto, $key, $status);
        return $resultado;
    }

    function traeCustomerBo(){
        $resultado = $this->dao->traeCustomerDao();
        return $resultado;
    }

    function actualizarCustomerBo($customerid) {
        $resultado = $this->dao->actualizarCustomerDao($customerid);
        return $resultado;
    }

    function saveDataCustomerBo($id,$pagoid,$customerid, $userid,$companyid,$email,$date, $monto, $key, $status) {
        $resultado = $this->dao->saveDataCustomerDao($id,$pagoid,$customerid, $userid,$companyid,$email,$date, $monto, $key, $status);
        return $resultado;
    }

    function eliminarCustomerBo($customerid) {
        $resultado = $this->dao->eliminarCustomerDao($customerid);
        return $resultado;
    }

    function logoutBo() {
        $resultado = $this->dao->logoutDao();
        return $resultado;
    }

    function sessionValidateBo() {
        $resultado = $this->dao->sessionValidateDao();
        return $resultado;
    }

    function sessionUserTypeBo($type) {
        $resultado = $this->dao->sessionUserTypeDao($type);
        return $resultado;
    }

}
?>
