<?php

$username = 'root';
$password = 'ujan1999';
$connection = new PDO( 'mysql:host=localhost;dbname=cstcmis', $username, $password );

$database_cstccon = "cstc_store";


$hostname_cstccon = "localhost";

$username_cstccon = "root";

$password_cstccon = "ujan1999";
$cstccon = mysqli_connect($hostname_cstccon, $username_cstccon, $password_cstccon, $database_cstccon);
?>