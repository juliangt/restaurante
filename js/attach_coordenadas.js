function get_coordenadas() {
    
    function handle_geolocation_query(position){  
        $('#txt_ux').val(position.coords.latitude);
        $('#txt_uy').val(position.coords.longitude);
    }
    navigator.geolocation.getCurrentPosition(handle_geolocation_query);  
}

$(document).ready(function() {
    $('.dropdown-toggle').dropdown();
    get_coordenadas();
});

$("#btn-getcoordenadas").click(function() {
  get_coordenadas();
});

$("#btn-submit").click(function() {
    $("#form-solicitar").submit();
});
