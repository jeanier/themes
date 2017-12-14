<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/themes/ruta.php';
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta.'/modelo/dao/conexion.php';
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta.'/modelo/dao/procesaParametros.php';
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta.'/modelo/dao/customer/customerSql.php';
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta.'/vista/logicavista/notificationView.php';

class customerDao {
    private $con;
    
        function __construct() {
            $this->con=  conexion::conectar();
        }
        function __destruct() {
            $this->con->close();
        }  
     
    function  registrarCustomerDao($pagoid,$customerid, $userid,$companyid,$email,$date, $monto, $key, $status){
      $datosArray=array($customerid);
      $st=  procesaParametros::PrepareStatement(customerSql::validateIfExistsCustomer(),$datosArray);

      $query=$this->con->query($st);

      if($query->num_rows==0)
      {
        $rt = "CALL insertarCustomers ('$pagoid','$customerid','$userid','$companyid', '$email', '$date', '$monto', '$key','$status')";

        $query = $this->con->query($rt); 
        $result = Notification::registeredRecord($query);

      } 
      else
      {
        $result = Notification::existsUser();
      }
      return $result;
    }

    function saveDataCustomerDao($id, $pagoid,$customerid, $userid,$companyid,$email,$date, $monto, $key, $status) {
      $st = "UPDATE doo_payments SET payment_id='$pagoid', customer_id='$customerid', user_id='$userid', company_id='$companyid', payment_email='$email', payment_date='$date', payment_amount='$monto', payment_key='$key', payment_status='$status' WHERE ID = '$id'";
      $query = $this->con->query($st); 
      $result = Notification::updatedRecord($query);
      return $result;
    }

    function eliminarCustomerDao($customerid) {
      $st = "DELETE FROM doo_payments WHERE customer_id='$customerid'";
      $query = $this->con->query($st); 
      $result = Notification::deletedRecord($query);
       return $result;
    }

    function traeCustomerDao() {

      $data = "";
      $st = "SELECT * FROM doo_payments";
      $query= $this->con->query($st); 

      while ($row =  mysqli_fetch_array($query) ) {
      
      $editar = '<a href=\"#\" data-toggle=\"modal\" data-target=\"#myModalActualizaC\" id=\"'.$row['customer_id'].'\" onclick=\"traeDatosCustomerId(this)\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Editar\" class=\"btn btn-primary\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a>';
      $eliminar = '<a href=\"#\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Eliminar\" id=\"'.$row['customer_id'].'\" onclick=\"delCustomer(this)\" class=\"btn btn-danger\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a>';
        
        $data.='{
              "pagoid":"'.$row['payment_id'].'",
              "customerid":"'.$row['customer_id'].'",
              "userid":"'.$row['user_id'].'",
              "companyid":"'.$row['company_id'].'",
              "email":"'.$row['payment_email'].'",
              "date":"'.$row['payment_date'].'",              
              "monto":"'.$row['payment_amount'].'",
              "key":"'.$row['payment_key'].'",
              "status":"'.$row['payment_status'].'",           
              "acciones":"'.$editar.$eliminar.'"
            },';
    }
        $data = substr($data,0, strlen($data) - 1);
        $result =  '{"data":['.$data.']}';

        return $result;
    }

    function actualizarCustomerDao($customerid) {
      $cat = "";
      $st = "SELECT * FROM doo_payments WHERE customer_id = '$customerid'";

      $query= $this->con->query($st); 

      while ($row =  mysqli_fetch_array($query) ) {

        $cat = '
            <fieldset>
                <div class="form-group"> 
                    <input type="hidden" class="form-control" name="a" value="'.$row['ID'].'"> 
                    <input type="hidden" class="form-control" name="b" value="'.$row['payment_id'].'">    
                    <input type="hidden" class="form-control" name="c" value="'.$row['customer_id'].'">                       
                    <input type="hidden" class="form-control" name="d" value="'.$row['user_id'].'">  
                    <input type="hidden" class="form-control" name="e" value="'.$row['company_id'].'"> 
                    <input type="hidden" class="form-control" name="g" value="'.$row['payment_date'].'">  
                                              
                    <div class="col">
                        <div class="form-group" id="campoemail">
                            <label class="control-label" for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="f" autofocus value="'.$row['payment_email'].'" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group" id="campomonto">
                            <label class="control-label" for="monto">Monto</label>
                            <input type="text" class="form-control" id="monto" name="h" value="'.$row['payment_amount'].'" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group" id="campolicencia">
                            <label class="control-label" for="key">key License</label>
                            <input type="text" class="form-control" id="key" name="i" value="'.$row['payment_key'].'" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group" id="campoStatus">
                            <select class="form-control" id="status" name="j">
                                <option selected value="'.$row['payment_status'].'">--Click para cambiar--</option>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>                                    
                        </div>
                    </div>                            
                    <div class="col">
                        <div class="form-group">
                              <a href="#" class="btn btn-primary btn-block" onclick="upCustomer()">Actualizar</a>
                        </div>
                    </div>
                </div>   
            </fieldset>
        ';

    }
    return $cat;
    }
}
?>
