<?php 
session_start();
$creusr = $_SESSION['USER_ID'];
//Connect to database from here
require_once('Connections/cstccon.php');

$CUR_FIN_YR = $_SESSION['CUR_FIN_YR'];

$folio_no=htmlspecialchars($_POST['folio_no1'],ENT_QUOTES);
$po_no=htmlspecialchars($_POST['po_no1'],ENT_QUOTES);
$unt_rt =htmlspecialchars($_POST['unt_rt'],ENT_QUOTES);  
$new_order_qty =htmlspecialchars($_POST['new_order_qty'],ENT_QUOTES); 
$cd =htmlspecialchars($_POST['cd'],ENT_QUOTES); 
$sgst =htmlspecialchars($_POST['sgst'],ENT_QUOTES);  
$cgst =htmlspecialchars($_POST['cgst'],ENT_QUOTES);  
$igst =htmlspecialchars($_POST['igst'],ENT_QUOTES);  
$alt_no =htmlspecialchars($_POST['alt_no'],ENT_QUOTES);  




if ($unt_rt == ''){$unt_rt = 0 ;}
if ($new_order_qty == ''){$new_order_qty = 0 ;}
if ($cd == ''){$cd = 0 ;}
if ($sgst == ''){$sgst = 0 ;}
if ($cgst == ''){$cgst = 0 ;}
if ($igst == ''){$igst = 0 ;}


$po_no=htmlspecialchars($_POST['po_no1'],ENT_QUOTES);
$_SESSION['po_no'] = $po_no; 
$sql_itma="update poitm set AMD_NO = 0 WHERE AMD_NO IS NULL";
$result_itma=mysqli_query($cstccon,$sql_itma); 

if($alt_no != ''){
    $sql_itma7="update current_part_no set ALT_NO_3 = '" . $alt_no . "' where PART_NO = '" . $folio_no . "'";
    $result_itma7=mysqli_query($cstccon,$sql_itma7); 
    
    
     $query211 = "SELECT * from itmalias WHERE PART_NO = '" . $folio_no . "' and ALIAS_NO = '" . $alt_no . "'";
       $result211 = mysqli_query($cstccon,$query211) or die(mysqli_error());
       if(mysqli_num_rows($result211) > 0){
       $queryF = "insert into itmalias (PART_NO,,CREUSR,CREDT) VALUES ('" . $folio_no . "','" . $alt_no . "','$creusr', now())";
       $resultF = mysqli_query($cstccon,$queryF) or die(mysqli_error());}
       
}
 
$sql3 = "select * from poitm where PO_NO  = '" . $po_no . "' and PART_NO = '" . $folio_no . "'";
$result3=mysqli_query($cstccon,$sql3);
$row3 = mysqli_fetch_array($result3); 
$org_order_qty = $row3['PO_QTY'];

$org_order_qty_x    = $row3['MAX_PO_QTY_ALLOWED'];
$org_unt_rt         = $row3['UNT_RT'];
$org_cd             = $row3['cd'];
$org_sgst           = $row3['sgst'];
$org_cgst           = $row3['cgst'];
$org_igst           = $row3['igst'];

//$org_order_qty_x = $org_order_qty * 1.05 ;

$AMD_STAT = 'N';
if($new_order_qty > 0){
if( $new_order_qty <= $org_order_qty_x ) {
$sql_itmz="update poitm set PO_QTY = " . $new_order_qty . ",UPDUSR = '" . $creusr . "',UPDDT = NOW() where PO_NO = '" . $po_no . "' and PART_NO = '" . $folio_no . "'";
$result_itmz=mysqli_query($cstccon,$sql_itmz);
$AMD_STAT = 'Y';
}
else{?>
    <script type="text/javascript">
     alert('<?php echo $new_order_qty . "Increase of Quantity more than 5% is not allowed" ;?>');
     document.location="ST_POModify.php?q=<?php echo $po_no ; ?>";
</script><?php
}}

if($unt_rt > 0){
$sql_itmz="update poitm set UNT_RT = " . $unt_rt . ",UPDUSR = '" . $creusr . "',UPDDT = NOW() where PO_NO = '" . $po_no . "' and PART_NO = '" . $folio_no . "'";
$result_itmz=mysqli_query($cstccon,$sql_itmz);
$AMD_STAT = 'Y';

}
if($org_cd != $cd){
$sql_itmz="update poitm set cd = " . $cd . ",UPDUSR = '" . $creusr . "',UPDDT = NOW() where PO_NO = '" . $po_no . "' and PART_NO = '" . $folio_no . "'";
$result_itmz=mysqli_query($cstccon,$sql_itmz);
$AMD_STAT = 'Y';

}
if($org_sgst != $sgst){
$sql_itmz="update poitm set sgst = " . $sgst . ",UPDUSR = '" . $creusr . "',UPDDT = NOW() where PO_NO = '" . $po_no . "' and PART_NO = '" . $folio_no . "'";
$result_itmz=mysqli_query($cstccon,$sql_itmz);
$AMD_STAT = 'Y';

}
if($org_cgst != $cgst){
$sql_itmz="update poitm set cgst = " . $cgst . ",UPDUSR = '" . $creusr . "',UPDDT = NOW() where PO_NO = '" . $po_no . "' and PART_NO = '" . $folio_no . "'";
$result_itmz=mysqli_query($cstccon,$sql_itmz);
$AMD_STAT = 'Y';

}
if($org_igst != $igst){
$sql_itmz="update poitm set igst = " . $igst . ",UPDUSR = '" . $creusr . "',UPDDT = NOW() where PO_NO = '" . $po_no . "' and PART_NO = '" . $folio_no . "'";
$result_itmz=mysqli_query($cstccon,$sql_itmz);
$AMD_STAT = 'Y';

}




if($AMD_STAT == 'Y'){
 
//$sql_itmz="update po set AMD_NO = AMD_NO + 1 where PO_NO = '" . $po_no . "'";
//$result_itmz=mysqli_query($cstccon,$sql_itmz);
}
?>

<script type="text/javascript">
     alert("<?php echo 'Item Rate / Quantity Updated for Folio No. ' . $folio_no ;?>");
     document.location="CSTC_POModify.php?q=<?php echo $po_no ; ?>";
</script>


