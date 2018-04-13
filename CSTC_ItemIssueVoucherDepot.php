<?php
ob_start ();
require_once('Connections/cstccon.php');
require_once('number2word.php');
session_start();
$cur_fin_yr = $_SESSION['CUR_FIN_YR'];
$unit = $_SESSION['UNIT'];

$sql3S = "select * from item_issue_veh where DEPOT = '" . $unit . "'";
$result3S=mysqli_query($cstccon,$sql3S);
if(mysqli_num_rows($result3S) > 0){
    $row3S = mysqli_fetch_array($result3S);
$doc_dt =  $row3S['DOC_DT'];
//$vehno = $row3S['vehno'];
$user_id = $_SESSION['USER_ID'];
$remark = $_SESSION['remark'];
//require_once('Numbers/Words.php');


$sql11 = "select * from unit where UNIT = '" . $unit . "'";
$result11=mysqli_query($cstccon,$sql11);
$row11 = mysqli_fetch_array($result11);
$unit_desc = $row11['UNIT_DESC'];
$unit_code = $row11['UNIT_CODE'];



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
$v_no = $unit_code . $cur_fin_yr . 'VI' . $new_number;



$sql4 = "insert into bintxn_depot(BNTXN_ID,FIN_YR,DOC_DT,PRTY_CD,RMK,UPDUSR,UPDDT) VALUES('" . $v_no . "','" . $cur_fin_yr . "','" . $doc_dt . "','" . $unit . "','" . $remark . "','" . $_SESSION['UNAME'] . "',DATE_FORMAT(DATE_ADD(NOW(), INTERVAL '12:30' HOUR_MINUTE),'%Y-%m-%d'))";
$result4=mysqli_query($cstccon,$sql4);

$sql49 = "insert into bntxn_id_create_datetime(BNTXN_ID) VALUES('" . $v_no . "')";
$result49=mysqli_query($cstccon,$sql49);

 //$sql5 = "insert into bintxn_depot(BNTXN_ID,PART_NO,ITM_QTY,ITM_VAL,UPDUSR,UPDDT) values('" . $v_no . "','" . $part_no . "'," . $qty . "," . $iss_val . ",'$user_id',NOW())";
 //       $result5=mysqli_query($cstccon,$sql5);

}
//echo $new_number ;

$sql3B = "select A.PART_NO PART_NO1,B.ITM_NM ITM_NM1,B.UOM_ID UOM_ID1,A.DOC_DT DOC_DT1,A.QTY QTY1,A.vehno vehno1 from item_issue_veh A,itm B where A.PART_NO = B.PART_NO and A.DEPOT = '" . $unit . "'";
$result3B=mysqli_query($cstccon,$sql3B);

 $sql5ABA = "insert into test11(abc,def) values('xxx','yyy')";
        $result5ABA=mysqli_query($cstccon,$sql5ABA);

$iss_val_tot = 0;
while($row3B = mysqli_fetch_assoc($result3B)){
 
        $part_no 		= $row3B['PART_NO1'];
        $itm_nm 		= $row3B['ITM_NM1'];
        $uom_id 		= $row3B['UOM_ID1'];
        $spec                   = $row3B['ITM_NM1'];
        $issue_date             = $row3B['DOC_DT1'];
        $qty                    = -$row3B['QTY1'];
        $vehno                  = $row3B['vehno1'];
        
        $query11 = "select ALT_NO_3 FROM current_part_no where PART_NO = '" . $part_no . "'";
            $result11 = mysqli_query($cstccon,$query11);
            if(mysqli_num_rows($result11) > 0){
        $row11 = mysqli_fetch_array($result11);
        $alt_no = $row11['ALT_NO_3'];
            }
            else {
                $alt_no = '';
            }
        //$alt_no                 = $row3['ALT_NO'];
 ?>  
 <script type="text/JavaScript">
     alert("<?php echo $part_no ; ?>");
 </script>      
 <?php   
        
        $sql6 = "select PART_NO,SUM(OPNG_QTY + RCT_QTY) XX,SUM(OPNG_VAL + RCT_VAL) YY from bincrd where PART_NO = '" . $part_no . "' GROUP BY PART_NO";
        $result6=mysqli_query($cstccon,$sql6);
        if(mysqli_num_rows($result6) > 0){
        $row6 = mysqli_fetch_array($result6);
        $iss_val = ($row6['YY']) * $qty /  ($row6['XX']) ;
        }
        else {
            $iss_val = 0;
        }
        $iss_val_tot = $iss_val_tot + $iss_val;
       //  echo '*' .  $v_no . "','" . $part_no . "'," . $qty . "," . $iss_val . '*' . $user_id;

        $sql5AA = "insert into bintxnitm_depot(BNTXN_ID,vehno,PART_NO,ITM_QTY,ITM_VAL,UPDUSR,UPDDT) values('" . $v_no . "','" . $vehno ."','" . $part_no . "'," . $qty . "," . $iss_val . ",'" . $user_id . "',DATE_FORMAT(DATE_ADD(NOW(), INTERVAL '12:30' HOUR_MINUTE),'%Y-%m-%d'))";
        $result5AA=mysqli_query($cstccon,$sql5AA);
        
        $sql7 = "UPDATE bincrd_depot set ISS_QTY = ISS_QTY + " . abs($qty) . ",ISS_VAL = ISS_VAL + " . abs($iss_val) . ", LISS_DT = '" . $issue_date . "', UPDUSR = '" . $user_id . "',UPDDT = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL '12:30' HOUR_MINUTE),'%Y-%m-%d') where PART_NO = '" . $part_no . "' and FIN_YR = '" . $cur_fin_yr . "' and DEPOT = '" . $unit . "'";
        $result7=mysqli_query($cstccon,$sql7);
        
       
         $sql5ABA = "insert into test11(abc,def) values('xxx','yyy')";
        $result5ABA=mysqli_query($cstccon,$sql5ABA);
        
}}



$_SESSION['unit_to'] = '';
$sql7 = "delete from item_issue_veh where DEPOT = '" . $unit . "'";
$result7=mysqli_query($cstccon,$sql7);
ob_clean();
//$filename="Issue_Voucher/" . $v_no . ".pdf";
//$pdf->Output('Voucher.pdf','D');
//$pdf->Output($filename,'F');
$text = "Issue Voucher Number " . $v_no . " Created Successfully" ;
?>
    <script type="text/JavaScript">
     alert("<?php echo $text ; ?>");
    
     document.location="CSTC_MainMenu.php";

</script>   

