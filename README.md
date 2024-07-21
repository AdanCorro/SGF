# Proyecto de Creación de Facturas

Este proyecto permite la creación y gestión de facturas a través de un formulario web. Utiliza tecnologías como AngularJS para la interfaz de usuario y PHP con MySQL para la gestión del backend y la base de datos.

## Autores

- Majo
- Adan

## Descripción

La aplicación permite a los usuarios crear facturas ingresando datos en un formulario. Los datos se almacenan en una base de datos MySQL y se pueden consultar posteriormente.

## Instalación

### Prerrequisitos

- Node.js y npm
- Composer
- Servidor web (como Apache o Xampp)
- PHP
- MySQL

### Pasos de Instalación

1. Descarga el proyecto y descomprímelo en el directorio raíz de tu servidor web.

2. Instala las dependencias de Node.js:

   ```bash
   npm install
   ```

3. Configura la base de datos MySQL:

   ```sql
   CREATE DATABASE factura;
   USE factura;
   -- Aquí va el script SQL para crear las tablas necesarias
   ```

4. Configura la conexión a la base de datos en el archivo `conexion.php`:

   ```php
   // Información de conexión a la base de datos
   $dbConnect = array(
       'server' => 'localhost',
       'user' => 'root', -- Segun tu configuración de MySQL
       'pass' => '', -- Segun tu configuración de MySQL
       'dbname' => 'factura'
   );
   ```

   -- las conexiones se encuentran en los siguientes lugares:
   login0/connection.php
   mediaAdmin/conexion.php
   cuota.php
   factura.php
   insrtar_factura.php

5. Asegúrate de que el servidor web está configurado y en funcionamiento, y que el proyecto es accesible.

## Uso

1. Accede a la aplicación web a través de tu navegador.
2. Completa el formulario de creación de facturas con los datos requeridos.
3. Envía el formulario para almacenar la factura en la base de datos.
4. Usa la funcionalidad de consulta para ver las facturas creadas.

## Estructura del Proyecto

- `SQL/`: Contiene los scripts SQL y el archivo de conexión `conexion.php`.
- `build/css/`: Contiene las hojas de estilo CSS.
- `index.html`: El archivo principal de la interfaz de usuario.
- `app.js`: Archivo JavaScript principal para la lógica de AngularJS.
- `medioiAdmin/`: Contiene los scripts PHP para manejar las solicitudes del frontend.
- `controlador/`: Contiene los scripts de los controladores de la aplicación.

## Contribución

Las contribuciones son bienvenidas. Por favor, sigue estos pasos para contribuir:

1. Realiza los cambios necesarios en tu copia del proyecto.
2. Prueba los cambios localmente.
3. Documenta cualquier nueva funcionalidad o corrección de errores en el `README.md`.
4. Contacta a los autores para discutir y eventualmente incorporar los cambios al proyecto principal.

## Licencia

Este proyecto está licenciado bajo la MIT License. Ver el archivo `LICENSE` para más detalles.

## Créditos

Gracias a todos los que han contribuido a este proyecto.
