<?php

class Category extends ActiveRecord {
	public $id,$name,$description;
    public static $table = "category_list";
    public static $key = "id";
}
