<?php

require 'config.php';

// Get all categories:
echo "<pre>";
$allCategories = Category::getAll();
print_r($allCategories);
echo "</pre>";

// Get categories with filter:
// echo "<pre>";
// $allCategories = Category::getAll("where id in (1,3,5)");
// print_r($allCategories);
// echo "</pre>";

// Change data in a database:
// $cat = Category::get(1);
// print_r($cat);
// $cat->name = "Action";
// $cat->description ="Action & Advanture";
// $cat->save();
// print_r($cat);

// insertion into the database:
// $cat = new Category;
// $cat->name = "My new category";
// $cat->description = "Some description";
// $cat->insert();

// Delete the category from database:
// $cat = new Category;
// $cat->delete(13);
