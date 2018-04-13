<?php 
session_start();


//Connect to database from here
require_once('Connections/cstccon.php');

//get the posted values
$PO_NO=htmlspecialchars($_POST['PO_NO'],ENT_QUOTES);
$PART_NO=htmlspecialchars($_POST['id'],ENT_QUOTES);
$igst = htmlspecialchars($_POST['igst'],ENT_QUOTES);
//$cash_disc = htmlspecialchars($_POST['cash_disc'],ENT_QUOTES);
$sgst = htmlspecialchars($_POST['sgst'],ENT_QUOTES);
$cgst = htmlspecialchars($_POST['cgst'],ENT_QUOTES);
//$freight = htmlspecialchars($_POST['freight'],ENT_QUOTES);

$sql1="select * from poitm where PO_NO = '" . $PO_NO . "' AND PART_NO = '" . $PART_NO . "'";
$result1=mysqli_query($cstccon,$sql1);
$row1 = mysqli_fetch_assoc($result1);
$PO_QTY = $row1['PO_QTY'];
//$UNT_RT = $row1['UNT_RT'];




$sql="update item_receive_temp set cgst = '$cgst' , igst = '$igst',sgst = '$sgst' WHERE PART_NO = '$PART_NO'";
$result=mysqli_query($cstccon,$sql);

$sql7="update poitm set cgst = '$cgst' , igst = '$igst',sgst = '$sgst' WHERE PO_NO = '$PO_NO' AND PART_NO = '$PART_NO'";
$result7=mysqli_query($cstccon,$sql7);

?>
<script type="text/javascript">   
window.location = "CSTC_ItemReceipttaxGST.php";
</script>

