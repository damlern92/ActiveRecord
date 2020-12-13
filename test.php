<?php

require 'config.php';

//Dobavljanje svih kategorija:
echo "<pre>";
$allCategories = Category::getAll("where id in (1,3,5)");
print_r($allCategories);
echo "</pre>";

// Izmena rezultata iz baze:
// $cat = Category::get(1);
// print_r($cat);
// $cat->name = "Action";
// $cat->description ="Action & Advanture";
// $cat->save(); //Uciniti izmenu prezistentnom
// print_r($cat);

// Ubacivanje u bazu podataka:
// $cat = new Category;
// $cat->name = "My new category";
// $cat->description = "Some description";
// $cat->insert();


// Brisanje kategorije iz baze podataka:
// $cat = new Category;
// $cat->delete(13);