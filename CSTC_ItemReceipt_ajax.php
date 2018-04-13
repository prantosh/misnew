<?php 
session_start();


//Connect to database from here
require_once('Connections/cstccon.php');


$sql1q="select * from item_receive_temp where INV_QTY > 0";
$result1q=mysqli_query($cstccon,$sql1q);
$i = mysqli_num_rows($result1q);
if(mysqli_num_rows($result1q)>19){?>

<script type="text/javascript">   
alert("Sorry. You can receive maximum 20 items for a single RI Note.")
</script>
    
<?php exit(); } 

//get the posted values
$PO_NO=htmlspecialchars($_POST['PO_NO'],ENT_QUOTES);
$PART_NO=htmlspecialchars($_POST['id'],ENT_QUOTES);
$INV_QTY = htmlspecialchars($_POST['INV_QTY'],ENT_QUOTES);
$SHORT_QTY = htmlspecialchars($_POST['SHORT_QTY'],ENT_QUOTES);
//$GROSS_VAL = htmlspecialchars($_POST['GROSS_VAL'],ENT_QUOTES);

$sql1="select * from poitm where PO_NO = '" . $PO_NO . "' AND PART_NO = '" . $PART_NO . "'";
$result1=mysqli_query($cstccon,$sql1);
$row1 = mysqli_fetch_assoc($result1);
$PO_QTY = $row1['PO_QTY'];
$UNT_RT = $row1['UNT_RT'];



if($SHORT_QTY >= $INV_QTY){
    $INV_QTY = 0;?>
    <script type="text/javascript">   
alert("Sorry. Short Quantity is Greater than or equal to Invoice Quantity. Please try again")
window.location = "CSTC_ItemReceipttestnew.php";
    </script>
    
<?php  } 

$sql3 = "select * from poitm where PO_NO  = '" . $PO_NO . "' and PART_NO = '" . $PART_NO . "'";
$result3=mysqli_query($cstccon,$sql3);
$row3 = mysqli_fetch_array($result3); 
$org_order_qty = $row3['PO_QTY'];
$org_order_qty_x    = $row3['MAX_PO_QTY_ALLOWED'];
$rct_qty    = $row3['RCT_QTY'];
$tot_rct_qty = $INV_QTY + $rct_qty ;

if($tot_rct_qty > $org_order_qty_x){
 $INV_QTY = 0;   ?>
    <script type="text/javascript">   
alert("Sorry. Invoice Quantity is greater that Order Quantity. Please try again")
window.location = "CSTC_ItemReceipttestnew.php";
    </script>
    
<?php  } 

$sql2="select * from item_receive_temp where PART_NO = '$PART_NO'";
$result2=mysqli_query($cstccon,$sql2);
$row2 = mysqli_fetch_assoc($result2);
//$trade_disc = $row2['F01'];
$cash_disc = $row2['cash_disc'];
$igst = $row2['igst'];
//$central_st = $row2['F04'];
$sgst = $row2['sgst'];
$cgst = $row2['cgst'];
$freight = $row2['freight'];

$sql25="select * from po where PO_NO = '" . $PO_NO . "'";
$result25=mysqli_query($cstccon,$sql25);
$row25 = mysqli_fetch_assoc($result25);
$trade_disc = $row25['F01'];

$handle_pack = $row25['F08'];

$_SESSION['trade_disc'] = $trade_disc ;
$_SESSION['cash_disc'] = $cash_disc   ;
$_SESSION['igst'] = $igst  ;
$_SESSION['cgst'] = $cgst  ;
$_SESSION['sgst'] = $sgst    ;
//$_SESSION['surcharge'] = $surcharge   ;
$_SESSION['handle_pack'] = $handle_pack ;
//$_SESSION['insurance'] = $insurance   ;
$_SESSION['freight'] = $freight     ;


$UNT_VAL = $UNT_RT * ($INV_QTY - $SHORT_QTY);

$sql="update item_receive_temp set INV_QTY = " . $INV_QTY . ",SHORT_QTY = " . $SHORT_QTY . ",GROSS_VAL = " . $UNT_VAL . " WHERE PART_NO = '" . $PART_NO . "'";
$result=mysqli_query($cstccon,$sql);?>
<script type="text/javascript">  
   
window.location = "CSTC_ItemReceipttestnew.php";
</script>

