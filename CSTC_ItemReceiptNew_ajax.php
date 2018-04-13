<?php 
error_reporting(E_ERROR|E_WARNING);
session_start();

//Connect to database from here
require_once('Connections/cstccon.php');



$query32qn = "SELECT * from item_receive_ctrl";
$result32qn = mysqli_query($cstccon,$query32qn) or die(mysqli_error());
$row32qn = mysqli_fetch_assoc($result32qn);
$po_no = $row32qn['po_no'];
$challan_no  = $row32qn['challan_no'];
$challan_date = $row32qn['challan_date'];
$advnc_no = $row32qn['advnc_no'];
$advnc_fin_yr = $row32qn['advnc_fin_yr'];
$remark = $row32qn['remark'];
$gstin = $row32qn['GSTIN'];


$query32xx = "SELECT * from po WHERE PO_NO = '" . $po_no . "'";
$result32xx = mysqli_query($cstccon,$query32xx) or die(mysqli_error());
$row32xx = mysqli_fetch_assoc($result32xx);
$vnd_id = $row32xx['VND_ID'];




//$unit_to =$_SESSION['unit_to'];
$unit_to =htmlspecialchars($_POST['unit_to'],ENT_QUOTES);

$sql111 = "select * FROM item_receive_temp where INV_QTY - SHORT_QTY > 0";
$result111=mysqli_query($cstccon,$sql111);   

if(mysqli_num_rows($result111) == 0){
    ?>
    <script type="text/javascript">   
alert("Sorry. You have not received any item. Process ends here.")
window.location = "CSTC_MainMenu.php";
</script>
    
<?php }

//$unit_to=htmlspecialchars($_POST['unit_to'],ENT_QUOTES);
//echo $_SESSION['unit_to'];
$sql1 = "select max(substring(MAT_RCT_NO,4,4)) MAX_ID FROM matrct where substring(MAT_RCT_NO,2,2) = '" . $_SESSION['CUR_FIN_YR'] . "'";
$result1=mysqli_query($cstccon,$sql1);
if(mysqli_num_rows($result1) > 0){
$row1 = mysqli_fetch_array($result1);
$new_number = $row1['MAX_ID'] + 1;}
else { $new_number = 1;}
if (strlen($new_number) == 3){ $new_number = '0' . $new_number ;}
if (strlen($new_number) == 2){ $new_number = '00' . $new_number ;}
if (strlen($new_number) == 1){ $new_number = '000' . $new_number ;}

$MAT_RCT_NO = 'B' . $_SESSION['CUR_FIN_YR'] .  $new_number;


$dlv_doc = $challan_no;
$dlv_dt = $challan_date;

$unit = $_SESSION['unit_to'];
$rct_date = date('Y-m-d');

$creusr = $_SESSION['USER_ID'];


    
    $sql3="insert into matrct (STR_ID,RCT_DT,PO_NO,VND_ID,GSTIN,MAT_RCT_NO,DLV_DOC,DLV_DT,RMK,INSP_DT,CREUSR,CREDT) values ('$unit','$rct_date','$po_no','$vnd_id','$gstin','$MAT_RCT_NO','$dlv_doc','$dlv_dt','$remark','$rct_date','$creusr',now())";
    $result3=mysqli_query($cstccon,$sql3);
    

    
    
$sql11 = "select max(substring(BNTXN_ID,6,4)) MAX_ID FROM bintxn where substring(BNTXN_ID,2,4) = '" . $_SESSION['CUR_FIN_YR'] . "GR" . "'";
$result11=mysqli_query($cstccon,$sql11);
if(mysqli_num_rows($result11) > 0){
$row11 = mysqli_fetch_array($result11);
$new_number = $row11['MAX_ID'] + 1;}
else { $new_number = 1;}
if (strlen($new_number) == 3){ $new_number = '0' . $new_number ;}
if (strlen($new_number) == 2){ $new_number = '00' . $new_number ;}
if (strlen($new_number) == 1){ $new_number = '000' . $new_number ;}
$CUR_FIN_YR = $_SESSION['CUR_FIN_YR'];
$BNTXN_ID = 'B' . $_SESSION['CUR_FIN_YR'] .  'GR' . $new_number;    

$cur_unit_to = $_SESSION['unit_to'];

$sql32="update item_receive_temp set MAT_RCT_NO = '$MAT_RCT_NO',BNTXN_ID = '$BNTXN_ID',RCVD_AT = '$cur_unit_to'";
$result32=mysqli_query($cstccon,$sql32);   



    
 $sql31="insert into bintxn (STR_ID,DOC_DT,PRTY_CD,BNTXN_ID,RMK,FIN_YR,CLS,PRTY_CLS,REF_DOC,CREUSR,CREDT) "
         . "values ('$unit','$rct_date','$vnd_id','$BNTXN_ID','$remark','$CUR_FIN_YR','GR','V','$dlv_doc','$creusr',now())";
 $result31=mysqli_query($cstccon,$sql31);
 

        
  


while($row111 = mysqli_fetch_assoc($result111)){
    $PART_NO = $row111['PART_NO'];
    $ITM_QTY = $row111['INV_QTY'] - $row111['SHORT_QTY'];
    $GROSS_VAL = $row111['GROSS_VAL'];
    $SHRT_QTY = $row111['SHORT_QTY'];
   // $BNTXN_ID = $row111['BNTXN_ID'];
    $remark = $row111['remark'];
    //$creusr = $row111['creusr'];
    $po_no = $row111['PO_NO'];
   // $MAT_RCT_NO = $row111['MAT_RCT_NO'];
    $creusr = $_SESSION['USER_ID'];
    $cur_unit_to = $_SESSION['unit_to'];
    
    
     $igst                   = $row111['igst'];
        $cd                     = $row111['cd'];
        $sgst                   = $row111['sgst'];
        $cgst                   = $row111['cgst'];
        
        
         $cd_val = $GROSS_VAL * $cd / 100 ;
         $igst_val = ($GROSS_VAL - $cd_val) * $igst / 100 ;
         $cgst_val = ($GROSS_VAL - $cd_val) * $cgst / 100 ;
         $sgst_val = ($GROSS_VAL - $cd_val) * $sgst / 100 ;
         
        $gross_val_new = $GROSS_VAL - $cd_val + $igst_val + $cgst_val + $sgst_val ;
    
    
    
    
    
    
    
    
    
    
    
    
    $sql311="insert into bintxnitm (BNTXN_ID,PART_NO,ITM_QTY,ITM_VAL,RMK,CREUSR,CREDT) "
         . "values ('$BNTXN_ID','$PART_NO','$ITM_QTY','$gross_val_new','$remark','$creusr',now())";
    $result311=mysqli_query($cstccon,$sql311);
 
   
$sql2="select * from po where PO_NO = '" . $po_no . "'";
$result2=mysqli_query($cstccon,$sql2);
$row2 = mysqli_fetch_assoc($result2);

$handle_pack = $row2['F08'];
$freight = $row2['F09']; 


    
// ************************************8 take data from item_receipt_temp for different tax for different item


//$F01 =  $GROSS_VAL * $trade_disc / 100;   
$F02 =  $GROSS_VAL * $cd / 100;  
$F03 =  ($GROSS_VAL - $F02 - $F01) * $igst / 100 ;   
$F04 =  ($GROSS_VAL - $F02 - $F01) * $cgst / 100 ;   
$F05 =  ($GROSS_VAL - $F02 - $F01) * $sgst / 100 ;       
$F08 =   $handle_pack  ;    
$F09 =  $freight;   
    
    
    $sql311="insert into matrctitm (MAT_RCT_NO,PART_NO,DLV_QTY,BNTXN_ID,SHRT_QTY,GRS_VAL,CREUSR,CREDT,ADVNC_NO) "
         . "values ('$MAT_RCT_NO','$PART_NO','$ITM_QTY','$BNTXN_ID','$SHRT_QTY','$gross_val_new','$creusr',now(),'" . $_SESSION['ADVNC_NO'] . "')";
    $result311=mysqli_query($cstccon,$sql311);
// **************************************    
    
    $sql312="update poitm set RCT_QTY = RCT_QTY + '$ITM_QTY', UPDDT = NOW() where PO_NO = '$po_no' and PART_NO = '$PART_NO'";
    $result312=mysqli_query($cstccon,$sql312);
    
    $sql312b="update billitm set RCT_QTY = RCT_QTY + '$ITM_QTY',BNTXN_ID = '$BNTXN_ID' where BIL_ID = (SELECT BIL_ID FROM bill where ADVNC_NO = '" . $advnc_no . "' and FIN_YR = '" . $advnc_fin_yr . "') and PO_LINE = '$PART_NO'";
    $result312b=mysqli_query($cstccon,$sql312b);
    
    $cur_fin_yr = $_SESSION['CUR_FIN_YR'];
    
    $TOTAL_VAL = $GROSS_VAL - $F02 + $F03 + $F04 + $F05 + $F08 + $F09;
    
    
    $sql22="select * from bincrd where FIN_YR = '$cur_fin_yr' and PART_NO = '$PART_NO'";
    $result22=mysqli_query($cstccon,$sql22);
    
    if(mysqli_num_rows($result22)>0)
    {
    $row22 = mysqli_fetch_assoc($result22);
    $rct_qty = $row22['RCT_QTY'];
    $rct_val = $row22['RCT_VAL'];
    $rct_qty_new = $rct_qty + $ITM_QTY ;
    $rct_val_new = $rct_val + $gross_val_new ;
   
  
    $sql312="update bincrd set RCT_QTY =  '$rct_qty_new',RCT_VAL = '$rct_val_new',LRCT_DT = now(),UPDUSR = '$creusr',UPDDT = now() where FIN_YR = '$cur_fin_yr' and PART_NO = '$PART_NO'";
    $result312=mysqli_query($cstccon,$sql312);
    }
    else {
        
        $sql313="insert into bincrd(STR_ID,FIN_YR,PART_NO,RCT_QTY,RCT_VAL,LRCT_DT,CREUSR,CREDT,UPDUSR,UPDDT) "
         . "values ('$cur_unit_to','$cur_fin_yr','$PART_NO','$ITM_QTY','$gross_val_new',now(),'$creusr',now(),'$creusr',now())";
        $result313=mysqli_query($cstccon,$sql313);
        
    }
    // following 2 lines added on 15/10/17
    $sql312a="update itm set LRCT_DT = now() where PART_NO = '$PART_NO'";
    $result312a=mysqli_query($cstccon,$sql312a);
   
    
} 

    
 
// RI note to print here and delete data in item_receive_temp
    
?>
    <script type="text/javascript">   

window.location = "CSTC_RINote.php";
</script>
    
<?php     
    
    












?>


