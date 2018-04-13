       <?php
        session_start();
        if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
 	echo ("Access Denied");
 	exit();
        }
        error_reporting(E_ERROR|E_WARNING);
	include('Connections/cstccon.php');
        
        $id = htmlspecialchars($_POST['id'],ENT_QUOTES);
       $id=$_REQUEST['id'];




$veh_supply_old = $_POST['veh_supply_old'];
$veh_supply_1623 = $_POST['veh_supply_1623'];
$veh_supply_al_nac = $_POST['veh_supply_al_nac'];
$veh_supply_al_ac = $_POST['veh_supply_al_ac'];
$veh_supply_volvo = $_POST['veh_supply_volvo'];
$veh_out_old = $_POST['veh_out_old'];
$veh_out_1623 = $_POST['veh_out_1623'];
$veh_out_al_nac = $_POST['veh_out_al_nac'];
$veh_out_al_ac = $_POST['veh_out_al_ac'];
$veh_out_volvo = $_POST['veh_out_volvo'];



mysqli_query($cstccon,"UPDATE cstcmis.daily_record_sum SET "
        . "veh_supply_old = '$veh_supply_old' , "
        . "veh_supply_1623 = '$veh_supply_1623' ,"
        . "veh_supply_al_nac = '$veh_supply_al_nac',"
        . "veh_supply_al_ac = '$veh_supply_al_ac',"
        . "veh_supply_volvo = '$veh_supply_volvo',"
        . "veh_out_old = '$veh_out_old' ,"
        . "veh_out_1623 = '$veh_out_1623',"
        . "veh_out_al_nac = '$veh_out_al_nac',"
        
         . "veh_out_al_ac = '$veh_out_al_ac' , "
        . "veh_out_volvo = '$veh_out_volvo' ,"
        
        
        . "op_code = '$user_id',"
        . "upd_date = now() "
        . "WHERE id = '$id' ") or die(mysqli_error()); 	
?> 
    <script language="javascript">
            alert('Reacord Updated Successfully');
             document.location='WBTC_DailyEntrySummaryVeh1.php';
       </script>	
    