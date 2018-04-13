<?php
session_start();
$unit = $_SESSION['UNIT'];
if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
 	echo ("Access Denied");
 	exit();
 }
$target_dir = '../mis/' . $_SESSION['UNIT'] . "/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image

$op_date_insert1 =  $_POST["indent_ref_date"]      ;
$op_date_insert = substr($op_date_insert1,6,4) . '-' . substr($op_date_insert1,3,2) . '-' . substr($op_date_insert1,0,2) ;

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
  
// upload complete
 
 require_once('Connections/cstccon.php');       
        
if($_SESSION['UNIT'] == 'KD'){$source = fopen( '../mis/KD/veh.csv', 'r') or die("Problem open file");}
 if($_SESSION['UNIT'] == 'ND'){$source = fopen( '../mis/ND/veh.csv', 'r') or die("Problem open file");}
 if($_SESSION['UNIT'] == 'BD'){$source = fopen( '../mis/BD/veh.csv', 'r') or die("Problem open file");}
 if($_SESSION['UNIT'] == 'PD'){$source = fopen( '../mis/PD/veh.csv', 'r') or die("Problem open file");}
 if($_SESSION['UNIT'] == 'MD'){$source = fopen( '../mis/MD/veh.csv', 'r') or die("Problem open file");}
 if($_SESSION['UNIT'] == 'SLD'){$source = fopen( '../mis/SLD/veh.csv', 'r') or die("Problem open file");}
 if($_SESSION['UNIT'] == 'GD'){$source = fopen( '../mis/GD/veh.csv', 'r') or die("Problem open file");}
 if($_SESSION['UNIT'] == 'LD'){$source = fopen( '../mis/LD/veh.csv', 'r') or die("Problem open file");}
 if($_SESSION['UNIT'] == 'TD'){$source = fopen( '../mis/TD/veh.csv', 'r') or die("Problem open file");}
 if($_SESSION['UNIT'] == 'TPD'){$source = fopen( '../mis/TPD/veh.csv', 'r') or die("Problem open file");}
 if($_SESSION['UNIT'] == 'HD'){$source = fopen( '../mis/HD/veh.csv', 'r') or die("Problem open file");}
    while (($data = fgetcsv($source, 1000, ",")) !== FALSE)
    {
        $vehno = $data[0];
        $prog_km = $data[5];
        $prvmth_km = $data[7];
        $prvmth_hsd = $data[8];
        $mth_r_km = $data[11];
        $mth_hsd = $data[12];



if($mth_hsd > 0)   {$veh_cur_kmpl = number_format(($mth_r_km / $mth_hsd),2) ;}
else{$veh_cur_kmpl = 2.00;}
if($mth_r_km < 10){$veh_cur_kmpl = 2.00;}
if($veh_cur_kmpl > 5){$veh_cur_kmpl = 5.00;}

//$insertTable= mysql_query("update veh0214 set tot_km = " .  $prog_km . " where vehno = '" . $vehno . "'");

$sql_itm="update cstcmis.veh0214 set veh_cur_kmpl = " . $veh_cur_kmpl . ",tot_km = " .  $prog_km . ", mth_r_km = " . $mth_r_km . ",mth_hsd = " . $mth_hsd . " where vehno = '" . $vehno . "'";
$result_itm=mysqli_query($cstccon,$sql_itm);    


$sql2 = "select * from cstcmis.ctrl_mis_veh";
$result2=mysqli_query($cstccon,$sql2);
$row2 = mysqli_fetch_assoc($result2);
$prev_mth = $row2['prev_mth'];


$sql = "delete from cstcmis.veh_mth_data where month = '" . $prev_mth . "' and veh_no = '" . $vehno . "'";
$result=mysqli_query($cstccon,$sql);

$sql_veh="insert into cstcmis.veh_mth_data(month,veh_no,depot,hsd,km) values('" . $prev_mth . "','" . $vehno . "','" . $unit . "'," . $prvmth_hsd . "," . $prvmth_km . ")";
$result_veh=mysqli_query($cstccon,$sql_veh);     


     



    }
    fclose($source);
 $sql21 = "insert into cstcmis.veh_update_log(unit,upd_by) values('" . $_SESSION['UNIT'] . "'," . $_SESSION['USER_ID'] . ")";
$result21=mysqli_query($cstccon,$sql21);    

$sql21111 = "update cstcmis.veh_last_upload_date set last_upload_date = '" . $op_date_insert . "' where unit = '" . $_SESSION['UNIT'] .  "'";
$result21111=mysqli_query($cstccon,$sql21111); 
//} else {
//$msg = 'Record already exist. <div style="Padding:20px 0 0 0;"><a href="http://www.discussdesk.com/import-excel-file-data-in-mysql-database-using-PHP.htm" target="_blank">Go Back to tutorial</a></div>';
//}
}?>
<script language='javascript'>
 alert(" Vehicle file has been updated successfully ")
 

 </script>
<html><script> document.location.href='WBTC_MainMenu.php';</script></html> 


// Check if file already exists

// Check if $uploadOk is set to 0 by an error

?> 