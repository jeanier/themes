var x;
x = $(document);
x.ready(inicializarEventos);

function inicializarEventos() {
    loadUsers();
    loadCustomers();        
}
function loadUsers() {
    $('#contenido').html("");
    $.post("users.php", function(response) {        
        $('#contenido').html(response);
        $('#contenido').fadeIn();
    });
}  

function loadCustomers() {
    $('#contenido').html("");
    $.post("customers.php", function(response) {        
        $('#contenido').html(response);
        $('#contenido').fadeIn();
    });
}  