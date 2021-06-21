<?php
/*
Authora: Eugenia bahit
*/
importar('core/mvc_engine/apphandler');
importar('core/mvc_engine/helper');
importar('core/helpers/http');
/*importar('core/api/api');*/


class FrontController {
   
    static function start() {
        list($modulo, $clase, $metodo, 
            $arg, $api) = ApplicationHandler::handler();

        $cfile          = MVCEngineHelper::set_name('file', $clase);
        $_cfile         = MVCEngineHelper::set_name('class', $clase);
        $controllername = MVCEngineHelper::set_name('controller', $clase);
        $class_name     = MVCEngineHelper::set_name('class', $metodo);

        $file  = APP_DIR . "apps/$modulo/controllers/$cfile.php";
        $_file = APP_DIR . "apps/$modulo/controllers/$_cfile.php";
        
       
       if(file_exists($file) || file_exists($_file)) {
            $file = file_exists($file) ? $file : $_file;
            require_once "$file";
            $controller = new $controllername($class_name, $arg, $api);
            if($api) {
                ApiRESTFul::get($controller->apidata, $clase, $metodo);
            }
        } else {
            HTTPHelper::go(DEFAULT_VIEW);
        }
    }
    
   
}


?>
