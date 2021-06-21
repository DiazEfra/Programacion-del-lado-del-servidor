<?php
class Artesanos extends DAO {

    public function __construct() {
        $this->keyfield = "id";
        $this->id = 0;
        $this->nombres = "";
        $this->primerapellido="";
        $this->segundoapellido="";
        $this->domicilio="";
        $this->telefono="";
        $this->correo="";
    }

}
?>
