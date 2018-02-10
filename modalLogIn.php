<?php
include '../funkcije.php';
session_start();

$obj1 = new Validation($_POST["username"]);
$obj2 = new Validation($_POST["pwd"]);

$_SESSION["username"] = $obj1 -> test_input($obj1 -> getData());
$_SESSION["pwd"] = $obj2 -> test_input($obj2 -> getData());

?>