<?php

class ProductosView  {

    public function agregar($artesanos=[], $clasificacion=[]){
        $str = file_get_contents(
            STATIC_DIR . "html/artesanias/productos_agregar.html"); 
        $html = Template($str)->render_regex('LISTADO_ARTESANOS', $artesanos);
        $html = Template($html)->render_regex('LISTADO_CLASIFICACION', $clasificacion);
        print Template('Agregar productos')->show($html);
    } 
    public function listar($productos = []){
        $str = file_get_contents(
            STATIC_DIR . "html/artesanias/productos_listar.html"); 
        $html = Template($str)->render_regex('LISTADO_PRODUCTOS', $productos);
        print Template('Productos')->show($html);
    } 
}

?>
