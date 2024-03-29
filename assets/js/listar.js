$(document).ready(() => {
    $.ajax({
        url: URL + 'app/models/consultas_front.php?querytype=all',
        method: "GET",
        dataType: "json",
        complete: (response) => {
            rellenaSelects(response.responseText);
        }
    });
});

function rellenaSelects(data) {
    let datos = JSON.parse(data);

    rellenarUsuarios("persona_contacto", datos[0]);
    rellenarUsuarios("persona_encargada", datos[0]);

    rellenaProvincias(datos[1]);
}

function rellenarUsuarios(nombre, datos) {
    let htmlContent = '<option value="-1"> </option>';

    if (nombre === "persona_contacto") {
        let editedDatos = [...datos];
        editedDatos.splice(0, 1);

        for (let dato of editedDatos) {
            let usuario = JSON.parse(dato);
            htmlContent += '<option value="'+usuario.usr_id+'">'+usuario.usr_nombre + ' ' +  usuario.usr_apellidos+'</option>'
        }
    } else {
        for (let dato of datos) {
            let usuario = JSON.parse(dato);
            htmlContent += '<option value="'+usuario.usr_id+'">'+usuario.usr_nombre + ' ' +  usuario.usr_apellidos+'</option>'
        }
    }

    $('#'+nombre).html(htmlContent);
}

