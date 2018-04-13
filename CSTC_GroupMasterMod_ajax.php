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
    {
    $sql_itmz1="update itmgrp set GRP_NM = '" . $grp_nm . "' where GRP_ID = '" . $grp_id . "'" ;
    $result_itmz1=mysqli_query($cstccon,$sql_itmz1);?>
    <script type="text/javascript">
        alert("Group Modified Successfully")
        document.location="CSTC_FindItmGrp_Edit.php";
    </script>
<?php

    }
    
 else   
    
    
    {?>
    <script type="text/javascript">
     alert("Group Does Not Exist")
     
     document.location="CSTC_FindItmGrp_Edit.php";

</script>
<?php 

    }

?>




