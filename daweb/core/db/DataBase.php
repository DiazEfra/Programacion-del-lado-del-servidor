<?php

require_once ("IDB.php");
class DataBase {
    private static $handlerDB;

    public static function setConnectionDB(IDB $handlerDB){
        self::$handlerDB = $handlerDB;
    }

    public static function query($sql){
        return (self::$handlerDB->querySelect($sql));
    }
    public static function queryAction($sql, $values, $keyfield){
        
        return(self::$handlerDB->queryAction($sql,
            $values, $keyfield));
    }
} //--- fin clase DataBase
?>