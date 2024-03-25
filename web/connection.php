<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "poject_login_db";

if(!$con =mysqli_connect($dbhost,$dbuser ,$dbpass,$dbname )){
    die("faild to conetct");
}