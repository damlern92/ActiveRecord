<?php

abstract class ActiveRecord {
	// getAll vraca sve redove iz odredjene tabele:
    public static function getAll($filter=""){
        $q = mysqli_query(Database::getInstance(),"select * from ".static::$table." ".$filter);

        $res = array();
        while($rw=mysqli_fetch_object($q,get_called_class())) //Ovde ce biti Naziv klase koja je aktivirala ovaj metod
        $res[] = $rw; // Dobijanje niza objekata te klase
		return $res;
    }

    public static function get($id){
        $q = mysqli_query(Database::getInstance(),"select * from ".static::$table . " where ".static::$key." = " . $id);
        return mysqli_fetch_object($q,get_called_class());
    }

    //Ova metoda Bice instancna metoda, uzeti podatke koje imam na raspolaganju i njih staviti u bazu:
    public function save() {
        // UPDATE table(name) SET kolona1=vrednostA, kolona2=vrednostB;
        $q = "update " . static::$table . " set ";

        foreach($this as $k=>$v){ // This je polje objekta nad kome je pozvana ova metoda
            if($k==static::$key) continue; // Polje id ce biti ignorisano
            $q.=$k."='".$v."',"; // Dodavanje ostalih kolona u upit
        }

        $q = rtrim($q,","); // Oslobadjanje viska zareza
        // Filtracija:
        $keyField = static::$key;
        $q.="where".static::$key." = " . $this->$keyField; //Vrednost key kolone

        mysqli_query(Database::getInstance(),$q);  //Izvrsavanje upita

    }// End save() method

    public function insert(){// Istancna metoda insert kao i save
        $fields = get_object_vars($this);// Asociativni niz sa kljucevima i vrednostima:
        $keys  = array_keys($fields);// Niz sa kljucevima
        $values = array_values($fields);// Niz sa vrednostima

        // Upotrebiti gore iznad niz, da se napravi dva pod niza jedan sa kljucevima i jedan sa vrednostima
        $q = "insert into " . static::$table . "(";
        $q.= implode(",", $keys);
        $q.=") values ('";
        $q.= implode("','", $values);
        $q.="')";

        // $conn = Database::getInstance();
        mysqli_query(Database::getInstance(),$q);
        $keyField = static::$key;
        $this->$keyField = mysqli_insert_id(Database::getInstance());
		//mysqli_insert_id($conn) Funkcija vraca poslednji uneti id
		// Za ubacivanje nove kategorije u formi

    } // End of insert metod

    public static function delete($id){
        $q = "delete from " . static::$table . " where ". static::$key . " = " . $id;
        mysqli_query(Database::getInstance(),$q);
    }

}
