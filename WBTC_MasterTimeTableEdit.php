<?php 
session_start();
error_reporting(E_ERROR|E_WARNING);
if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
 	echo ("Access Denied");
 	exit();
 }
include('Connections/cstccon.php'); 

$route = $_SESSION['route'];


$user_id = $_SESSION['USER_ID'];
$route=htmlspecialchars($_POST['route'],ENT_QUOTES);
$stop_desc=htmlspecialchars($_POST['stop_desc'],ENT_QUOTES);
$shift=htmlspecialchars($_POST['shift'],ENT_QUOTES);
//$car_no_depot=htmlspecialchars($_POST['car_no_depot'],ENT_QUOTES);
$car_no_terminus=htmlspecialchars($_POST['car_no_terminus'],ENT_QUOTES);
$hour=htmlspecialchars($_POST['hour'],ENT_QUOTES);
$minute1=htmlspecialchars($_POST['minute1'],ENT_QUOTES);

$dept_time = $hour . ":" . $minute1;

$query_Recordset3 = "SELECT * FROM cstcmis.time_table where route = '" . $route . "' and shift = " . $shift . " and car_no_terminus = " . $car_no_terminus . " and stop_code = (select STOP_CODE from cstcmis.stop_master where STOP_DESC = '" . $stop_desc . "')";
$Recordset3 = mysqli_query($cstccon,$query_Recordset3) or die(mysqli_error());
$row_Recordset3 = mysqli_fetch_assoc($Recordset3);

$query_Recordset2 = "SELECT * FROM cstcmis.unit where TYPE = 'D' ORDER BY UNIT_DESC";
$Recordset2 = mysqli_query($cstccon,$query_Recordset2) or die(mysqli_error());
$row_Recordset2 = mysqli_fetch_assoc($Recordset2);

$query_Recordset21 = "SELECT * FROM cstcmis.stop_master where STOP_DESC = '" . $stop_desc . "'";
$Recordset21 = mysqli_query($cstccon,$query_Recordset21) or die(mysqli_error());
$row_Recordset21 = mysqli_fetch_assoc($Recordset21);
$terminus = $row_Recordset21['STOP_CODE'];
//echo $dept_time . $route . $shift . $terminus . $car_no_terminus ;
  $sql_itm1="update cstcmis.time_table set dept_time = '" . $dept_time . "' where route = '" . $route . "' and shift = '" . $shift . "' and stop_code = " . $terminus . " and car_no_terminus = " . $car_no_terminus ;  
$result_itm1=mysqli_query($cstccon,$sql_itm1);

?>
    <script language="javascript">
            alert('Record Updated Successfully');
             document.location="WBTC_MasterTimeTable.php?id=<?php echo $route ;?>";
       </script>
<?php
//header("Location:MIS_DailyEntryTrafficDisp.php");	

					

								?>
								