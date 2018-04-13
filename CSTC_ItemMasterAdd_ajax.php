<?php 
session_start();

//Connect to database from here
require_once('Connections/cstccon.php');

$CUR_FIN_YR = $_SESSION['CUR_FIN_YR'];
//$po_no = $_SESSION['po_no'];
$folio_no=htmlspecialchars($_POST['folio_no'],ENT_QUOTES);
$alt_no=htmlspecialchars($_POST['alt_no'],ENT_QUOTES);
$itm_nm=htmlspecialchars($_POST['itm_nm'],ENT_QUOTES);
$uom_id=htmlspecialchars($_POST['uom_id'],ENT_QUOTES);
$spec=htmlspecialchars($_POST['spec'],ENT_QUOTES);
$cat=htmlspecialchars($_POST['cat'],ENT_QUOTES);
$act=htmlspecialchars($_POST['act'],ENT_QUOTES);


$sql_itmz="select * from itm where PART_NO = '" . $folio_no . "'";
$result_itmz=mysqli_query($cstccon,$sql_itmz);
if(mysqli_num_rows($result_itmz) > 0)
    {?>
    <script type="text/javascript">
     alert("Folio Number Already Exists")
     
     document.location="CSTC_FindItem_Edit.php";

</script>
<?php 

    }
else 
    {
    $sql_itmz1="insert into itm(PART_NO,ALT_NO,ITM_NM,SPEC,SBGRP_ID,ACT_FLG,UOM_ID,CREUSR) values('" . $folio_no . "','" . $alt_no . "','" . $itm_nm . "','" . $spec . "','" . $cat . "','" . $act . "','" . $uom_id . "','" . $_SESSION['USER_ID'] . "')" ;
$result_itmz1=mysqli_query($cstccon,$sql_itmz1);
$sql_itmz11="insert into itmalias(PART_NO,ALIAS_NO,CREUSR) values('" . $folio_no . "','" . $alt_no . "','" . $_SESSION['USER_ID'] . "')" ;
$result_itmz11=mysqli_query($cstccon,$sql_itmz11);

$sql_itmz111="insert into current_part_no(PART_NO,ALT_NO_3,UPDUSR) values('" . $folio_no . "','" . $alt_no . "','" . $_SESSION['USER_ID'] . "')" ;
$result_itmz111=mysqli_query($cstccon,$sql_itmz111);

?>
<script type="text/javascript">
    alert("Item Added Successfully")
     document.location="CSTC_FindItem_Edit.php";
</script>
<?php

    }
?>




