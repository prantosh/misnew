
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
$maint_type = $_SESSION['maint_type']  ;
//echo $vehno;
$maint_date = $_SESSION['maint_date']  ;
$maint_date = substr($maint_date,6,4) . '-' .substr($maint_date,3,2) . '-' . substr($maint_date,0,2) ;  
$unit = $_SESSION['UNIT'];
$user_id = $_SESSION['USER_ID'];
$ip = $_SESSION['IP'];
//echo $maint_date . $maint_type;
$query_Recordset31 = "SELECT tot_km from cstcmis.veh0214 where vehno = '" . $vehno . "'";
$Recordset31 = mysqli_query($cstccon,$query_Recordset31) or die(mysqli_error());
$row_Recordset31 = mysqli_fetch_assoc($Recordset31);
$maint_at_km = intval($row_Recordset31['tot_km']);


//echo intval($maint_type) . ",'" . $vehno . "','" . $unit . "','" . $maint_date . "'," . intval($maint_at_km) . "," . $user_id . ",'" . $ip . "')";
//echo $maint_type . '*' . $vehno . '*' . $unit . '*' . $maint_date . '*' . intval($maint_at_km) . '*' . $user_id . '*' . $ip;
//echo $vehno;

$query_Recordset32 = "SELECT distinct maint_code FROM cstcmis.maint_tran where maint_code = " . $maint_type . " and maint_date = '" . $maint_date . "' and vehno  = '" . $vehno . "'";
    

$Recordset32 = mysqli_query($cstccon,$query_Recordset32) or die(mysqli_error());
//$result = mysqli_fetch_assoc($Recordset32);

if(mysqli_num_rows($Recordset32) < 1)
{
    
    // insert into maint_tran(maint_code,vehno,depot,maint_date,maint_at_km,op_code,upd_date,ip) values(3,'WB04D0278','LD','2015-11-25',3,202,'2015-11-27','12345')
   
  
         $query_Recordset4 = "insert into cstcmis.maint_tran(maint_code,vehno,depot,maint_date,maint_at_km,op_code,ip) "
            . "values(" . intval($maint_type) . ",'" . $vehno . "','" . $unit . "','" . $maint_date . "'," . intval($maint_at_km) . "," . $user_id . ",'" . $ip . "')";
  
    


//$query_Recordset4 = "insert into maint_tran(maint_code) values(" . intval($maint_type) . ")";

 // $query_Recordset4 = "insert into maint_tran(maint_code,vehno,depot,maint_date,maint_at_km,op_code,upd_date,ip) values(3,'WB04C9734','LD','2015-11-25',123,222,'2015-11-27','12345')";
$Recordset4 = mysqli_query($cstccon,$query_Recordset4) or die(mysqli_error());    

}
else{
    
    $query_Recordset321 = "DELETE FROM cstcmis.maint_tran where maint_code = " . intval($maint_type) . " and maint_date = '" . $maint_date . "' and vehno like '%" . $vehno . "%'";
    
        $Recordset321 = mysqli_query($cstccon,$query_Recordset321) or die(mysqli_error());

}


//echo intval($maint_type) . ",'" . $vehno . "','" . $unit . "','" . $maint_date . "'," . intval($maint_at_km) . "," . $user_id . ",'" . $ip . "')";

?>
<script language="javascript">
 window.location.href="WBTC_DailyMaintenance.php"; 
  </script>