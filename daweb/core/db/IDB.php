<?php
interface IDB {
    public function connect();
    public function close();
    public function querySelect($sql);
    public function queryAction($sql, $values, $keyfield);
}
?>
