var x;
x = $(document);
x.ready(inicializarEventos);

function inicializarEventos() {
    loadDataTableCustomers();
    tooltip();
    rgCustomer();
}

function rgCustomer() {  
  $('#formregistroC').submit(function(event){
  event.preventDefault();
  var pagoid      = $("#pagoid").val();
  var customerid  = $("#customerid").val();
  var userid      = $("#userid").val();
  var companyid   = $("#companyid").val();
  var email       = $("#email").val();
  var date        = $("#fecha").val();
  var monto       = $("#monto").val();  
  var key         = $("#key").val();
  var status      = $("#status").val();
    
  if (pagoid == null || pagoid.length == 0) {
    $("#campopagoid").addClass("has-error");
    alert("Por favor ingresa el id del pago");
    return false;
  }
  else {
    $("#campopagoid").removeClass("has-error");
  }

  if (customerid == null || customerid.length == 0) {
    $("#campocustomerid").addClass("has-error");
    alert("Por favor ingresa el id del customer");
    return false;
  }else {
    $("#campocustomerid").removeClass("has-error");
  }

  if (userid == null || userid.length == 0) {
    $("#campouserid").addClass("has-error");
    alert("Por favor ingresa el id del usuario.")
    return false;
  }else {
    $("#campouserid").removeClass("has-error");    
  }
  
  if (companyid == null || companyid.length == 0) {
    $("#campocompanyid").addClass("has-error");
    alert("Por favor ingresa el id de la Cia.");
    return false;
  }else {
    $("#campocompanyid").removeClass("has-error");
  }

  if (email == null || email.length == 0) {
    $("#campoemail").addClass("has-error");
    alert("Por favor ingresa tu email");
    return false;
  }else {
    $("#campoemail").removeClass("has-error");
  }
     
  if (date == null || date.length == 0) {
    $("#campofecha").addClass("has-error");
    alert("Por favor ingresa la fecha");
    return false;
  }else {
    $("#campofecha").removeClass("has-error");    
  } 

  if (monto == null || monto.length == 0) {
    $("#campomonto").addClass("has-error");
    alert("Por favor ingresa el monto");
    return false;
  }else {
    $("#campomonto").removeClass("has-error");    
  }  

  if (key == null || key.length == 0) {
    $("#campolicencia").addClass("has-error");
    alert("Por favor ingresa la licencia");
    return false;
  }else {
    $("#campolicencia").removeClass("has-error");    
  }  

  if (status == null || status.length == 0) {
    $("#campoStatus").addClass("has-error");
    alert("Por favor Seleccione un estado");
    return false;
  }else {
    $("#campoStatus").removeClass("has-error");    
  } 
  
    $("#notificacion").html("");
    var datos = "action=insert&" + $("#formregistroC").serialize();
    $.post("../controlador/customersController.php", datos, function(data) {        
        $('#notificacion').html(data);
        $('#notificacion').fadeIn();  
    });    
  });
}

function upCustomer() {         
    $("#mensaje").html("");
    var datos = "action=savedata&" + $("#formactualizarC").serialize();
    $.post("../controlador/customersController.php", datos, function(data) {        
        $('#mensaje').html(data);
        $('#mensaje').fadeIn();
    });
}

function traeDatosCustomerId(customer) {
  $("#mensaje").html("");
  $('#contenido-update').html("");
  var id    = customer.id;
  var datos = "action=update&id="+id ;
  $.post("../controlador/customersController.php", datos, function(data) {
      $('#contenido-update').html(data);        
  });
}

function delCustomer(customer) { 
    if(confirm('¿Seguro que desea eliminar este cliente?')){
      $("#mensaje-delete").html("");
      var id    = customer.id;
      var datos = "action=delete&id="+id ;
      $.post("../controlador/customersController.php", datos, function(data) {
          $('#mensaje-delete').prepend(data);
          $('#mensaje-delete').show('slow');
          $('#mensaje-delete').fadeOut(5000);  
      });     
    } 
}

function loadCustomers() {
    $('#contenido').html("");
    $.post("customers.php", function(response) {        
        $('#contenido').html(response);
        $('#contenido').fadeIn();
    });
}  

function tooltip() {
   $('[data-toggle="tooltip"]').tooltip(); 
}

function loadDataTableCustomers() {
  $('#customers').DataTable( {  
    "bDeferRender": true,
    "ajax": "../controlador/loadListController.php?action=customers",        
    "columns": [
    { "data" : "pagoid" },
    { "data" : "customerid" },
    { "data" : "userid" },
    { "data" : "companyid"},
    { "data" : "email"},
    { "data" : "date"},
    { "data" : "monto"},
    { "data" : "key"},
    { "data" : "status"},
    { "data" : "acciones"}
    ],      
    "sPaginationType": "full_numbers",          
    "oLanguage": {
            "sProcessing":     "Procesando...",
        "sLengthMenu": 'Mostrar <select>'+
            '<option value="10">10</option>'+
            '<option value="20">20</option>'+
            '<option value="30">30</option>'+
            '<option value="40">40</option>'+
            '<option value="50">50</option>'+
            '<option value="-1">Todos</option>'+
            '</select> registros',    
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando del (_START_ al _END_) de un total de _TOTAL_ registros",
        "sInfoEmpty":      "Mostrando del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Filtrar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Por favor espere - cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
        }
  });
}
