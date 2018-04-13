<?php 
session_start();

if(isset($_POST['vehno'])){
//Connect to database from here
require_once('Connections/cstccon.php');


$CUR_FIN_YR = $_SESSION['CUR_FIN_YR'];
$user_id = $_SESSION['USER_ID'];
$unit = $_SESSION['UNIT'];

$veh_no=htmlspecialchars($_POST['vehno'],ENT_QUOTES);
$qty=htmlspecialchars($_POST['qty'],ENT_QUOTES);
$rmk=htmlspecialchars($_POST['rmk'],ENT_QUOTES);
$issue_date=htmlspecialchars($_POST['issue_date6'],ENT_QUOTES);
//$issue_date3 = substr($issue_date,6,4) . '-' . substr($issue_date,3,2) . '-' . substr($issue_date,0,2);
$issue_date3 = $issue_date ;

$sql1="insert into hsd_issue_to_other_vehicle(DEPOT,VEHNO,DOI,QTY,UPDUSR,TRAN_TYPE) VALUES('" . $unit . "','" . $veh_no . "','" . $issue_date3 . "'," . $qty . ",'" . $user_id . "','I')";
$result1=mysqli_query($cstccon,$sql1);

$sql2="update bincrd_depot set ISS_QTY = ISS_QTY + " . $qty . " where FIN_YR = '" . $CUR_FIN_YR . "' AND DEPOT = '" . $unit . "' AND PART_NO = 'HSD'";
$result2=mysqli_query($cstccon,$sql2);

$query = "SELECT * FROM bincrd_depot where FIN_YR = '" . $CUR_FIN_YR . "' AND DEPOT = '" . $unit . "' AND PART_NO = 'HSD'";
$Recordset = mysqli_query($cstccon,$query) or die(mysqli_error());
$row = mysqli_fetch_assoc($Recordset);
$hsd_stock = $row['OPNG_QTY'] + $row['RCT_QTY'] - $row['ISS_QTY'];

$sql21="update unit set hsd_stock = " . $hsd_stock . " where UNIT = '" . $unit . "'";
$result21=mysqli_query($cstccon,$sql21);
}
?>
        <script type="text/javascript">;
        alert('Record updated successfully');
        document.location="CSTC_MainMenu.php";

        </script>;


