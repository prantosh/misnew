<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$database_cstccon = "cstc_store";


$hostname_cstccon = "localhost";

$username_cstccon = "root";

$password_cstccon = "ujan1999";


$cstccon = mysqli_connect($hostname_cstccon, $username_cstccon, $password_cstccon, $database_cstccon);

//$cstccon = mysqli_connect($db_server, $db_username, $db_password) or trigger_error(mysqli_error(),E_USER_ERROR); 

$db_connection = $cstccon ;
?>