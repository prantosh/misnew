       <?php
        session_start();
        if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
 	echo ("Access Denied");
 	exit();
        }
        error_reporting(E_ERROR|E_WARNING);
	include('Connections/cstccon.php');
        
        
       $unit=$_SESSION['UNIT'];
$op_date=htmlspecialchars($_POST['indent_ref_date'],ENT_QUOTES);

$qty =htmlspecialchars($_POST['qty'],ENT_QUOTES);
$veh =htmlspecialchars($_POST['veh'],ENT_QUOTES);        
        
        
$op_date = substr($op_date,6,4) . '-' . substr($op_date,3,2) . '-' . substr($op_date,0,2);


    $query =  "select depot from cstcmis.veh0214 where vehno = '" . $veh. "'";
$result = mysqli_query($cstccon,$query) or die(mysqli_error());
$row_itm=mysqli_fetch_array($result);
$depot =  $row_itm['depot'];
   
    
    $sql_itm2="insert into cstcmis.veh_hsd_other_depot(vehno,depot,issue_date,issued_from,qty,op_code,upd_date,ip)"
            . " values('" . $veh . "','" . $depot . "','" . $op_date . "','" . $_SESSION['UNIT'] . "'," . $qty . ",'" . $_SESSION['USER_ID'] . "',DATE_FORMAT(DATE_ADD(NOW(), INTERVAL '12:30' HOUR_MINUTE),'%Y-%m-%d-%T'),'" . $_SESSION['IP'] . "')";
            
    $result_itm2=mysqli_query($cstccon,$sql_itm2);?>
        <script language="javascript">
            alert("Record Added Successfully");
             document.location='WBTC_DailyHSDOtherUnit.php';
       </script>
					
								