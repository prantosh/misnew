<?php
ob_start ();
require_once('Connections/cstccon.php');
require_once('number2word.php');
session_start();
$cur_fin_yr = $_SESSION['CUR_FIN_YR'];
$unit = $_SESSION['UNIT'];

$sql3S = "select * from item_issue_to_other_unit where UNIT_FROM = '" . $unit . "'";
$result3S=mysqli_query($cstccon,$sql3S);
if(mysqli_num_rows($result3S) > 0){
    $row3S = mysqli_fetch_array($result3S);
$doc_dt =  $row3S['DOC_DT'];
$unit_to = $row3S['UNIT_TO'];
//$vehno = $row3S['vehno'];
$user_id = $_SESSION['USER_ID'];
$remark = $_SESSION['remark'];
//require_once('Numbers/Words.php');


$sql11 = "select * from unit where UNIT = '" . $unit . "'";
$result11=mysqli_query($cstccon,$sql11);
$row11 = mysqli_fetch_array($result11);
$unit_desc = $row11['UNIT_DESC'];
$unit_code = $row11['UNIT_CODE'];

$sql12 = "select * from unit where UNIT = '" . $unit_to . "'";
$result12=mysqli_query($cstccon,$sql12);
$row12 = mysqli_fetch_array($result12);
$unit_to_desc = $row12['UNIT_DESC'];
$unit_to_code = $row12['UNIT_CODE'];

$sql1 = "select max(substring(BNTXN_ID,length(BNTXN_ID) - 3,4)) MAX_ID FROM bintxn_depot where FIN_YR = '" . $cur_fin_yr . "' and substring(BNTXN_ID,length(BNTXN_ID) - 4,1) = 'I' AND substring(BNTXN_ID,1,1) = '" . $unit_code . "'";
$result1=mysqli_query($cstccon,$sql1);
if(mysqli_num_rows($result1) > 0){
$row1 = mysqli_fetch_array($result1);
$new_number = $row1['MAX_ID'] + 1;}
else { $new_number = 1;}
if (strlen($new_number) == 3){ $new_number = '0' . $new_number ;}
if (strlen($new_number) == 2){ $new_number = '00' . $new_number ;}
if (strlen($new_number) == 1){ $new_number = '000' . $new_number ;}
if($unit != ''){
$v_no = $unit_code . $cur_fin_yr . $unit_to_code . 'I' . $new_number;

$sql4 = "insert into bintxn_depot(BNTXN_ID,PRTY_CD,FIN_YR,CLS,DOC_DT,vehno,RMK,UPDUSR,UPDDT) VALUES('" . $v_no . "','" . $unit_to .  "','$cur_fin_yr','MI','$doc_dt','" . $vehno . "','" . $remark . "','" . $_SESSION['UNAME'] . "',DATE_FORMAT(DATE_ADD(NOW(), INTERVAL '12:30' HOUR_MINUTE),'%Y-%m-%d'))";
$result4=mysqli_query($cstccon,$sql4);

$sql49 = "insert into bntxn_id_create_datetime(BNTXN_ID) VALUES('" . $v_no . "')";
$result49=mysqli_query($cstccon,$sql49);

}
//echo $new_number ;
?>
<script type="text/JavaScript">
     alert("<?php echo $cur_fin_yr ; ?>");
    
     

</script>   
<?php
$sql3 = "select * from item_issue_to_other_unit A,itm B where A.PART_NO = B.PART_NO and A.UNIT_FROM = '$unit'";
$result3=mysqli_query($cstccon,$sql3);

while($row3 = mysqli_fetch_array($result3)){
    
    
    
        $part_no 		= $row3['PART_NO'];
        $itm_nm 		= $row3['ITM_NM'];
        $uom_id 		= $row3['UOM_ID'];
        $spec                   = $row3['ITM_NM'];
        $issue_date             = $row3['DOC_DT'];
        $qty                    = -$row3['QTY'];
       // $unit_to                = $row3['UNIT_TO'];
        
         $query11 = "select ALT_NO_3 FROM current_part_no where PART_NO = '" . $part_no . "'";
            $result11 = mysqli_query($cstccon,$query11);
        $row11 = mysqli_fetch_array($result11);
        $alt_no = $row11['ALT_NO_3'];
        
        //$alt_no                 = $row3['ALT_NO'];

        
        $sql6 = "select * from bincrd where PART_NO = '" . $part_no . "' and FIN_YR = '$cur_fin_yr'";
        $result6=mysqli_query($cstccon,$sql6);
        $row6 = mysqli_fetch_array($result6);
        $iss_val = ($row6['OPNG_VAL'] + $row6['RCT_VAL'] - $row6['ISS_VAL']) * $qty /  ($row6['OPNG_QTY'] + $row6['RCT_QTY'] - $row6['ISS_QTY']) ;
        
        $iss_val_tot = $iss_val_tot + $iss_val;
     //echo $iss_val ;    
        $sql5 = "insert into bintxnitm_depot(BNTXN_ID,PART_NO,ITM_QTY,ITM_VAL,UPDUSR,UPDDT) values('" . $v_no . "','" . $part_no . "'," . abs($qty) . "," . abs($iss_val) . ",'$user_id',DATE_FORMAT(DATE_ADD(NOW(), INTERVAL '12:30' HOUR_MINUTE),'%Y-%m-%d'))";
        $result5=mysqli_query($cstccon,$sql5);
        
        $sql7 = "UPDATE bincrd_depot set ISS_QTY = ISS_QTY + " . abs($qty) . ",ISS_VAL = ISS_VAL + " . abs($iss_val) . ", LISS_DT = '" . $issue_date . "', UPDUSR = '" . $user_id . "',UPDDT = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL '12:30' HOUR_MINUTE),'%Y-%m-%d') where PART_NO = '" . $part_no . "' and FIN_YR = '" . $cur_fin_yr . "' and DEPOT = '" . $unit . "'";
        $result7=mysqli_query($cstccon,$sql7);
        
        $sql74 = "UPDATE unit set inv_value = inv_value - " . abs($iss_val) . " where UNIT = '" . $unit . "'";
        $result74=mysqli_query($cstccon,$sql74);
        
        $sql4 = "select * from bincrd_depot where PART_NO = '" . $part_no . "' and DEPOT = '" . $unit_to . "' and FIN_YR = '" . $cur_fin_yr . "'";
        $result4=mysqli_query($cstccon,$sql4);
        if(mysqli_num_rows($result4) > 0){
            $sql71 = "UPDATE bincrd_depot set RCT_QTY = RCT_QTY + " . abs($qty) . ",RCT_VAL = RCT_VAL + " . abs($iss_val) . ", LRCT_DT = '" . $issue_date . "', UPDUSR = '" . $user_id . "',UPDDT = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL '12:30' HOUR_MINUTE),'%Y-%m-%d') where PART_NO = '" . $part_no . "' and FIN_YR = '" . $cur_fin_yr . "' and DEPOT = '" . $unit_to . "'";
            $result71=mysqli_query($cstccon,$sql71);
        }
        else{
            $sql51 = "insert into bincrd_depot(DEPOT,FIN_YR,PART_NO,RCT_QTY,RCT_VAL,LRCT_DT,UPDUSR,UPDDT) values('" . $unit_to . "','" . $cur_fin_yr . "','" . $part_no . "'," . abs($qty) . "," . abs($iss_val) . ",'" . $issue_date . "','" . $user_id . "',DATE_FORMAT(DATE_ADD(NOW(), INTERVAL '12:30' HOUR_MINUTE),'%Y-%m-%d'))";
            $result51=mysqli_query($cstccon,$sql51);
        }
        
        $sql8 = "select SUM(A.ITM_QTY) YTD_ISS,B.PRTY_CD FROM  bintxnitm A, bintxn B where A.BNTXN_ID = B.BNTXN_ID AND B.FIN_YR = '$cur_fin_yr' AND A.PART_NO = '" . $part_no . "' GROUP BY B.PRTY_CD HAVING B.PRTY_CD = '" . $unit . "'";
        $result8=mysqli_query($cstccon,$sql8);
        $row8 = mysqli_fetch_array($result8);
        $ytd_iss = $row8['YTD_ISS'];
        
        
}
}


$_SESSION['unit_to'] = '';
$sql7 = "delete from item_issue_to_other_unit where UNIT_FROM = '" . $unit . "'";
$result7=mysqli_query($cstccon,$sql7);
ob_clean();
//$filename="Issue_Voucher/" . $v_no . ".pdf";
//$pdf->Output('Voucher.pdf','D');
//$pdf->Output($filename,'F');
$text = "Issue Voucher Number " . $v_no  . " Created Successfully" ;
?>
    <script type="text/JavaScript">
     alert("<?php echo $text ; ?>");
    
     document.location="CSTC_MainMenu.php";

</script>   

