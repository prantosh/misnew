<?php
ob_start ();
require_once('Connections/cstccon.php');
require_once('number2word.php');
session_start();
$cur_fin_yr = $_SESSION['CUR_FIN_YR'];

$unit = $_SESSION['UNIT'];
$user_id = $_SESSION['USER_ID'];
//$remark = $_SESSION['remark'];
$sql3S = "select * from item_receive_local_purchase where DEPOT = '" . $unit . "'";
$result3S=mysqli_query($cstccon,$sql3S);
if(mysqli_num_rows($result3S) > 0){
 
$sql3S3 = "select DOC_DT from item_receive_local_purchase where DEPOT = '" . $unit . "'";
$result3S3=mysqli_query($cstccon,$sql3S3);
$row3S3 = mysqli_fetch_array($result3S3);
$doc_dt = $row3S3['DOC_DT'];


$sql11 = "select * from unit where UNIT = '" . $unit . "'";
$result11=mysqli_query($cstccon,$sql11);
$row11 = mysqli_fetch_array($result11);
$unit_code = $row11['UNIT_CODE'];


$sql1 = "select max(substring(BNTXN_ID,length(BNTXN_ID) - 3,4)) MAX_ID FROM bintxn_depot where FIN_YR = '" . $cur_fin_yr . "' and substring(BNTXN_ID,1,1) = '" . $unit_code . "' and substring(BNTXN_ID,2,2) = '" . $cur_fin_yr . "'";
$result1=mysqli_query($cstccon,$sql1);
if(mysqli_num_rows($result1) > 0){
$row1 = mysqli_fetch_array($result1);
$new_number = $row1['MAX_ID'] + 1;}
else { $new_number = 1;}
if (strlen($new_number) == 3){ $new_number = '0' . $new_number ;}
if (strlen($new_number) == 2){ $new_number = '00' . $new_number ;}
if (strlen($new_number) == 1){ $new_number = '000' . $new_number ;}
if($unit != ''){
$v_no = $unit_code . $cur_fin_yr . 'XR' . $new_number;

$sql4 = "insert into bintxn_depot(BNTXN_ID,FIN_YR,DOC_DT,CREUSR,CREDT) VALUES('" . $v_no . "','$cur_fin_yr','" . $doc_dt . "','" . $_SESSION['UNAME'] . "',NOW())";
$result4=mysqli_query($cstccon,$sql4);



}
//echo $new_number ;

$sql3 = "select * from item_receive_local_purchase A,itm B where A.PART_NO = B.PART_NO and A.DEPOT = '" . $unit . "'";
$result3=mysqli_query($cstccon,$sql3);

while($row3 = mysqli_fetch_array($result3))
{
 //If the current row is the last one, create new page and print column title
    
	$part_no 		= $row3['PART_NO'];
        $itm_nm 		= $row3['ITM_NM'];
        $uom_id 		= $row3['UOM_ID'];
        $spec                   = $row3['ITM_NM'];
        $qty                    = $row3['QTY'];
        $item_rate              = $row3['ITEM_RATE'];
        
         $query11 = "select ALT_NO_3 FROM current_part_no where PART_NO = '" . $part_no . "'";
            $result11 = mysqli_query($cstccon,$query11);
        $row11 = mysqli_fetch_array($result11);
        $alt_no = $row11['ALT_NO_3'];
        
        //$alt_no                 = $row3['ALT_NO'];

        
       $item_val = $item_rate * $qty ; 
        
        $sql5 = "insert into bintxnitm_depot(BNTXN_ID,PART_NO,ITM_QTY,ITM_VAL,CREUSR,CREDT) values('" . $v_no . "','" . $part_no . "'," . $qty . "," . $item_val . ",'" . $user_id . "',NOW())";
        $result5=mysqli_query($cstccon,$sql5);
        
        
       echo  $unit . "','" . $cur_fin_yr . "','" . $part_no . "'," . abs($qty) . "," . abs($item_val) . ")";

        
        
        $sql62 = "select * from bincrd_depot where PART_NO = '" . $part_no . "' and FIN_YR = '" . $cur_fin_yr . "' and DEPOT = '" . $unit . "'";
        $result62=mysqli_query($cstccon,$sql62);
        if(mysqli_num_rows($result62) > 0){
        
        $sql7 = "UPDATE bincrd_depot set RCT_QTY = RCT_QTY + " . abs($qty) . ",RCT_VAL = RCT_VAL + " . abs($item_val) . ", LRCT_DT = '" . $doc_dt . "' where PART_NO = '" . $part_no . "' and FIN_YR = '" . $cur_fin_yr . "' AND DEPOT = '" . $unit . "'";
        $result7=mysqli_query($cstccon,$sql7);
        }
        else{
        $sql_itm21="insert into bincrd_depot(DEPOT,FIN_YR,PART_NO,RCT_QTY,RCT_VAL,LRCT_DT) values('" . $unit . "','" . $cur_fin_yr . "','" . $part_no . "'," . abs($qty) . "," . abs($item_val) . ",now())";
        $result_itm21=mysqli_query($cstccon,$sql_itm21);
    }
        
        
        
	
}

?>
    <script type="text/JavaScript">
     alert("<?php echo 'Item added successfully' ; ?>");
    
     document.location="CSTC_MainMenu.php";

</script>   
<?php
        }
else{
    echo $row_itm['PART_NO'];
        echo '<script type="text/javascript">';
        echo "alert('Not a Valid Item. Item cannot be received.')";
        echo '</script>';
}?>

