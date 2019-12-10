# Aplicación de Gestión "Paco's Garden"

Proyecto del primer trimestre para la Asignatura de Desarrollo Web en Entorno Servidor.

### Enunciado
La empresa de jardineria "Paco's Garden S.L"  se dedica a llevar el mantenimiento de jardines de empresas, comunidades de vecinos, etc. 
Debido a la mejora económica, la empresa ha aumentado enormemente su clientela en los últimos tiempos y su carga de trabajo ha aumentado lo que le ha permitido contratar nuevo personal. 
Para llevar un control preciso del trabajo a realizar precisa implementar un gestor de tareas que facilite el control y seguimiento de los trabajos que tiene encargados. 
Para ello nos ha encargado la realización de una aplicación web que permita llevar dicho control y permita a cada operario en cada momento saber las tareas que tiene pendientes y notificar cualquier incidencia o contratiempo que se produzca en la realización de las mismas.

### Instalación de la aplicación
1. Crea un esquema en MySQL llamado `proyecto_1trimestre`, e importe el script `proyecto_1trimestre.sql` en su base de datos.
2. Navegue a la carpeta `app/`, y edite el archivo `config.php`, cambiando la constante `URL` a la URL absoluta de tu servidor.
    ```php
    define("URL", "http://tudominio.com/ruta/a/carpeta/raiz/de/la/aplicacion/");
    ```
3. Navegue a la carpeta `assets/js/` y edite el archivo `global.js`, cambiando la constante `URL` a la URL absoluta de tu servidor.
    ```javascript
    const URL = "http://tudominio.com/ruta/a/carpeta/raiz/de/la/aplicacion/";
    ```