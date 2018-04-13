
<?php
session_start(); 
if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
 	echo ("Access Denied");
 	exit();
 }
include('Connections/cstccon.php'); 
error_reporting(E_ERROR|E_WARNING);


$vehno= $_GET['q'];
$vehno = trim($vehno);
$maint_tp = $_SESSION['maint_tp']  ;
$shift = $_SESSION['shift']  ;
$route = $_SESSION['route']  ;

$unit = $_SESSION['UNIT'];
$user_id = $_SESSION['USER_ID'];
$ip = $_SESSION['IP'];

$query_Recordset31 = "SELECT tot_km from cstcmis.veh0214 where vehno = '" . $vehno . "'";
$Recordset31 = mysqli_query($cstccon,$query_Recordset31) or die(mysqli_error());
$row_Recordset31 = mysqli_fetch_assoc($Recordset31);
$maint_at_km = intval($row_Recordset31['tot_km']);


if($shift == '1' && $maint_tp == 'M'){
$query_Recordset32 = "SELECT * FROM cstcmis.maint_tran_mobile where shift = '1' and device = 'M' and maint_date = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL '12:30' HOUR_MINUTE),'%Y-%m-%d') and vehno  = '" . $vehno . "'";
$Recordset32 = mysqli_query($cstccon,$query_Recordset32) or die(mysqli_error());

if(mysqli_num_rows($Recordset32) > 1)
{
    $query_Recordset4 = "delete from cstcmis.maint_tran_mobile where vehno = '" .  $vehno . "' and maint_date = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL '12:30' HOUR_MINUTE),'%Y-%m-%d') and shift = '" . $shift . "' and device = '" . $maint_tp . "'";
    $Recordset4 = mysqli_query($cstccon,$query_Recordset4) or die(mysqli_error());    

}
else{
    $query_Recordset4 = "insert into cstcmis.maint_tran_mobile(vehno,depot,maint_date,maint_at_km,shift,device,route,op_code,ip) "
            . "values('" .  $vehno . "','" . $unit . "',DATE_FORMAT(DATE_ADD(NOW(), INTERVAL '12:30' HOUR_MINUTE),'%Y-%m-%d')," . intval($maint_at_km) . ",'" . $shift . "','" . $maint_tp . "','" . $route . "'," . $user_id . ",'" . $ip . "')";
    $Recordset4 = mysqli_query($cstccon,$query_Recordset4) or die(mysqli_error());    

}

}

$query_Recordset32 = "SELECT * FROM cstcmis.maint_tran_mobile where shift = '" . $shift . "' and device = '" . $maint_tp . "' and maint_date = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL '12:30' HOUR_MINUTE),'%Y-%m-%d') and vehno  = '" . $vehno . "'";
$Recordset32 = mysqli_query($cstccon,$query_Recordset32) or die(mysqli_error());

if(mysqli_num_rows($Recordset32) > 1)
{
    $query_Recordset4 = "delete from cstcmis.maint_tran_mobile where vehno = '" .  $vehno . "' and maint_date = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL '12:30' HOUR_MINUTE),'%Y-%m-%d') and shift = '" . $shift . "' and device = '" . $maint_tp . "'";
    $Recordset4 = mysqli_query($cstccon,$query_Recordset4) or die(mysqli_error());    

}
else{
    $query_Recordset4 = "insert into cstcmis.maint_tran_mobile(vehno,depot,maint_date,maint_at_km,shift,device,route,op_code,ip) "
            . "values('" .  $vehno . "','" . $unit . "',DATE_FORMAT(DATE_ADD(NOW(), INTERVAL '12:30' HOUR_MINUTE),'%Y-%m-%d')," . intval($maint_at_km) . ",'" . $shift . "','" . $maint_tp . "','" . $route . "'," . $user_id . ",'" . $ip . "')";
    $Recordset4 = mysqli_query($cstccon,$query_Recordset4) or die(mysqli_error());    

}



?>
<script language="javascript">
 window.location.href="CSTC_DailyMaintenanceEntry.php"; 
  </script>