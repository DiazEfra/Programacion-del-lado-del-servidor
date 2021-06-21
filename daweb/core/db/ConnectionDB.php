<?php
require_once ("IDB.php");
class ConnectionDB {
    public $handlerDB;
    public function __construct(IDB $handler){
        $this->$handlerDB = $handler;
    }
    
}