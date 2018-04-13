<?php 
session_start();

//Connect to database from here
require_once('Connections/cstccon.php');

$CUR_FIN_YR = $_SESSION['CUR_FIN_YR'];
//$po_no = $_SESSION['po_no'];
$vnd_id=htmlspecialchars($_POST['vnd_id'],ENT_QUOTES);
//$vnd_nm=htmlspecialchars($_POST['vnd_nm'],ENT_QUOTES);
$addr_1=htmlspecialchars($_POST['addr_1'],ENT_QUOTES);
$addr_2=htmlspecialchars($_POST['addr_2'],ENT_QUOTES);
$addr_3=htmlspecialchars($_POST['addr_3'],ENT_QUOTES);
$zip=htmlspecialchars($_POST['zip'],ENT_QUOTES);
$tel=htmlspecialchars($_POST['tel'],ENT_QUOTES);
$email=htmlspecialchars($_POST['email'],ENT_QUOTES);
//$gstin=htmlspecialchars($_POST['gstin'],ENT_QUOTES);
$act=htmlspecialchars($_POST['act'],ENT_QUOTES);


$sql_itmz="select * from vnd where VND_ID = '" . $vnd_id . "'";
$result_itmz=mysqli_query($cstccon,$sql_itmz);
if(mysqli_num_rows($result_itmz) > 0)
     {
    if($vnd_nm != ''){
        $sql_itmz1="update vnd set VND_NM = '" . $vnd_nm . "' where VND_ID = '" . $vnd_id . "'" ;
        $result_itmz1=mysqli_query($cstccon,$sql_itmz1);
    }
    if($addr_1 != ''){
        $sql_itmz1="update vnd set ADDR_1 = '" . $addr_1 . "' where VND_ID = '" . $vnd_id . "'" ;
        $result_itmz1=mysqli_query($cstccon,$sql_itmz1);
    }
    if($addr_2 != ''){
        $sql_itmz1="update vnd set ADDR_2 = '" . $addr_2 . "' where VND_ID = '" . $vnd_id . "'" ;
        $result_itmz1=mysqli_query($cstccon,$sql_itmz1);
    }
    if($addr_3 != ''){
        $sql_itmz1="update vnd set ADDR_3 = '" . $addr_3 . "' where VND_ID = '" . $vnd_id . "'" ;
        $result_itmz1=mysqli_query($cstccon,$sql_itmz1);
    }
    if($zip != ''){
        $sql_itmz1="update vnd set ZIP = '" . $zip . "' where VND_ID = '" . $vnd_id . "'" ;
        $result_itmz1=mysqli_query($cstccon,$sql_itmz1);
    }
    if($tel != ''){
        $sql_itmz1="update vnd set TEL = '" . $tel . "' where VND_ID = '" . $vnd_id . "'" ;
        $result_itmz1=mysqli_query($cstccon,$sql_itmz1);
    }
    if($email != ''){
        $sql_itmz1="update vnd set EMAIL = '" . $email . "' where VND_ID = '" . $vnd_id . "'" ;
        $result_itmz1=mysqli_query($cstccon,$sql_itmz1);
    }
        $sql_itmz1="update vnd set ACT_FLG = '" . $act . "' where VND_ID = '" . $vnd_id . "'" ;
        $result_itmz1=mysqli_query($cstccon,$sql_itmz1);
        
    ?>
<script type="text/javascript">
    alert("Vendor Added Successfully")
     document.location="CSTC_FindVendor_Edit.php";
</script>
<?php

    }
    
    
    
    
    
 else {
        
}   {?>
    <script type="text/javascript">
     alert("Vendor Does not Exist")
     
     document.location="CSTC_FindVendor_Edit.php";

</script>
<?php 

    }

?>




