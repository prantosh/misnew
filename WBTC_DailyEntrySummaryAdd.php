

       <?php
session_start();
if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
 	echo ("Access Denied");
 	exit();
 }
error_reporting(E_ERROR|E_WARNING);
	include('Connections/cstccon.php');
        
        
        $op_date=htmlspecialchars($_POST['datepicker_from'],ENT_QUOTES);
	$att_driver_1st=htmlspecialchars($_POST['att_driver_1st'],ENT_QUOTES);
        $att_driver_tr_1st=htmlspecialchars($_POST['att_driver_tr_1st'],ENT_QUOTES);
        $att_cond_1st=htmlspecialchars($_POST['att_cond_1st'],ENT_QUOTES);
        $att_cond_tr_1st=htmlspecialchars($_POST['att_cond_tr_1st'],ENT_QUOTES);
        //$att_driver_2nd=htmlspecialchars($_POST['att_driver_2nd'],ENT_QUOTES);
       // $att_driver_tr_2nd=htmlspecialchars($_POST['att_driver_tr_2nd'],ENT_QUOTES);
       // $att_cond_2nd=htmlspecialchars($_POST['att_cond_2nd'],ENT_QUOTES);
       // $att_cond_tr_2nd=htmlspecialchars($_POST['att_cond_tr_2nd'],ENT_QUOTES);
	
        $ab_driver_1st=htmlspecialchars($_POST['ab_driver_1st'],ENT_QUOTES);
        $ab_driver_tr_1st=htmlspecialchars($_POST['ab_driver_tr_1st'],ENT_QUOTES);
        $ab_cond_1st=htmlspecialchars($_POST['ab_cond_1st'],ENT_QUOTES);
        $ab_cond_tr_1st=htmlspecialchars($_POST['ab_cond_tr_1st'],ENT_QUOTES);
        //$ab_driver_2nd=htmlspecialchars($_POST['ab_driver_2nd'],ENT_QUOTES);
        //$ab_driver_tr_2nd=htmlspecialchars($_POST['ab_driver_tr_2nd'],ENT_QUOTES);
       // $ab_cond_2nd=htmlspecialchars($_POST['ab_cond_2nd'],ENT_QUOTES);
       // $ab_cond_tr_2nd=htmlspecialchars($_POST['ab_cond_tr_2nd'],ENT_QUOTES);
        
        $user_id = $_SESSION['USER_ID'];    
        
        $unit = $_SESSION['UNIT'];
        $op_date1 = substr($op_date,7,4) . '-' . substr($op_date,4,2) . '-' . substr($op_date,1,2);
	//echo $op_date1;
        
        //$sql_itm="insert into daily_record_model(op_date,unit,model,ac,veh_out_1st,veh_out_2nd,sch_trip,act_trip,km,km_2nd,hsd,sale_1st,sale_2nd,op_code,ip) values('" . $op_date1 . "','" . $unit . "','" . $model . "','" . $type . "'," . $veh_out_1st . "," . $veh_out_2nd . "," . $sch_trip . "," . $act_trip . "," . $km . "," . $km_2nd . "," . $hsd . "," . $sale_1st . "," . $sale_2nd . ",'" . $user_id . "','" . $_SESSION['IP'] . "')";
        //$result_itm=mysqli_query($cstccon,$sql_itm);
        //$sql_itm="delete from daily_record_sum where unit ='" . $unit . "' and op_date = '" . $op_date1 . "'";
        //$result_itm=mysqli_query($cstccon,$sql_itm);
        
        $sql_itm="delete from cstcmis.daily_record_sum where unit ='" . $unit . "' and op_date = '" . $op_date1 . "'";
        $result_itm=mysqli_query($cstccon,$sql_itm);
    //   echo $op_date1 . '*' . $unit . '*' . $att_driver_1st . '*'. $att_driver_tr_1st . '*' . $att_cond_1st . '*' . $att_tr_cond_1st . '*' . $ab_driver_1st . '*'. $ab_driver_tr_1st . '*' . $ab_cond_1st . '*' . $ab_cond_tr_1st ;   
        
        $sql = "insert into cstcmis.daily_record_sum (op_date,unit,att_driver_1st,att_driver_tr_1st,att_cond_1st,att_cond_tr_1st,ab_driver_1st,ab_driver_tr_1st,ab_cond_1st,ab_cond_tr_1st,op_code,ip) values('" . $op_date1 . "','" . $unit . "'," . $att_driver_1st . "," . $att_driver_tr_1st . "," . $att_cond_1st . "," . $att_cond_tr_1st . "," . $ab_driver_1st . "," . $ab_driver_tr_1st . "," . $ab_cond_1st . "," . $ab_cond_tr_1st . ",'" .  $user_id . "','" . $_SESSION['IP'] . "')";
        $result=mysqli_query($cstccon,$sql);?>
        <script language="javascript">
            alert('Record Added Successfuly');
             document.location='WBTC_DailyEntrySummary1.php';
       </script>
					
								