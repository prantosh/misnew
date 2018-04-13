<?php 
session_start();

//Connect to database from here
require_once('Connections/cstccon.php');

$CUR_FIN_YR = $_SESSION['CUR_FIN_YR'];
//$po_no = $_SESSION['po_no'];
$sbgrp_id=htmlspecialchars($_POST['sbgrp_id'],ENT_QUOTES);
$sbgrp_nm=htmlspecialchars($_POST['sbgrp_nm'],ENT_QUOTES);
$grp_id=htmlspecialchars($_POST['grp_id'],ENT_QUOTES);



$sql_itmz="select * from itmsbgrp where SBGRP_ID = '" . $sbgrp_id . "'";
$result_itmz=mysqli_query($cstccon,$sql_itmz);
if(mysqli_num_rows($result_itmz) > 0)
    {?>
    <script type="text/javascript">
     alert("Sub-Group Already Exists")
     
     document.location="CSTC_FindItemSubGrp_Edit.php";

</script>
<?php 

    }
else 
    {
    $sql_itmz1="insert into itmsbgrp(SBGRP_ID,SBGRP_NM,GRP_ID,CREUSR) values('" . $sbgrp_id . "','" . $sbgrp_nm . "','". $grp_id . "','". $_SESSION['USER_ID'] . "')" ;
$result_itmz1=mysqli_query($cstccon,$sql_itmz1);?>
<script type="text/javascript">
    alert("Sub-Group Added Successfully")
     document.location="CSTC_FindItemSubGrp_Edit.php";
</script>
<?php

    }
?>




