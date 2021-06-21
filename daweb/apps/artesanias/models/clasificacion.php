<?php
class Clasificacion extends DAO {

    public function __construct() {
        $this->keyfield = "id";
        $this->id = 0;
        $this->descripcion = "";
        $this->padre = 0;
    } 
}
?>