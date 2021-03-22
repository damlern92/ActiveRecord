<?php

abstract class ActiveRecord {
    // Get all data from specified table:
    public static function getAll($filter=""){
        $q = mysqli_query(Database::getInstance(),"select * from ".static::$table." ".$filter);

        $res = array();

        while($rw=mysqli_fetch_object($q,get_called_class())) // Here is the name of the class that is actvated this method
        $res[] = $rw; // Object of that class

		return $res;
    }

    public static function get($id){
        $q = mysqli_query(Database::getInstance(),"select * from ".static::$table . " where ".static::$key." = " . $id);
        return mysqli_fetch_object($q,get_called_class());
    }


    public function save() {
        // example UPDATE table(name) SET column=valueA, column2=valueB;
        $q = "update " . static::$table . " set ";

        foreach($this as $k=>$v){ // This is a field of the object
            if($k==static::$key) continue; // the field id will be ignored
            $q.=$k."='".$v."',";
        }

        $q = rtrim($q,","); // Remove more comma
        // Filtracija:
        $keyField = static::$key;
        $q.="where".static::$key." = " . $this->$keyField; // key field value

        mysqli_query(Database::getInstance(),$q); 

    }// End save() method

    public function insert(){
        $fields = get_object_vars($this);// Gain array with keys and valus
        $keys  = array_keys($fields);// array with keys
        $values = array_values($fields);// array with values


        $q = "insert into " . static::$table . "(";
        $q.= implode(",", $keys);
        $q.=") values ('";
        $q.= implode("','", $values);
        $q.="')";

        // $conn = Database::getInstance();
        mysqli_query(Database::getInstance(),$q);
        $keyField = static::$key;
        $this->$keyField = mysqli_insert_id(Database::getInstance());
		// Get the last id

    } // End of insert metod

    public static function delete($id){
        $q = "delete * from " . static::$table . " where ". static::$key . " = " . $id;
        mysqli_query(Database::getInstance(),$q);
    }

}
