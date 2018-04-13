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
     {
    $sql_itmz1="update itmsbgrp set SBGRP_NM = '" . $sbgrp_nm . "',GRP_ID = '" . $grp_id . "' where SBGRP_ID = '" . $sbgrp_id . "'" ;
$result_itmz1=mysqli_query($cstccon,$sql_itmz1);?>
<script type="text/javascript">
    alert("Sub-Group Modified Successfully")
     document.location="CSTC_FindItemSubGrp_Edit.php";
</script>
<?php

    }
    
    
else    
    
    
    
    {?>
    <script type="text/javascript">
     alert("Sub-Group Does not Exist")
     
     document.location="CSTC_FindItemSubGrp_Edit.php";

</script>
<?php 

    }

?>




