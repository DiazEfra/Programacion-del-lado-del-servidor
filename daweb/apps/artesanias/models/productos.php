<?php
class Productos extends DAO {

    public function __construct() {
        $this->keyfield = "id";
        $this->id = 0;
        $this->descripcion = "";
        $this->producto = "";
        $this->clasificacion_id = 0;
        $this->artesano_id = 0;
        $this->precio = 0.0;
        $this->existencias = 0;
        $this->imagenes = "";
    } 
}
?>
