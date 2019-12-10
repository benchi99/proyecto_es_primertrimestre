$(document).ready(() => {
    $.ajax({
       url: URL + 'app/models/consultas_front.php?querytype=municipios',
       method: "GET",
       dataType: "json",
       complete: (response) => {
           rellenaProvincias(response.responseText);
       }
    });
});


