<?php
require_once ("IDB.php");

class Postgres implements IDB
{
    private $conn ;
    private $host ;
    private $port ;
    private $db   ;
    private $user ;
    private $pwd  ;

    public function __construct($connectionInfo = []){
        $this->host = $connectionInfo['host'];
        $this->port = $connectionInfo['port'];
        $this->db   = $connectionInfo['db'];
        $this->user = $connectionInfo['user'];
        $this->pwd  = $connectionInfo['pwd'];
    } //--- fin constructor

    public function connect()
    {
        $conn_string = "host=".$this->host." port=".$this->port." dbname=". $this->db .
            " user=".$this->user." password=".$this->pwd." options='--client_encoding=UTF8'";
        //--- establecemos una conexion con el servidor postgresSQL
        $this->conn  = pg_connect($conn_string);
    }
    public function close(){
        if ($this->conn){
            pg_close($this->conn);
        }   
    }

    public function querySelect ($sql=""){
        $this->connect();
        $filas     = [];
        $resultado = pg_query($this->conn, $sql);
        while($fila= pg_fetch_assoc($resultado)){
            $filas[] = $fila;
        }
        pg_free_result($resultado);
        $this->close();
        return ($filas);
    } //--- fin  querySelect
   
    private function _getSql($sql) 
    {
        $i= 1; $n= strlen($sql); $p= strpos($sql, "?", 0);
        while ( $p > 0 ) {
            $sql = substr_replace($sql, ("$".$i), $p, 1);
            $p = strpos($sql, "?", 0);
            $i++ ;
        }
        return ($sql);
    }
    public function queryAction($sql, $values, $keyfield) 
    {

        $this->connect();
        if (strpos(ltrim($sql), "INSERT INTO ")==0) {
            $sql  = $sql . " RETURNING $keyfield";
        }
        $sql= $this->_getSql($sql);     
        pg_prepare($this->conn, "pst", $sql); 
	    $result= pg_execute($this->conn, "pst", $values);
              
        $this->close();
        return ($result);
    } //--- fin queryAction
    
} //--- fin clase Postgres
?>
