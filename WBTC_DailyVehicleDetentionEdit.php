<?php 
session_start();
error_reporting(E_ERROR|E_WARNING);
if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
 	echo ("Access Denied");
 	exit();
 }
include('Connections/cstccon.php'); 

 
$reason_heldup=$_POST['reason_non_out'];
$vehno=$_POST['veh_id'];

$query = "SELECT model FROM cstcmis.veh0214 where vehno = '" . $vehno . "'";
$Recordset = mysqli_query($cstccon,$query) or die(mysqli_error());
$row = mysqli_fetch_assoc($Recordset);
$model = $row['model'];


$unit = $_SESSION['UNIT'];
$user_id = $_SESSION['USER_ID'];


///$reason_heldup=htmlspecialchars($_POST['reason_heldup'],ENT_QUOTES);
//$heldup_from=htmlspecialchars($_POST['datepicker'],ENT_QUOTES);
//$target_ok_date=htmlspecialchars($_POST['datepicker1'],ENT_QUOTES);

//$heldup_from = substr($heldup_from,6,4) . '-' . substr($heldup_from,3,2) . '-' . substr($heldup_from,0,2) ;
//$target_ok_date = substr($target_ok_date,6,4) . '-' . substr($target_ok_date,3,2) . '-' . substr($target_ok_date,0,2) ;





$sql_itm2="update veh_cur_stat_op_tran set op_code = '" . $_SESSION['USER_ID'] . "',upd_date = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL '12:00' HOUR_MINUTE),'%Y-%m-%d') , ip = '" . $_SESSION['IP'] . "',cur_stat_op = '" . $reason_heldup . "' where vehno = '" . $vehno . "' and op_date = DATE_FORMAT(DATE_SUB(NOW(), INTERVAL '12:00' HOUR_MINUTE),'%Y-%m-%d')"; 
$result_itm2=mysqli_query($cstccon,$sql_itm2);

$sql_itm21="update veh_heldup_status set reason_heldup = '" . $reason_heldup . "' ,op_code = '" . $_SESSION['USER_ID'] . "' where vehno = '" . $vehno . "'"; 

//$sql_itm21="update veh_heldup_status set reason_heldup = '" . $reason_heldup . "',target_ok_date = '" . $target_ok_date . "',heldup_from = '" . $heldup_from . "' ,op_code = '" . $_SESSION['USER_ID'] . "' where heldup_to = '0000-00-000' and vehno = '" . $vehno . "'"; 
$result_itm21=mysqli_query($cstccon,$sql_itm21);

$yesterday = date('Y-m-d',strtotime("-1 days"));



if($reason_non_out == 'G'){
    $query33 = "update veh_heldup_status set heldup_to = '" . $yesterday . "' where vehno = '" . $vehno . "' and heldup_to = '0000-00-00'" ;
    $Recordset33 = mysqli_query($cstccon,$query33) or die(mysqli_error());   
}
if($reason_non_out == 'R'){
    $query33 = "update veh_heldup_status set heldup_to = '" . $yesterday . "' where vehno = '" . $vehno . "'  and heldup_to = '0000-00-00'" ;
    $Recordset33 = mysqli_query($cstccon,$query33) or die(mysqli_error());   
}
$sql22= "delete from veh_heldup_status_temp";
$result22=mysqli_query($cstccon,$sql22);
$sql221= "insert into veh_heldup_status_temp select distinct * from veh_heldup_status ";
$result221=mysqli_query($cstccon,$sql221);
$sql222= "delete from veh_heldup_status";
$result222=mysqli_query($cstccon,$sql222);

$sql2211= "insert into veh_heldup_status select * from veh_heldup_status_temp ";
$result2211=mysqli_query($cstccon,$sql2211);						
?> 
    <script language="javascript">
            alert('<?php echo "Record Updated Successfully" . $vehno . $reason_heldup ;?>');
             document.location='WBTC_DailyVehicleDetention.php';
       </script>
<?php
//header("Location:MIS_DailyEntryTrafficDisp.php");	

					
								
								