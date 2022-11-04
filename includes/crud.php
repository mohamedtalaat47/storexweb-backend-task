<?php

include_once('db.php');

class Crud extends dbconnect
{

    public $columns = "";
    public $values = "";
    public $column = "";
    public $value = "";


    public function __construct()
    {
        parent::__construct();
    }


    public function selectalldata($table)
    {
        $select = "SELECT * FROM $table";
        $select1 = $this->connection->query($select);
        return $select1;
    }

    public function selectbyid($table, $id)
    {
        $sel = "SELECT * FROM $table where id=$id";
        $sel1 = $this->connection->query($sel);
        return mysqli_fetch_array($sel1);
    }

    public function insert($data, $table)
    {

        foreach ($data as $this->column => $this->value) {

            $this->columns .= ($this->columns == "") ? "" : ", ";
            $this->columns .= $this->column;

            $this->values .= ($this->values == "") ? "" : ", ";
            $this->values .= "'" . $this->value . "'";

        }

        $insert = ("INSERT into $table ($this->columns) values ($this->values)");

        $insert1 = $this->connection->query($insert);
    }

    public function update($data, $table, $id)
    {
        foreach ($data as $this->column => $this->value) {
            $update = ("UPDATE $table SET $this->column = '$this->value' WHERE id= '$id'");
            $this->connection->query($update);
        }
        return true;
    }

    function deletedata($table, $where)
    {
        $delete = ("DELETE FROM $table WHERE id=$where");
        $this->connection->query($delete);
        return true;
    }

    public function escape_string($value)
    {
        return $this->connection->real_escape_string($value);
    }

    public function catName($id){
        $sel = "SELECT c.title FROM categories as c INNER JOIN movies as m ON $id = c.id" ;
        $sel1 = $this->connection->query($sel);
        return mysqli_fetch_array($sel1);
    }

    public function count_rows($table){
        $select = "SELECT count(*) FROM $table";
        $sel1 = $this->connection->query($select);
        $result = mysqli_fetch_array($sel1);
        return $result[0];
    }

}
