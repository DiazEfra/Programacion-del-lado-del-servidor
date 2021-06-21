<?php
require_once ("IDB.php");
class MySql implements IDB
{
    private $conn ;
    private $host ;
    private $port ;
    private $db   ;
    private $user ;
    private $pwd  ;

    public function __construct($connectionInfo = []) {
        
        $this->host = $connectionInfo['host'];
        $this->port = $connectionInfo['port'];
        $this->db   = $connectionInfo['db'];
        $this->user = $connectionInfo['user'];
        $this->pwd  = $connectionInfo['pwd'];
    } //--- fin constructor

    public function connect()
    {
        $this->conn = new mysqli($this->host, 
            $this->user, $this->pwd, $this->db, $this->port);
        mysqli_set_charset($this->conn,'utf8mb4');
    }

   public function close() 
    {
        if ($this->conn) {
            $this->conn->close();
        }
    }

    public function querySelect($sql = "") 
    {
        $this->connect();
        $resultado = $this->conn->query($sql);
        $filas = [];
        while ($fila = $resultado->fetch_assoc()) {
            $filas[] = $fila; 
        }
        $resultado->free();
        $this->close();
        return ($filas);

    }//--- fin querySelect

    private function _getType($values = [] ) 
    {
        $type="";
        foreach ($values as $v)
        {
            switch (gettype($v)) {
                case "integer": $type .= "i"; break;
                case "string":  $type .= "s"; break;
                case "double":  $type .= "d"; break;
                default:  $type .="s";
            }
        }
        return ($type); 
    } //--- end getType

    private function _getParameters( $values = [] ) 
    {
        $types = $this->_gettype($values);
        //$parameters = [];
        $parameters [] = &$types; 
        $n= count($values);
        for ($i=0; $i < $n; $i++) {
            $parameters[] = &$values[$i];
        }
        return ($parameters);

    }
    public function queryAction($sql, $values, $keyfield) 
    {
        $this->connect();
        $stmt = $this->conn->prepare($sql);
        $parameters = $this->_getParameters($values);

        call_user_func_array(array($stmt , 'bind_param'), $parameters);
        $stmt->execute();
        $resp = $stmt->affected_rows>0;
        if (strpos(ltrim(strtoupper($sql)), "INSERT INTO ")==0) {
            $resp = $this->conn->insert_id;
        }
        $stmt->close();
        $this->close();
        return ($resp);
    } //--- fin queryAction
} //--- fin clase MySql
?>



