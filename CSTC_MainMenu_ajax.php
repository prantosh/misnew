<?php 
session_start();


//Connect to database from here
require_once('Connections/cstccon.php');



$sql1q="delete from item_receive_temp";
$result1q=mysqli_query($cstccon,$sql1q);

$query32q1 = "delete from item_receive_ctrl";
    $result32q1 = mysqli_query($cstccon,$query32q1) or die(mysqli_error());
?>
<script type="text/javascript">  
   
window.location = "CSTC_MainMenu.php";
</script>

