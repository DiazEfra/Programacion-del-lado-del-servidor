
<?php

importar('apps/artesanias/models/clasificacion');
importar('apps/artesanias/views/clasificacion');
importar('core/helpers/utilerias');

class ClasificacionController extends Controller  {

    public function agregar(){
        $sql = "SELECT * FROM clasificacion";
        $data = $this->model->query($sql);

        $this->view->agregar($data);
    }

    public function editar($id=0){
        $sql= "SELECT  A.padre 
            FROM clasificacion A WHERE A.id=$id ";

        $sql = "SELECT C.id, C.descripcion, C.padre,
          if(A.padre=C.id,'selected','') as selected
         FROM clasificacion as C, ($sql) as A";
        $clasificacionListado = $this->model->query($sql);
        $clasificacion = $this->model->getById($id);

        $this->view->editar($clasificacionListado, $clasificacion);
    }


    public function listar($formato){
        $sql = "SELECT C.id, C.descripcion, 
            IFNULL(P.descripcion, 'Ninguno') as padre 
                FROM clasificacion C LEFT JOIN clasificacion P 
                ON C.padre=P.id";
        $data = $this->model->query($sql);
        
        $this->view->listar($data);
       
    }

    public function guardar(){
       $id          = $_POST['id']?? 0;
       $descripcion = $_POST['descripcion'];
       $padre       = $_POST['padre'];
       //--- validar datos

       //--- asociar al modelo
       $this->model->id=$id;
       $this->model->descripcion = $descripcion;
       $this->model->padre       = $padre;
       $this->model->save();
       //--- 
       HTTPHelper::go("/artesanias/clasificacion/listar");
    }

    public function eliminar($id){
        $this->model->delete($id);
        HTTPHelper::go("/artesanias/clasificacion/listar");
    }
    
}

?>

