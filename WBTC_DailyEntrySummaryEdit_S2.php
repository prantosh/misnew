

       <?php
session_start();
if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
 	echo ("Access Denied");
 	exit();
 }
error_reporting(E_ERROR|E_WARNING);
	include('Connections/cstccon.php');
    $id = htmlspecialchars($_POST['id'],ENT_QUOTES);    
        
        $op_date=htmlspecialchars($_POST['indent_ref_date'],ENT_QUOTES);
	$att_driver_2nd=htmlspecialchars($_POST['att_driver_2nd'],ENT_QUOTES);
        $att_driver_tr_2nd=htmlspecialchars($_POST['att_driver_tr_2nd'],ENT_QUOTES);
        $att_cond_2nd=htmlspecialchars($_POST['att_cond_2nd'],ENT_QUOTES);
        $att_cond_tr_2nd=htmlspecialchars($_POST['att_cond_tr_2nd'],ENT_QUOTES);
    
        $ab_driver_2nd=htmlspecialchars($_POST['ab_driver_2nd'],ENT_QUOTES);
        $ab_driver_tr_2nd=htmlspecialchars($_POST['ab_driver_tr_2nd'],ENT_QUOTES);
        $ab_cond_2nd=htmlspecialchars($_POST['ab_cond_2nd'],ENT_QUOTES);
        $ab_cond_tr_2nd=htmlspecialchars($_POST['ab_cond_tr_2nd'],ENT_QUOTES);
          
        $user_id = $_SESSION['USER_ID'];    
        
        $unit = $_SESSION['UNIT'];
        $op_date1 = substr($op_date,6,4) . '-' . substr($op_date,3,2) . '-' . substr($op_date,0,2);
	 // $sql_itm="delete from cstcmis.daily_record_sum where unit ='" . $unit . "' and op_date = '" . $op_date1 . "'";      
        $sql = "update cstcmis.daily_record_sum  set att_driver_2nd = " . $att_driver_2nd . ",att_driver_tr_2nd = " . $att_driver_tr_2nd . ",att_cond_2nd = " . $att_cond_2nd . ",att_cond_tr_2nd = " . $att_cond_tr_2nd . ",ab_driver_2nd = " . $ab_driver_2nd . ",ab_driver_tr_2nd = " . $ab_driver_tr_2nd . ",ab_cond_2nd = " . $ab_cond_2nd . ",ab_cond_tr_2nd = " . $ab_cond_tr_2nd . ",op_code = '" . $user_id . "',ip = '" . $_SESSION['IP'] . "' where id = " . $id;
        $result=mysqli_query($cstccon,$sql);?>
        <script language="javascript">
            alert('Record Updated Successfuly');
             document.location='WBTC_DailyEntrySummary_S2.php';
       </script>
					
								