<?php

interface IReadable 
{
	public function getById($id=0);
	public function getAll();
	public function getByField($field, $value);

}

interface IWriteable
{
	//public function create(); 
	public function save();
}

interface IRemoveable
{
	public function delete($id=0);
	public function deleteAll();
}

?>

