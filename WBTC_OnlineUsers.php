<style>
a:hover {
  color: black ;
 
}
</style>
<?php

session_start();
$session    = session_id();
$time       = time();
$time_check = $time-300;
$user       = $_SESSION['USER_ID'] ;//We Have Set Time 5 Minutes
$user       = $_SESSION['USER_ID'] ;//We Have Set Time 5 Minutes
$ip       = $_SESSION['IP'] ;//We Have Set Time 5 Minutes


require_once('Connections/cstccon.php'); 

$tbl_name = "cstcmis.online_users";  // Table name 

$query = "SELECT * FROM $tbl_name WHERE session='$session'";
$result = mysqli_query($cstccon,$query) or die(mysqli_error());
$count = mysqli_num_rows($result); 


//If count is 0 , then enter the values
if($count=="0"){ 
 $sql1    = "INSERT INTO $tbl_name(IP,user_id,session, time)VALUES('$ip','$user' ,'$session', '$time')"; 
 $result1 = mysqli_query($cstccon,$sql1);
}

 // else update the values 
 else {
 $sql2    = "UPDATE $tbl_name SET time='$time' WHERE session = '$session'"; 
 $result2 = mysqli_query($cstccon,$sql2); 
}

 $sql3              = "SELECT * FROM $tbl_name";
 $result3           = mysqli_query($cstccon,$sql3); 
 $count_user_online = mysqli_num_rows($result3);
 echo "<b><a href='WBTC_OnlineUserDetail.php'>Users Online : $count_user_online </a></b>";
 //echo "<b><a href=Users Online : </b> $count_user_online "; 

 // after 5 minutes, session will be deleted 
 $sql4    = "DELETE FROM $tbl_name WHERE time<$time_check"; 
 $result4 = mysqli_query($cstccon,$sql4); 

 //To see the result run this script in multiple browser. 
//mysqli_close();
 ?>