<?php

class Mensajes  {

    public static function show($mensaje=""){
        $str = file_get_contents(
            STATIC_DIR . "html/mensajes.html"); 
        $html = Template($str)->render(["mensaje"=>$mensaje]);
        print Template('AVISO')->show($html);
    } 
}

?>
