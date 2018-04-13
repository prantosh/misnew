       <?php
        session_start();
        if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
 	echo ("Access Denied");
 	exit();
        }
        error_reporting(E_ERROR|E_WARNING);
	include('Connections/cstccon.php');
        
        $id = htmlspecialchars($_POST['id_new1'],ENT_QUOTES);
        $vehno  = htmlspecialchars($_POST['veh'],ENT_QUOTES);
        $qty  = htmlspecialchars($_POST['qty'],ENT_QUOTES);
        
        $user_id = $_SESSION['USER_ID'];             

        
        
        // $sql_itm="delete from cstcmis.daily_record_model where unit ='" . $unit . "' and model = '" . $model . "' and op_date = '" . $op_date1 . "'";
       // $result_itm=mysqli_query($cstccon,$sql_itm);

    //echo $op_date ;    
        
        $sql = "update cstcmis.veh_hsd_other_depot set vehno = '" . $vehno . "',qty = " . $qty . ",op_code = '" . $user_id . "'  where id = " . $id;
	$result=mysqli_query($cstccon,$sql);?>
        <script language="javascript">
            alert("<?php echo $id . $vehno . $qty; ?>Updation Done Successfully");
             document.location='WBTC_DailyHSDOtherUnit.php';
       </script>
					
								