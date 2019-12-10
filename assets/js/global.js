const URL = "http://localhost/ES/proyecto_es_primertrimestre/";  // TODO: CAMBIAR AL PONER EN PRODUCCION

function rellenaProvincias(datos) {
    let htmlContent = '<option value="-1"> </option>';

    for (let dato of datos) {
        let provincia = JSON.parse(dato);
        if ($('span#id_provincia').length && provincia.id === +$('span#id_provincia').html) {
            htmlContent += '<option value="'+provincia.id+'" selected>' + provincia.provincia + '</option>';
        } else {
            htmlContent += '<option value="'+provincia.id+'">' + provincia.provincia + '</option>';
        }
    }

    $('#provincias').html(htmlContent);
}

function actualizaSelectMunicipios(provincia) {
    $.ajax({
        url: URL + 'app/models/consultas_front.php?querytype=municipios&provincia=' + provincia,
        method: 'GET',
        dataType: 'json',
        complete: (response) => {
            let htmlContent = '', datos = JSON.parse(response.responseText);

            for (let dato of datos) {
                let dato_json = JSON.parse(dato);
                if ($('span#id_poblacion').length && provincia.id === +$('span#id_poblacion').html) {
                    htmlContent += '<option value="' + dato_json.id + '" selected>' + dato_json.municipio + '</option>';
                } else {
                    htmlContent += '<option value="' + dato_json.id + '">' + dato_json.municipio + '</option>';
                }
            }

            $('#poblaciones').removeAttr("disabled");
            $('#poblaciones').html(htmlContent);
        }
    });
}