<?php
/*
Authora: Eugenia bahit
*/
importar ('core/helpers/http');


class ApplicationHandler {

    private static $uri = '';
    private static $peticiones = array();

    protected static $modulo = '';
    protected static $modelo = '';
    protected static $metodo = '';
    protected static $arg = '';
    protected static $api = False;


    static function handler() {
        self::set_uristr();
        self::set_array();
        self::set_peticiones();
        self::check();
        return array(self::$modulo, 
                     self::$modelo,
                     self::$metodo,
                     self::$arg,
                     self::$api);
    }
    private static function set_uristr() {
        $srvuri = $_SERVER['REQUEST_URI'];
        if(WEB_DIR != "/") {
            self::$uri = str_replace(WEB_DIR, "", $srvuri);
        } else {
            self::$uri = substr($srvuri, 1);
        }
    }

    private static function set_array() {
        self::$peticiones = explode("/", self::$uri);
        if(self::$peticiones[0] == 'api') {
            array_shift(self::$peticiones);
            self::$api = True;
        }
    }

    private static function set_peticiones() {
        if(count(self::$peticiones) == 3) {
            list(self::$modulo, self::$modelo,
                self::$metodo) = self::$peticiones;
        } elseif(count(self::$peticiones) == 4) {
            list(self::$modulo, self::$modelo, self::$metodo,
                self::$arg) = self::$peticiones;
        }
    }

    private static function check() {
        $mu = empty(self::$modulo);
        $mo = empty(self::$modelo);
        $me = empty(self::$metodo);
        if($mu || $mo || $me) HTTPHelper::go(DEFAULT_VIEW);
    }

}

?>