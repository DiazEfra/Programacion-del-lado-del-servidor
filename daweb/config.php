<?php
session_start();
date_default_timezone_set("America/Mexico_City");

//require_once ('core/db/MySql');
class Driver { 
    const MYSQL='mysql';
    const POSTGRES='pgsql';
}

#--- Estado del proyecto
const PRODUCTION = FALSE;  #--- TRUE cuando esté en producción
#--  cadena de conexion



#--- Rutas absolutas
const APP_DIR = "C:/xampp8/htdocs/daweb/"; //AGREGAR LA RUTA DE LA CARPETA PARA CAMBIAR LA RUTA
const STATIC_DIR = "C:/xampp8/htdocs/daweb/static/"; 

#--- Directorio Web (ruta después del dominio. / para directorio raíz)
const WEB_DIR = "/";

#--- Ruta de la vista por defecto
const DEFAULT_VIEW = "/artesanias/clasificacion/listar";


#--- Configuraciones para las sesiones
const SESSION_LIFE_TIME = 1800;  # milisegundos 


require_once "connectioninfo";


const DB_DRIVER =Driver::MYSQL; #-- driver de mysql por defecto

#--- 
$allowed_resources = array(
"autor" => array('listar'),
);

#--- Configuración de directivas de php.ini
ini_set('include_path', APP_DIR);
if(!PRODUCTION) {
    ini_set('error_reporting', E_ALL | E_NOTICE | E_STRICT);
    ini_set('display_errors', '1');
    ini_set('track_errors', 'On');
} else {
    ini_set('display_errors', '0');
}


#--- Importación rápida

function importar($file='') {
    if (!file_exists(APP_DIR . "$file.php")){ 
        exit("FATAL ERROR: No se encontro el archivo ".APP_DIR."$file.php");
    }
    require_once "$file.php";

}
?>