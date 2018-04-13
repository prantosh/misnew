<?php 
session_start();
if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');    
    
}
if(isset($_POST['advnc_no'])){
//Connect to database from here
require_once('Connections/cstccon.php');

$advnc_no = htmlspecialchars($_POST['advnc_no'],ENT_QUOTES);
$sql_itm11="select * from bill where advnc_no = '" . $advnc_no . "'";
$result31=mysqli_query($cstccon,$sql_itm11);
if(mysqli_num_rows($result31) > 0)
{
    echo 'yes';
}
}
?>
