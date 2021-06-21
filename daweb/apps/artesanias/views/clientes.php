<?php

class ClientesView  {

    public function agregar(){
        $str = file_get_contents(
            STATIC_DIR . "html/artesanias/clientes_agregar.html"); 
        print Template('Agregar Clientes')->show($str);
    } 



    public function editar($clientes){
        $str = file_get_contents(
            STATIC_DIR . "html/artesanias/clientes_editar.html"); 
        $html = Template($str)->render($clientes);
        print Template('Editar Clientes')->show($html);
    } 

    public function listar($listadoClientes=[]) {
        $str = file_get_contents(
            STATIC_DIR . "html/artesanias/clientes_listar.html"); 
        $html = Template($str)->render_regex('LISTADO_CLIENTES', $listadoClientes);
        print Template('Listado de clientes')->show($html);
    }

}

?>



