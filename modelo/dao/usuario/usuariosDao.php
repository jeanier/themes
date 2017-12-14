<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/themes/ruta.php';
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta.'/modelo/dao/conexion.php';
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta.'/modelo/dao/procesaParametros.php';
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta.'/modelo/dao/usuario/usuariosSql.php';
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta.'/vista/logicavista/notificationView.php';

class usuarioDao {

    private $con;

    function __construct() {
        $this->con=  conexion::conectar();
    }
    function __destruct() {
        $this->con->close();
    }

    function logoutDao() {
        session_start(); 
        session_destroy(); 
        print "<script>window.location='../index.php';</script>";  
    }

    function sessionValidateDao() {
        session_start(); 
        if (!isset($_SESSION['tipo'])) {
            print "<script>window.location='../index.php';</script>";  
        } 
    }

    function sessionUserTypeDao($type) {
        if ($_SESSION['tipo'] != $type) {
            print "<script>window.location='main.php';</script>";  
        } 
    }

    function  identificarUsuarioDao($usuario, $password) 
    {

        $datosArray=array($usuario,$password);

        if( $usuario == '' || $usuario === NULL || is_null($usuario) || $password == '' || $password === NULL || is_null($password) )
        {
          
            $result = Notification::requiredFields();

        } 
        else
        {

            $st = procesaParametros::PrepareStatement(usuariosSql::indentificarUsuario(),$datosArray);
            $query=$this->con->query($st);

            if($query->num_rows==0)
            {

                $result = Notification::incorrectCredentials();

            } 
            else 
            {

                $row = mysqli_fetch_array($query); 

                if ($row['status'] != 0) 
                {

                    session_start();
                    $_SESSION['ID']   = $row['ID']; 
                    $_SESSION['nombre']      = $row['apaterno'].' '.$row['amaterno'].' '.$row['nombre']; 
                    $_SESSION['tipo']        = $row['tipo'];               
                    $result = "<script>window.location='main.php';</script>"; 

                } 
                else 
                { 

                    $result = Notification::disableUser();                

                }
            }            
        }  

        return $result;     
    }

    function  registrarUsuarioDao($apaterno, $amaterno, $nombre, $usuario, $email, $password, $tipo, $status){
      $datosArray=array($usuario);
      $st=  procesaParametros::PrepareStatement(usuariosSql::validateIfExistsUser(),$datosArray);

      $query=$this->con->query($st);

      if($query->num_rows==0)
      {
        $rt = "CALL insertarUA ('$apaterno', '$amaterno', '$nombre', '$usuario', '$email', '$password', '$tipo', '$status', NOW())";
        $query = $this->con->query($rt); 
        $result = Notification::registeredRecord($query);
      } 
      else
      {
        $result = Notification::existsUser();
      }
      return $result;
    }

    function saveDataUsuarioDao($id, $apaterno, $amaterno, $nombre, $usuario, $email, $password, $tipo, $status) {
      $st = "UPDATE doo_admin SET apaterno='$apaterno', amaterno='$amaterno', nombre='$nombre', username='$usuario', email='$email', password='$password', tipo='$tipo', status='$status' WHERE ID = '$id'";
      $query = $this->con->query($st); 
      $result = Notification::updatedRecord($query);
      return $result;
    }

    function eliminarUsuarioDao($usuario) {
      $st = "DELETE FROM doo_admin WHERE username='$usuario'";
      $query = $this->con->query($st); 
      $result = Notification::deletedRecord($query);
       return $result;
    }

    function traeUsuariosDao() {

      $data = "";
      $st = "SELECT * FROM doo_admin";
      $query= $this->con->query($st); 

      while ($row =  mysqli_fetch_array($query) ) {
      
      $editar = '<a href=\"#\" data-toggle=\"modal\" data-target=\"#myModalActualiza\" id=\"'.$row['username'].'\" onclick=\"traeDatosUsuarioId(this)\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Editar\" class=\"btn btn-primary\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a>';
      $eliminar = '<a href=\"#\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Eliminar\" id=\"'.$row['username'].'\" onclick=\"delUsuario(this)\" class=\"btn btn-danger\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a>';
        
        $data.='{
              "id":"'.$row['ID'].'",
              "paterno":"'.$row['apaterno'].'",
              "materno":"'.$row['amaterno'].'",
              "nombre":"'.$row['nombre'].'",
              "usuario":"'.$row['username'].'",
              "email":"'.$row['email'].'",              
              "password":"'.$row['password'].'",
              "tipo":"'.$row['tipo'].'",
              "status":"'.$row['status'].'",
              "fecha":"'.$row['last_session'].'",             
              "acciones":"'.$editar.$eliminar.'"
            },';
    }
        $data = substr($data,0, strlen($data) - 1);
        $result =  '{"data":['.$data.']}';

        return $result;
    }

    function actualizarUsuarioDao($usuario) {
      $cad = "";
      $st = "SELECT * FROM doo_admin WHERE username = '$usuario'";

      $query= $this->con->query($st); 

      while ($row =  mysqli_fetch_array($query) ) {

        $cad = '
            <fieldset>
                <div class="form-group"> 
                    <input type="hidden" class="form-control" name="a" value="'.$row['ID'].'">                           
                    <div class="col-lg-4">
                        <div class="form-group" id="campoapaterno">
                            <label class="control-label" for="apaterno">Apellido paterno</label>
                            <input type="hidden" class="form-control" id="apaterno" name="b" autofocus value="'.$row['apaterno'].'" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group" id="campoamaterno">
                            <label class="control-label" for="amaterno">Apellido materno</label>
                            <input type="text" class="form-control" id="amaterno" name="c" value="'.$row['amaterno'].'" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group" id="camponombre">
                            <label class="control-label" for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="d" value="'.$row['nombre'].'" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                    <div class="form-group" id="campoemail">
                        <label class="control-label" for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="k" value="'.$row['email'].'" required>
                    </div>
                </div>
                    <div class="col-lg-6">
                        <div class="form-group" id="campousuario">
                            <label class="control-label" for="usuario">Usuario</label>
                            <input type="text" class="form-control" id="usuario" name="j" value="'.$row['username'].'" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group" id="campoclave">
                            <label class="control-label" for="clave">Clave de acceso</label>
                            <input type="password" class="form-control" id="password" name="l" value="'.$row['password'].'">
                        </div>
                    </div> 
                    <div class="col-lg-6">
                        <div class="form-group" id="campoTipo">
                            <select class="form-control" id="tipo" name="m">
                                <option selected value="'.$row['tipo'].'">--Click para cambiar--</option>
                                <option value="2">Cliente 1</option>
                                <option value="3">Cliente 2</option>
                                <option value="1">Administrador</option>                                        
                            </select>                                    
                        </div>
                    </div> 
                    <div class="col-lg-6">
                        <div class="form-group" id="campoStatus">
                            <select class="form-control" id="status" name="n">
                                <option selected value="'.$row['status'].'">--Click para cambiar--</option>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>                                    
                        </div>
                    </div>                            
                    <div class="col-lg-4 col-lg-offset-8">
                        <div class="form-group">
                              <a href="#" class="btn btn-primary btn-block" onclick="upUsuario()">Actualizar</a>
                        </div>
                    </div>
                </div>   
            </fieldset>
        ';

    }
    return $cad;
    }
}
?>
