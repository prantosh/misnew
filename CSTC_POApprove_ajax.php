<?php 
session_start();
if(isset($_POST['po_no1'])){
//Connect to database from here
require_once('Connections/cstccon.php');

//echo 'kolkata';
$po_no=htmlspecialchars($_POST['po_no1'],ENT_QUOTES);

$query =  "update po set STS = 'A' where PO_NO = '$po_no'";
                       
$result = mysqli_query($cstccon,$query) or die(mysqli_error());


}
?>

