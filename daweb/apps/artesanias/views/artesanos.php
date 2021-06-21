<?php

class ArtesanosView  {

    public function agregar(){
        $str = file_get_contents(
            STATIC_DIR . "html/artesanias/artesanos_agregar.html"); 
        print Template('Agregar Artesanos')->show($str);
    } 



    public function editar($artesano){
        $str = file_get_contents(
            STATIC_DIR . "html/artesanias/artesanos_editar.html"); 
        $html = Template($str)->render($artesano);
        print Template('Editar Artesano')->show($html);
    } 

    public function listar($listadoArtesanos=[]) {
        $str = file_get_contents(
            STATIC_DIR . "html/artesanias/artesanos_listar.html"); 
        $html = Template($str)->render_regex('LISTADO_ARTESANOS', $listadoArtesanos);
        print Template('Listado de Artesanos')->show($html);
    }

}

?>

