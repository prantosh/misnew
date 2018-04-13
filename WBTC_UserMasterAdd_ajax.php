<?php 
session_start();

//Connect to database from here
require_once('Connections/cstccon.php');



$uname=htmlspecialchars($_POST['uname'],ENT_QUOTES);
$email=htmlspecialchars($_POST['email'],ENT_QUOTES);
$name=htmlspecialchars($_POST['name'],ENT_QUOTES);
$unit=htmlspecialchars($_POST['unit'],ENT_QUOTES);
$role=htmlspecialchars($_POST['role'],ENT_QUOTES);
$password=htmlspecialchars($_POST['password'],ENT_QUOTES);
$current_status=htmlspecialchars($_POST['current_status'],ENT_QUOTES);
$password_enc =sha1(md5(md5($password)));

$sql_itmz="select * from cstcmis.cstc_user where UNAME = '" . $uname . "'";
$result_itmz=mysqli_query($cstccon,$sql_itmz);
if(mysqli_num_rows($result_itmz) > 0)
    {?>
    <script type="text/javascript">
     alert("User ID Already Exists")
     
     document.location="WBTC_UserMaster.php";

</script>
<?php 

    }
else 
    {
    $sql_itmz1="insert into cstcmis.cstc_user(UNAME,PWD,EMAIL,NAME,UNIT,ROLE,CURRENT_STATUS,CREATED_BY) values('" . $uname . "','" . $password_enc . "','" . $email . "','" . $name . "','" . $unit . "','" . $role . "','" . $current_status . "','" . $_SESSION['USER_ID'] . "')" ;
    $result_itmz1=mysqli_query($cstccon,$sql_itmz1);


?>
<script type="text/javascript">
    alert("User Added Successfully")
    
     document.location="WBTC_UserMaster.php";
</script>
<?php

    }
?>




