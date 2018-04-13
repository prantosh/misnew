<?php 
session_start();

//Connect to database from here
require_once('Connections/cstccon.php');

$CUR_FIN_YR = $_SESSION['CUR_FIN_YR'];
//$po_no = $_SESSION['po_no'];
$grp_id=htmlspecialchars($_POST['grp_id'],ENT_QUOTES);
$grp_nm=htmlspecialchars($_POST['grp_nm'],ENT_QUOTES);



$sql_itmz="select * from itmgrp where GRP_ID = '" . $grp_id . "'";
$result_itmz=mysqli_query($cstccon,$sql_itmz);
if(mysqli_num_rows($result_itmz) > 0)
    {?>
    <script type="text/javascript">
     alert("Group Already Exists")
     
     document.location="CSTC_FindItmGrp_Edit.php";

</script>
<?php 

    }
else 
    {
    $sql_itmz1="insert into itmgrp(GRP_ID,GRP_NM,CREUSR) values('" . $grp_id . "','" . $grp_nm . "','". $_SESSION['USER_ID'] . "')" ;
$result_itmz1=mysqli_query($cstccon,$sql_itmz1);?>
<script type="text/javascript">
    alert("Group Added Successfully")
     document.location="CSTC_FindItmGrp_Edit.php";
</script>
<?php

    }
?>




