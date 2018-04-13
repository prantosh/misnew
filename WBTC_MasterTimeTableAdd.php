<?php 
session_start();
error_reporting(E_ERROR|E_WARNING);
if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
 	echo ("Access Denied");
 	exit();
 }
include('Connections/cstccon.php'); 


if (isset($_POST['rt_no'])) {
//$route=$_REQUEST['id'];
//$route=$_POST['route'];
$route=htmlspecialchars($_POST['rt_no'],ENT_QUOTES);
$unit=htmlspecialchars($_POST['depot'],ENT_QUOTES);
$terminus=htmlspecialchars($_POST['terminus'],ENT_QUOTES);
$shift=htmlspecialchars($_POST['shift'],ENT_QUOTES);
$trip=htmlspecialchars($_POST['trip'],ENT_QUOTES);
$car_no_depot=htmlspecialchars($_POST['car_no_depot'],ENT_QUOTES);
$car_no_terminus=htmlspecialchars($_POST['car_no_terminus'],ENT_QUOTES);
$hour=htmlspecialchars($_POST['hour'],ENT_QUOTES);
$minute1=htmlspecialchars($_POST['minute1'],ENT_QUOTES);

$dept_time = $hour . ":" . $minute1;


$query_Recordset2 = "SELECT * FROM cstcmis.time_table where route = '" . $route . "' and stop_code = " . $terminus .  " and shift = '" . $shift . "' and car_no_terminus = " . $car_no_terminus ;
$Recordset2 = mysqli_query($cstccon,$query_Recordset2) or die(mysqli_error());

if(mysqli_num_rows($Recordset2) <= 0){
    $sql_itm1="insert into cstcmis.time_table (route,unit,stop_code,shift,car_no_depot,trip,car_no_terminus,dept_time,op_code) values('" . $route . "','" . $unit. "'," . $terminus . ",'" .  $shift . "'," . $car_no_depot . "," . $trip . "," . $car_no_terminus . ",'" . $dept_time . "'," . $_SESSION['USER_ID'] . ")" ;  
    $result_itm1=mysqli_query($cstccon,$sql_itm1);
}
?>
    <script language="javascript">
            alert('Record Updated Successfully');
             document.location="WBTC_MasterTimeTable.php?id=<?php echo $route ;?>";
       </script>
<?php
//header("Location:MIS_DailyEntryTrafficDisp.php");	

					
}
								?>
        <script language="javascript">
            alert('Record Updated Successfully');
             document.location="WBTC_MasterTimeTable.php?id=<?php echo $route ;?>";
       </script>
								
    <?php include "WBTC_footer.php" ; ?> 
</body>
</html>
								