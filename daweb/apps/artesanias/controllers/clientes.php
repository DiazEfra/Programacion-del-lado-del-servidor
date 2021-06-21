
<?php

importar('apps/artesanias/models/clientes');
importar('apps/artesanias/views/clientes');
importar('core/helpers/utilerias');

class ClientesController extends Controller  {

    public function agregar(){
        $this->view->agregar();

    }

    public function editar($id=0){
        $id= intval($id);
        $cliente = $this->model->getById($id);
        $this->view->editar($cliente);

    }


    public function listar($formato){
        $sql="SELECT * FROM clientes";
        $listadoClientes = $this->model->query($sql);
        $this->view->listar($listadoClientes);
       
    }

    public function guardar(){
        $id                 = $_POST['id']?? 0;
        $nombreorazonsocial = $_POST['nombreorazonsocial'];
        $domicilio          = $_POST['domicilio'];
        $telefono           = $_POST['telefono'];
        $correo             = $_POST['correo'];
        $contacto           = $_POST['contacto'];
        //--- validar datos
         
        //--- asociar al modelo
        $this->model->id = $id;
        $this->model->nombreorazonsocial = $nombreorazonsocial;
        $this->model->domicilio = $domicilio;
        $this->model->telefono = $telefono;
        $this->model->correo = $correo;
        $this->model->contacto = $contacto;
 
        $this->model->save();
       //--- 
       HTTPHelper::go("/artesanias/clientes/listar");
    }

    public function eliminar($id){
        $this->model->delete(intval($id));
        HTTPHelper::go("/artesanias/clientes/listar");
    }
    
}

?>
