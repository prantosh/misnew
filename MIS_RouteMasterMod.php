<?php 
session_start();
error_reporting(E_ERROR|E_WARNING);
if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
 	echo ("Access Denied");
 	exit();
 }
include('Connections/cstccon.php'); 

include ('header.php'); 
$route=$_GET['id'];
//echo $route;

//$_SESSION['route'] = $route;

//now validating the PF A/C NO

$unit = $_SESSION['UNIT'];
$user_id = $_SESSION['USER_ID'];



$query_Recordset3 = "SELECT * FROM route_master where RT_NO = '" . $route. "'";
$Recordset3 = mysqli_query($cstccon,$query_Recordset3) or die(mysqli_error());
$row_Recordset3 = mysqli_fetch_assoc($Recordset3);




$query_Recordset1 = "SELECT * FROM stop_master ORDER BY STOP_DESC";
$Recordset1 = mysqli_query($cstccon,$query_Recordset1) or die(mysqli_error());
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);


$query_Recordset4 = "SELECT * FROM stop_master ORDER BY STOP_DESC";
$Recordset4 = mysqli_query($cstccon,$query_Recordset4) or die(mysqli_error());
$row_Recordset4 = mysqli_fetch_assoc($Recordset4);


$query_Recordset2 = "SELECT * FROM unit ORDER BY UNIT_DESC";
$Recordset2 = mysqli_query($cstccon,$query_Recordset2) or die(mysqli_error());
$row_Recordset2 = mysqli_fetch_assoc($Recordset2);

?>

							
<?php
if (isset($_POST['update'])) {
//$route=$_REQUEST['id'];
//$route=$_POST['route'];
echo $route;
$from_st=$_POST['from_st'];
$to_st=$_POST['to_st'];
$via1=$_POST['select3'];
$via2=$_POST['select4'];
$via3=$_POST['select5'];
$via4=$_POST['select6'];
$via5=$_POST['select7'];
$via6=$_POST['select8'];
$via7=$_POST['select9'];
$via8=$_POST['select10'];
$via9=$_POST['select11'];
$via10=$_POST['select12'];
$via11=$_POST['select13'];
$via12=$_POST['select14'];



$length=$_POST['length'];

$depot1=$_POST['depot1'];
$depot2=$_POST['depot2'];
$depot3=$_POST['depot3'];
$depot4=$_POST['depot4'];


     $sql_itm1="update route_master set FROM_ST = " . $from_st . ",TO_ST = " . $to_st . ",VIA1 = " . $via1 . ",VIA2 = " . $via2 . ",VIA3 = " . $via3 . ",VIA4 = " . $via4 . ",VIA5 = " . $via5 . ",VIA6 = " . $via6 . ",VIA7 = " . $via7 . ",VIA8 = " . $via8 . ",VIA9 = " . $via9 . ",VIA10 = " . $via10 . ",VIA11 = " . $via11 . ",VIA12 = " . $via12 . ",LENGTH = " . $length . ",DEPOT1 = '" . $depot1 . "',DEPOT2 = '" . $depot2 . "',DEPOT3 = '" .$depot3 . "',DEPOT4 = '" . $depot4 . "' where RT_NO = '" . $route . "'";  
$result_itm1=mysqli_query($cstccon,$sql_itm1);

$sql_itm="update stop_master set via = 'Y' where STOP_CODE = " . $from_st . " or STOP_CODE = " . $to_st . " or STOP_CODE = " . $via1 . " or STOP_CODE = " . $via2 . " or STOP_CODE = " . $via3 . " or STOP_CODE = " . $via4 . " or STOP_CODE = " . $via5 . " or STOP_CODE = " . $via6 . " or STOP_CODE = " . $via7 . " or STOP_CODE = " . $via8 . " or STOP_CODE = " . $via9 . " or STOP_CODE = " . $via10 . " or STOP_CODE = " . $via11 . " or STOP_CODE = " . $via12 ; 
$result_itm=mysqli_query($cstccon,$sql_itm);

 $sql_itm11="insert into deb (TET,amt) values('" . $route . "'," . $via1 . ")";  
$result_itm11=mysqli_query($cstccon,$sql_itm11);
?>
    <script language="javascript">
            alert('Record Updated Successfully');
             document.location='WBTC_RouteMaster.php';
       </script>
<?php
//header("Location:MIS_DailyEntryTrafficDisp.php");	

					
}
								?>
								</center>
								</center>

								</div>
								</div>
								</div>
								
								</div>
								</div>
								</div>
								
								
      </td>
      </tr>
    </table>
    <?php include "MIS_footer.php" ; ?> 
</body>
</html>
								