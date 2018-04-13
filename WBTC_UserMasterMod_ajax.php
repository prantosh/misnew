<?php 
session_start();

//Connect to database from here
require_once('Connections/cstccon.php');


//$user_id=htmlspecialchars($_POST['user_id'],ENT_QUOTES);
$uname=htmlspecialchars($_POST['uname'],ENT_QUOTES);
$email=htmlspecialchars($_POST['email'],ENT_QUOTES);
//$name=htmlspecialchars($_POST['name'],ENT_QUOTES);
$unit=htmlspecialchars($_POST['unit'],ENT_QUOTES);
$role=htmlspecialchars($_POST['role'],ENT_QUOTES);
$current_status=htmlspecialchars($_POST['current_status'],ENT_QUOTES);


$sql_itmz="select * from cstcmis.cstc_user where UNAME = '" . $uname . "'";
$result_itmz=mysqli_query($cstccon,$sql_itmz);
if(mysqli_num_rows($result_itmz) > 0)
    
    {
    if($email != ''){
        $sql_itmz1="update cstcmis.cstc_user set EMAIL = '" . $email . "' where UNAME = '" . $uname . "'" ;
        $result_itmz1=mysqli_query($cstccon,$sql_itmz1);
    }
   
        $sql_itmz1="update cstcmis.cstc_user set UNIT = '" . $unit . "',ROLE = '" . $role . "',CURRENT_STATUS = '" . $current_status . "' where UNAME = '" . $uname . "'" ;
        $result_itmz1=mysqli_query($cstccon,$sql_itmz1);
    
   


?>
<script type="text/javascript">
    alert("User Added Successfully")
     document.location="CSTC_UserMaster.php";
</script>
<?php

    }
    
else    
    
    
    
    
    
    
    
    {?>
    <script type="text/javascript">
     alert("User ID Does Not Exist")
     
     document.location="CSTC_UserMaster.php";

</script>
<?php 

    }

?>




