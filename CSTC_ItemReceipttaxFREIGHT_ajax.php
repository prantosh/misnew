<?php 
session_start();


//Connect to database from here
require_once('Connections/cstccon.php');

//get the posted values
$PO_NO=htmlspecialchars($_POST['id'],ENT_QUOTES);

$handle_pack = htmlspecialchars($_POST['handle_pack'],ENT_QUOTES);
//$cash_disc = htmlspecialchars($_POST['cash_disc'],ENT_QUOTES);
$freight = htmlspecialchars($_POST['freight'],ENT_QUOTES);
//$cgst = htmlspecialchars($_POST['cgst'],ENT_QUOTES);
//$freight = htmlspecialchars($_POST['freight'],ENT_QUOTES);



$sql7="update po set F08 = '$handle_pack' , F09 = '$freight' WHERE PO_NO = '$PO_NO' ";
$result7=mysqli_query($cstccon,$sql7);

?>
<script type="text/javascript">   
window.location = "CSTC_ItemReceipttaxFREIGHT.php";
</script>

