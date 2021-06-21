<?php
importar ('core/db/IPersistence');

abstract class DAO implements IReadable, IWriteable, IRemoveable {

    public function analizeObject(){
        $fields = [];
        $values = [];
        $ignoreProperties = ["keyfield", "driver", "connInfo"];
        foreach ($this as $k=>$v){
           if ( ( gettype($v) != "object") && 
                (!in_array($k, $ignoreProperties) ) ) {
                $fields[]= $k;
                $values[]= $v;
           }
        }//--- fin foreach
        $keyfield       = "" . $this->keyfield;
        $table          = "" . strtolower(get_class($this));
        return ([$table,$keyfield,$fields,$values]);
    }//--- fin analizeObject


    public function save(){
        list($table,$keyfield,$fields,$values) = $this->analizeObject();
        $id       = $values[array_search($keyfield, $fields)];

        if ($id==0) {
            $sql = "INSERT INTO $table (";
            $sql = $sql . implode(',', $fields) . ") " .
                    " VALUES (" . str_repeat("?,", count($values)); 
            //--- quitar la ultima coma y cerrar el parentesis del value
            $sql = substr($sql, 0, strlen($sql)-1) .  " )";
        } else {
            $sql = "UPDATE $table  SET ";
            $i   = 0; 
            $aux = "";
            foreach ($fields as $field){
                $aux = $aux . $field . "=?,";
                $i++;
            }
            //--- quitar la ultima coma
            $aux = substr($aux, 0, strlen($aux)-1);
            $sql = $sql . $aux . " WHERE $keyfield=?";
            $fields[]= $id; //--- para el caso de where 
            $values[]= $id;
            
        }
        $resultado = DataBase::queryAction($sql, $values, $keyfield);
        return ($resultado);
    }

    public function getAll() 
    {
        list($table) = $this->analizeObject();

        $sql="SELECT * FROM " . $table;
        $resultado = DataBase::query($sql);
        $clase     = ucwords($table);
        $listado   = [];
        $obj = new $clase;
        foreach ($resultado as $row) {
            foreach($row as $k=>$v){
                $obj->$k = $v;
            }
            $listado[] = $obj;
        }
        return ($listado);
    }//--- fin getAll

    public function getById($id = 0) 
    {
        list($table, $keyfield) = $this->analizeObject();
        $sql="SELECT * FROM " . $table .
            " WHERE $keyfield = $id";
        $resultado = DataBase::query($sql);
        $clase     = ucwords($table);
        $obj       = new $clase;
        foreach ($resultado as $row) {
            foreach($row as $k=>$v){
                $obj->$k= $v;
            }
        }
        return ($obj);
    }//--- fin getById

    public function getByField($field, $value){
        list($table, $keyfield) = $this->analizeObject();
        $sql="SELECT * FROM " . $table .
            " WHERE $field = $value";
        $resultado = DataBase::query($sql);
        $clase     = ucwords($table);
        $listado   = [];
        $obj = new $clase;
        foreach ($resultado as $row) {
            foreach($row as $k=>$v){
                $obj->$k = $v;
            }
            $listado[] = $obj;
        }
        return ($listado);
    }

    public function delete($id=0){
        list($table, $keyfield, $fields, $values) = $this->analizeObject();
        $sql="DELETE FROM " . $table . " WHERE $keyfield=?";
  
        return (DataBase::queryAction($sql, [intval($id)],$keyfield));
    } //--- fin delete

    public function deleteAll(){
        list($table, $keyfield, $fields, $values) = $this->analizeObject();
        $sql="DELETE FROM " . $table;
        return (DataBase::queryAction($sql, [], $keyfield));

    } //--- fin deleteAll
    
    public function query($sql){
        $resultado = DataBase::query($sql);
        return ($resultado);
    }

} //--- fin clase DAO
?>

