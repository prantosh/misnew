<?php
session_start();
require_once('Connections/cstccon.php');

$cur_fin_yr = $_SESSION['CUR_FIN_YR'];

$sql1=       "drop table bill_backup";
$result1=    mysqli_query($cstccon,$sql1);

$sql=       "create table bill_backup select * from bill where substr(BIL_ID,2,2) = '" . $cur_fin_yr . "'";
$result=    mysqli_query($cstccon,$sql);

$sql1=       "drop table billitm_backup";
$result1=    mysqli_query($cstccon,$sql1);

$sql=       "create table billitm_backup select * from billitm where substr(BIL_ID,2,2) = '" . $cur_fin_yr . "'";
$result=    mysqli_query($cstccon,$sql);

$sql1=       "drop table bincrd_backup";
$result1=    mysqli_query($cstccon,$sql1);

$sql=       "create table bincrd_backup select * from bincrd where FIN_YR = '" . $cur_fin_yr . "'";
$result=    mysqli_query($cstccon,$sql);

$sql1=       "drop table bintxn_backup";
$result1=    mysqli_query($cstccon,$sql1);

$sql=       "create table bintxn_backup select * from bintxn where substr(BNTXN_ID,2,2) = '" . $cur_fin_yr . "'";
$result=    mysqli_query($cstccon,$sql);

$sql1=       "drop table bintxnitm_backup";
$result1=    mysqli_query($cstccon,$sql1);

$sql=       "create table bintxnitm_backup select * from bintxnitm where substr(BNTXN_ID,2,2) = '" . $cur_fin_yr . "'";
$result=    mysqli_query($cstccon,$sql);

$sql1=       "drop table cstcmis.cstc_user_backup";
$result1=    mysqli_query($cstccon,$sql1);

$sql=       "create table cstcmis.cstc_user_backup select * from cstcmis.cstc_user";
$result=    mysqli_query($cstccon,$sql);

$sql1=       "drop table ctrl_backup";
$result1=    mysqli_query($cstccon,$sql1);

$sql=       "create table ctrl_backup select * from ctrl";
$result=    mysqli_query($cstccon,$sql);

$sql1=       "drop table current_part_no_backup";
$result1=    mysqli_query($cstccon,$sql1);

$sql=       "create table current_part_no_backup select * from current_part_no";
$result=    mysqli_query($cstccon,$sql);

$sql1=       "drop table indnt_backup";
$result1=    mysqli_query($cstccon,$sql1);

$sql=       "create table indnt_backup select * from indnt where substr(INDNT_ID,2,2) = '" . $cur_fin_yr . "'";
$result=    mysqli_query($cstccon,$sql);

$sql1=       "drop table indntitm_backup";
$result1=    mysqli_query($cstccon,$sql1);

$sql=       "create table indntitm_backup select * from indntitm where substr(INDNT_ID,2,2) = '" . $cur_fin_yr . "'";
$result=    mysqli_query($cstccon,$sql);

$sql1=       "drop table itm_backup";
$result1=    mysqli_query($cstccon,$sql1);

$sql=       "create table itm_backup select * from itm";
$result=    mysqli_query($cstccon,$sql);

$sql1=       "drop table matrct_backup";
$result1=    mysqli_query($cstccon,$sql1);

$sql=       "create table matrct_backup select * from matrct where substr(MAT_RCT_NO,2,2) = '" . $cur_fin_yr . "'";
$result=    mysqli_query($cstccon,$sql);

$sql1=       "drop table matrctitm_backup";
$result1=    mysqli_query($cstccon,$sql1);

$sql=       "create table matrctitm_backup select * from matrctitm where substr(MAT_RCT_NO,2,2) = '" . $cur_fin_yr . "'";
$result=    mysqli_query($cstccon,$sql);



$sql1=       "drop table po_backup";
$result1=    mysqli_query($cstccon,$sql1);

$sql=       "create table po_backup select * from po";
$result=    mysqli_query($cstccon,$sql);

$sql1=       "drop table poitm_backup";
$result1=    mysqli_query($cstccon,$sql1);

$sql=       "create table poitm_backup select * from poitm";
$result=    mysqli_query($cstccon,$sql);

$sql1=       "drop table purreq_backup";
$result1=    mysqli_query($cstccon,$sql1);

$sql=       "create table purreq_backup select * from purreq where substr(PUR_REQ_ID,2,2) = '" . $cur_fin_yr . "'";
$result=    mysqli_query($cstccon,$sql);

$sql1=       "drop table purreqitm_backup";
$result1=    mysqli_query($cstccon,$sql1);

$sql=       "create table purreqitm_backup select * from purreqitm where substr(PUR_REQ_ID,2,2) = '" . $cur_fin_yr . "'";
$result=    mysqli_query($cstccon,$sql);

$sql1=       "drop table posch_backup";
$result1=    mysqli_query($cstccon,$sql1);

$sql=       "create table posch_backup select * from posch";
$result=    mysqli_query($cstccon,$sql);

$sql1=       "drop table vnd_backup";
$result1=    mysqli_query($cstccon,$sql1);

$sql=       "create table vnd_backup select * from vnd";
$result=    mysqli_query($cstccon,$sql);

$sql=       "INSERT INTO last_backup(LAST_DONE,USERID) VALUES(DATE_FORMAT(DATE_ADD(NOW(), INTERVAL '12:30' HOUR_MINUTE),'%Y-%m-%d-%T'),'" . $_SESSION['USER_ID'] . "')";
$result=    mysqli_query($cstccon,$sql);

$sql1=       "drop table item_issue_admin_backup";
$result1=    mysqli_query($cstccon,$sql1);

$sql=       "create table item_issue_admin_backup select * from item_issue_admin";
$result=    mysqli_query($cstccon,$sql);

$sql1=       "drop table bincrd_trigger_backup";
$result1=    mysqli_query($cstccon,$sql1);

$sql=       "create table bincrd_trigger_backup select * from bincrd_trigger";
$result=    mysqli_query($cstccon,$sql);

 
?>
 <script language="javascript">
            alert('BACKUP COMPLETED SUCCESSFULLY');
             document.location='CSTC_MainMenu.php';
       </script>