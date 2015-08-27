<?php

ob_start();

session_start(); 
//session_destroy();

defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR);


defined("TEMPLATE_FRONT") ? null : define("TEMPLATE_FRONT", __DIR__ . DS . "templates/front");

defined("TEMPLATE_BACK") ? null : define("TEMPLATE_BACK", __DIR__ . DS . "templates/back");

defined("UPLOAD_DIRECTORY_NORMAL") ? null : define("UPLOAD_DIRECTORY_NORMAL", __DIR__ . DS . "uploads/normal");
defined("UPLOAD_DIRECTORY_LARGE") ? null : define("UPLOAD_DIRECTORY_LARGE", __DIR__ . DS . "uploads/large");
defined("UPLOAD_DIRECTORY_MEDIUM") ? null : define("UPLOAD_DIRECTORY_MEDIUM", __DIR__ . DS . "uploads/medium");
defined("UPLOAD_DIRECTORY_SMALL") ? null : define("UPLOAD_DIRECTORY_SMALL", __DIR__ . DS . "uploads/small");


defined("DB_HOST") ? null : define("DB_HOST","localhost");

defined("DB_USER") ? null : define("DB_USER","root");


defined("DB_PASS") ? null : define("DB_PASS","");

defined("DB_NAME") ? null : define("DB_NAME","ecom_db");


$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

require_once("functions.php");
require_once("cart.php");
?>