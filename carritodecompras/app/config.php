<?php

/**
 * url constante
 */
define('PORT','80' );
define('BASEPATH','/PROGRAMACION_7.3/moviles/carritodecompras/');
define('URL', 'http://127.0.0.1:'.PORT.BASEPATH);

/**
 * constantes para los path de archivos
 */
define('DS', DIRECTORY_SEPARATOR);
define('ROOT',getcwd().DS);
define('APP',ROOT.'app'.DS);
define('INCLUDES',ROOT.'includes'.DS);
define('VIEWS',ROOT.'views'.DS);

define('ASSETS', URL.'assets/');
define('CSS',ASSETS.'css/');
define('IMAGES',ASSETS.'images/');
define('JS',ASSETS.'js/');
define('PLUGINS',ASSETS.'plugins/');


?>