<?php 
session_start();

//Connect to database from here
require_once('Connections/cstccon.php');

$CUR_FIN_YR = $_SESSION['CUR_FIN_YR'];
//$po_no = $_SESSION['po_no'];
$vnd_id=htmlspecialchars($_POST['vnd_id'],ENT_QUOTES);
$vnd_nm=htmlspecialchars($_POST['vnd_nm'],ENT_QUOTES);
$addr_1=htmlspecialchars($_POST['addr_1'],ENT_QUOTES);
$addr_2=htmlspecialchars($_POST['addr_2'],ENT_QUOTES);
$addr_3=htmlspecialchars($_POST['addr_3'],ENT_QUOTES);
$zip=htmlspecialchars($_POST['zip'],ENT_QUOTES);
$tel=htmlspecialchars($_POST['tel'],ENT_QUOTES);
$email=htmlspecialchars($_POST['email'],ENT_QUOTES);
$gstin=htmlspecialchars($_POST['gstin'],ENT_QUOTES);
$act=htmlspecialchars($_POST['act'],ENT_QUOTES);


$sql_itmz="select * from vnd where VND_ID = '" . $vnd_id . "'";
$result_itmz=mysqli_query($cstccon,$sql_itmz);
if(mysqli_num_rows($result_itmz) > 0)
    {?>
    <script type="text/javascript">
     alert("Vendor Already Exists")
     
     document.location="CSTC_FindVendor_Edit.php";

</script>
<?php 

    }
else 
    {
    $sql_itmz1="insert into vnd(VND_ID,VND_NM,ADDR_1,ADDR_2,ADDR_3,ZIP,TEL,EMAIL,GSTIN,ACT_FLG,CREUSR) values('" . $vnd_id . "','" . $vnd_nm . "','" . $addr_1 . "','" . $addr_2 . "','" . $addr_3 . "','" . $zip . "','" . $tel . "','" . $email . "','" . $gstin . "','". $act . "','". $_SESSION['USER_ID'] . "')" ;
$result_itmz1=mysqli_query($cstccon,$sql_itmz1);?>
<script type="text/javascript">
    alert("Vendor Added Successfully")
     document.location="CSTC_FindVendor_Edit.php";
</script>
<?php

    }
?>




