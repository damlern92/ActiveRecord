<?php
// This file contains the database access information.
// This file also establishes a connection to MySQL,
// selects the database, and sets the encoding.

// Set the database access information as constants:
DEFINE ('DBHOST', 'localhost');
DEFINE ('DBUSER', 'root');
DEFINE ('DBPASS', '');
DEFINE ('DB', 'moviestore');

spl_autoload_register(function($className){
    require_once($_SERVER['DOCUMENT_ROOT'] ."/partial-from-shop/card/classes/{$className}.php");
});