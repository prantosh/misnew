<?php 
session_start();
if(isset($_POST['advnc_no_to_update'])){
//Connect to database from here
    
$unit_to_update =  $_SESSION['UNIT'];
$advnc_no_to_update =  htmlspecialchars($_POST['advnc_no_to_update'],ENT_QUOTES);  
$fin_yr_to_update =  htmlspecialchars($_POST['fin_yr_to_update'],ENT_QUOTES);
$bnk_ref =  htmlspecialchars($_POST['bnk_ref'],ENT_QUOTES);
$payment_date =  htmlspecialchars($_POST['payment_date'],ENT_QUOTES);


$unit = $_SESSION['UNIT'];  
    
require_once('Connections/cstccon.php');




$sql_itm="SELECT * FROM bill where ADVNC_NO = '" . $advnc_no_to_update . "' AND FIN_YR = '" . $fin_yr_to_update . "'";
$result_itm=mysqli_query($cstccon,$sql_itm);
if(mysqli_num_rows($result_itm) > 0){
    
    $sql_itm2="update bill set RCT_DATE = '" . $payment_date . "',STS = 'P',BNK_REF = '" . $bnk_ref . "' where ADVNC_NO = '" . $advnc_no_to_update . "' AND FIN_YR = '" . $fin_yr_to_update . "'";
    $result_itm2=mysqli_query($cstccon,$sql_itm2);
}
else{
    ?>
 <script type="text/JavaScript">
     alert("<?php echo 'Advnce Proposal Number Not found.' ; ?>");
    
     document.location="CSTC_MainMenu.php";

</script>   <?php
}
 ?>
 <script type="text/JavaScript">
     alert("<?php echo "Updation Successful." ; ?>");
    
     document.location="CSTC_MainMenu.php";

</script>   <?php
}
?>
 