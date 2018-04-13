<?php 
session_start();
if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
 	echo ("Access Denied");
 	exit();
 }
include('Connections/cstccon.php'); 


$unit = $_SESSION['UNIT'];
  
$id=$_POST['route'];

$user_id = $_SESSION['USER_ID'];


$depot_route_desc1= $_POST['depot_route_desc'];

$sql="select * from cstcmis.route_master_depot where route_mis = '" . $id . "' and depot = '" . $unit . "'";
$result=mysqli_query($cstccon,$sql);
if(mysqli_num_rows($result)>0){
$sql_itm = "UPDATE cstcmis.route_master_depot SET depot_route_desc = '" . $depot_route_desc1 . "',op_code = '" . $user_id . "',upd_date = now() where route_mis = '" . $id . "' and depot = '" . $unit . "'"; 	
$result_itm=mysqli_query($cstccon,$sql_itm);
}
else{
 $sql_itm="insert into cstcmis.route_master_depot(depot,route_mis,depot_route_desc,upd_date,op_code) values('" . $_SESSION['UNIT'] . "','" . $id . "','" . $depot_route_desc1 . "',now(),'" . $user_id . "')";
$result_itm=mysqli_query($cstccon,$sql_itm);   
}


?> 
    <script language="javascript">
            alert('Record Updated Successfully');
             document.location='WBTC_DepotRouteMISRoute.php';
       </script>

								