<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Clientes</title>
    <!--CSS-->    
    <link rel="stylesheet" href="assets/css/bootstrap-yeti.css">
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.css">
</head>
<body>

    <div id="response"></div>

    <!-- DATATABLE -->
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <a href="#" class="btn btn-info" onclick="loadCustomers()"><i class="fa fa-refresh"></i>&nbsp;Refrescar</a>
            </div>
        </div>
        <div class="row">            
            <div id="mensaje-delete"></div>            
            <h1>Clientes               
                <a href="" data-toggle="modal" data-target="#myModalCus"  class="btn btn-success pull-right menu"><i class="fa fa-user-plus " aria-hidden="true"></i>&nbsp;Nuevo Cliente</a>
            </h1>  
        </div>
        <div class="row">    
        <table id="customers" class="table table-striped table-bordered table-responsive">
            <thead>
            <tr>
            <th>Pago ID</th>
            <th>C.ID</th>
            <th>U.ID</th>
            <th>COMP.ID</th>               
            <th>Email</th>
            <th>Fecha</th>
            <th>Monto</th>
            <th>Licencia Key</th>
            <th>Status</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
            <th>PagoID</th>
            <th>C.ID</th>
            <th>U.ID</th>
            <th>COMP.ID</th>               
            <th>Email</th>
            <th>Fecha</th>
            <th>Monto</th>
            <th>Licencia Key</th>
            <th>Status</th>
            <th>Acciones</th>
            </tr>
            </tfoot>
        </table>        
        </div>
    </div>
    <!-- END DATATABLE -->

    <!-- MODAL REGISTER -->
    <div class="modal fade in" id="myModalCus" >
        <div class="modal-dialog" style="width:20%;">
            <div class="modal-content" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
                    <h4 class="modal-title"><b></b>Registro de Clientes</h4>
                </div>
                <div class="modal-body">
                    <div class="row-fluid" id="notificacion"></div>
                    <form id="formregistroC"> 
                        <fieldset>
                            <div class="form-group">                            
                                <div class="col">
                                    <div class="form-group" id="campopagoid">
                                        <label class="control-label" for="pagoid">Payment ID</label>
                                        <input type="text" class="form-control" id="pagoid" name="payment_id" autofocus>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group" id="campocustomerid">
                                        <label class="control-label" for="customerid">Customer ID</label>
                                        <input type="text" class="form-control" id="customerid" name="customer_id">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group" id="campouserid">
                                        <label class="control-label" for="userid">User ID</label>
                                        <input type="text" class="form-control" id="userid" name="user_id">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group" id="campocompanyid">
                                        <label class="control-label" for="companyid">Company ID</label>
                                        <input type="text" class="form-control" id="companyid" name="company_id">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group" id="campoemail">
                                        <label class="control-label" for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="payment_email">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group" id="campofecha">
                                        <label class="control-label" for="date">Fecha</label>
                                        <input type="text" class="form-control" id="fecha" name="payment_date">
                                    </div>
                                </div> 
                                <div class="col">
                                    <div class="form-group" id="campomonto">
                                        <label class="control-label" for="monto">Monto</label>
                                        <input type="text" class="form-control" id="monto" name="payment_amount">
                                    </div>
                                </div> 
                                <div class="col">
                                    <div class="form-group" id="campolicencia">
                                        <label class="control-label" for="key">Licencia</label>
                                        <input type="text" class="form-control" id="key" name="payment_key">
                                    </div>
                                </div> 
                                <div class="col">
                                    <div class="form-group" id="campoStatus">
                                        <select class="form-control" id="status" name="payment_status">
                                            <option value="1">Activo</option>
                                            <option value="0">Inactivo</option>
                                        </select>                                    
                                    </div>
                                </div>                            
                                <div class="col">
                                    <div class="form-group">
                                         <button type="submit" class="btn btn-primary btn-block">Registrar</button>                                     
                                    </div>
                                </div>
                            </div>   
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">                
                </div>
            </div>
        </div>
     </div>
     <!-- END MODAL REGISTER -->

     <!-- MODAL UPDATE -->
    <div class="modal fade in" id="myModalActualizaC" >
        <div class="modal-dialog" style="width:25%;">
            <div class="modal-content" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><b></b>Actualizar Cliente</h4>
                </div>
                <div class="modal-body">
                    <div class="row-fluid" id="mensaje"></div>
                    <form id="formactualizarC">
                    <div id="contenido-update"></div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL UPDATE -->

    <!--Javascript-->    
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap.min.js"></script>          
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/customers.js"></script>
</body>
</html>