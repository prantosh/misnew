       <?php
        session_start();
        if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
 	echo ("Access Denied");
 	exit();
        }
        error_reporting(E_ERROR|E_WARNING);
	include('Connections/cstccon.php');
        
        $id = htmlspecialchars($_POST['id'],ENT_QUOTES);
        $model = htmlspecialchars($_POST['model'],ENT_QUOTES);
        //$op_date=htmlspecialchars($_POST['indent_ref_date'],ENT_QUOTES);
	$veh_out_1st=htmlspecialchars($_POST['veh_out_1st'],ENT_QUOTES);
	$veh_out_2nd=htmlspecialchars($_POST['veh_out_2nd'],ENT_QUOTES);
	$sch_trip=htmlspecialchars($_POST['sch_trip'],ENT_QUOTES);
	$act_trip=htmlspecialchars($_POST['act_trip'],ENT_QUOTES);
	$sale_1st=htmlspecialchars($_POST['sale_1st'],ENT_QUOTES);
        $km=htmlspecialchars($_POST['km'],ENT_QUOTES);
        $km_2nd=htmlspecialchars($_POST['km_2nd'],ENT_QUOTES);
        $hsd=htmlspecialchars($_POST['hsd'],ENT_QUOTES);
        $sale_2nd=htmlspecialchars($_POST['sale_2nd'],ENT_QUOTES);
        $unit = $_SESSION['UNIT'];
        $op_date1 = substr($op_date,6,4) . '-' . substr($op_date,3,2) . '-' . substr($op_date,0,2);
	
        $sql_itm5="SELECT * FROM cstcmis.model_master WHERE model ='" . $model . "'";
        $result_itm5=mysqli_query($cstccon,$sql_itm5);
        $row_itm5=mysqli_fetch_array($result_itm5);
        $type = $row_itm5['TYPE'];
        $user_id = $_SESSION['USER_ID'];             

        
        
        // $sql_itm="delete from cstcmis.daily_record_model where unit ='" . $unit . "' and model = '" . $model . "' and op_date = '" . $op_date1 . "'";
       // $result_itm=mysqli_query($cstccon,$sql_itm);

    //echo $op_date ;    
        
        $sql = "update cstcmis.daily_record_model set model = '" . $model . "',veh_out_1st = " . $veh_out_1st . ",veh_out_2nd = " . $veh_out_2nd . ",sch_trip = " . $sch_trip . ",act_trip = " . $act_trip . ",km = " . $km . ",km_2nd = " . $km_2nd . ",hsd = " . $hsd . ",sale_1st = " . $sale_1st . ",sale_2nd = " . $sale_2nd . ",op_code = '" . $user_id . "'  where id = " . $id;
	$result=mysqli_query($cstccon,$sql);?>
        <script language="javascript">
            alert("<?php echo $op_date ; ?>Updation Done Successfully");
             document.location='WBTC_DailyEntryTrafficDisp1.php';
       </script>
					
								