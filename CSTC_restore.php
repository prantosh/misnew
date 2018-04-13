<?php
session_start();
require_once('Connections/cstccon.php');

$cur_fin_yr = $_SESSION['CUR_FIN_YR'];
if($_SESSION['UNAME'] != 'cosp'){
    echo "SORRY. YOU ARE NOT ALLOWED TO PERFORM THIS OPERATION";
    exit();
}

$sql=       "delete from bill where substr(BIL_ID,2,2) = '" . $cur_fin_yr . "'";
$result=    mysql_query($sql);

$sql1=       "insert into bill select * from bill_backup";
$result1=    mysql_query($sql1);

$sql=       "delete from billitm where substr(BIL_ID,2,2) = '" . $cur_fin_yr . "'";
$result=    mysql_query($sql);

$sql1=       "insert into billitm select * from billitm_backup";
$result1=    mysql_query($sql1);

$sql=       "delete from bincrd where FIN_YR = '" . $cur_fin_yr . "'";
$result=    mysql_query($sql);

$sql1=       "insert into bincrd select * from bincrd_backup";
$result1=    mysql_query($sql1);

$sql=       "delete from bintxn where substr(BNTXN_ID,2,2) = '" . $cur_fin_yr . "'";
$result=    mysql_query($sql);

$sql1=       "insert into bintxn select * from bintxn_backup";
$result1=    mysql_query($sql1);

$sql=       "delete from bintxnitm where substr(BNTXN_ID,2,2) = '" . $cur_fin_yr . "'";
$result=    mysql_query($sql);

$sql1=       "insert into bintxnitm select * from bintxnitm_backup";
$result1=    mysql_query($sql1);


$sql=       "delete from cstcmis.cstc_user";
$result=    mysql_query($sql);

$sql1=       "insert into cstcmis.cstc_user select * from cstcmis.cstc_user_backup";
$result1=    mysql_query($sql1);


$sql=       "delete from ctrl";
$result=    mysql_query($sql);

$sql1=       "insert into ctrl select * from ctrl_backup";
$result1=    mysql_query($sql1);

$sql=       "delete from current_part_no";
$result=    mysql_query($sql);

$sql1=       "insert into current_part_no select * from current_part_no_backup";
$result1=    mysql_query($sql1);

$sql=       "delete from indnt where substr(INDNT_ID,2,2) = '" . $cur_fin_yr . "'";
$result=    mysql_query($sql);

$sql1=       "insert into indnt select * from indnt_backup";
$result1=    mysql_query($sql1);

$sql=       "delete from indntitm where substr(INDNT_ID,2,2) = '" . $cur_fin_yr . "'";
$result=    mysql_query($sql);

$sql1=       "insert into indntitm select * from indntitm_backup";
$result1=    mysql_query($sql1);

$sql=       "delete from itm";
$result=    mysql_query($sql);

$sql1=       "insert into itm select * from itm_backup";
$result1=    mysql_query($sql1);

$sql=       "delete from matrct where substr(MAT_RCT_NO,2,2) = '" . $cur_fin_yr . "'";
$result=    mysql_query($sql);

$sql1=       "insert into matrct select * from matrct_backup";
$result1=    mysql_query($sql1);

$sql=       "delete from matrctitm where substr(MAT_RCT_NO,2,2) = '" . $cur_fin_yr . "'";
$result=    mysql_query($sql);

$sql1=       "insert into matrctitm select * from matrctitm_backup";
$result1=    mysql_query($sql1);



$sql=       "delete from po";
$result=    mysql_query($sql);

$sql1=       "insert into po select * from po_backup";
$result1=    mysql_query($sql1);

$sql=       "delete from poitm";
$result=    mysql_query($sql);

$sql1=       "insert into poitm select * from poitm_backup";
$result1=    mysql_query($sql1);

$sql=       "delete from purreq where substr(PUR_REQ_ID,2,2) = '" . $cur_fin_yr . "'";
$result=    mysql_query($sql);

$sql1=       "insert into purreq select * from purreq_backup";
$result1=    mysql_query($sql1);

$sql=       "delete from purreqitm where substr(PUR_REQ_ID,2,2) = '" . $cur_fin_yr . "'";
$result=    mysql_query($sql);

$sql1=       "insert into purreqitm select * from purreqitm_backup";
$result1=    mysql_query($sql1);

$sql=       "delete from posch";
$result=    mysql_query($sql);

$sql1=       "insert into posch select * from posch_backup";
$result1=    mysql_query($sql1);

$sql=       "delete from vnd";
$result=    mysql_query($sql);

$sql1=       "insert into vnd select * from vnd_backup";
$result1=    mysql_query($sql1);

$sql=       "delete from item_issue_admin";
$result=    mysql_query($sql);

$sql1=       "insert into item_issue_admin select * from item_issue_admin_backup";
$result1=    mysql_query($sql1);

$sql=       "delete from bincrd_trigger";
$result=    mysql_query($sql);

$sql1=       "insert into bincrd_trigger select * from bincrd_trigger_backup";
$result1=    mysql_query($sql1);


 
?>
 <script language="javascript">
            alert('RESTORATION COMPLETED SUCCESSFULLY');
             document.location='CSTC_MainMenu.php';
       </script>