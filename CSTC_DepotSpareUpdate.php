<?php 
session_start();
if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');    
    
}
if(isset($_POST['unit_to_update'])){
//Connect to database from here
    
$unit_to_update =  htmlspecialchars($_POST['unit_to_update'],ENT_QUOTES);   
$folio_no =  htmlspecialchars($_POST['folio_no'],ENT_QUOTES);   
$stock =  htmlspecialchars($_POST['stock'],ENT_QUOTES);   
$unit = $unit_to_update;  
    
require_once('Connections/cstccon.php');

$cur_fin_yr = $_SESSION['CUR_FIN_YR'];


$sql_itm="SELECT * FROM itm where PART_NO = '" . $folio_no . "'";
$result_itm=mysqli_query($cstccon,$sql_itm);
if(mysqli_num_rows($result_itm) > 0){
    
    $sql_itm11="SELECT * FROM itm_rate_310317 where PART_NO = '" . $folio_no . "'";
    $result_itm11=mysqli_query($cstccon,$sql_itm11);
    $row11 = mysqli_fetch_assoc($result_itm11);
    $rate = $row11['rate'];
    $val = $stock * $rate ;
    
    
    $sql_itm1="SELECT * FROM bincrd_depot where PART_NO = '" . $folio_no . "' and DEPOT = '" . $unit . "' AND FIN_YR = '" . $cur_fin_yr . "'";
    $result_itm1=mysqli_query($cstccon,$sql_itm1);
    if(mysqli_num_rows($result_itm1) > 0){
        
        $sql_itm2="update bincrd_depot set OPNG_QTY = " . abs($stock) . ",OPNG_VAL = " . abs($val) . ",RCT_QTY = 0,ISS_QTY = 0 where PART_NO = '" . $folio_no . "' and DEPOT = '" . $unit . "' AND FIN_YR = '" . $cur_fin_yr . "'";
        $result_itm2=mysqli_query($cstccon,$sql_itm2);
    }
    else{
        $sql_itm3="insert into bincrd_depot(DEPOT,FIN_YR,PART_NO,OPNG_QTY,OPNG_VAL) VALUES('" . $unit. "','" . $cur_fin_yr . "','" . $folio_no . "'," . abs($stock) . "," . abs($val) . ")";
        $result_itm3=mysqli_query($cstccon,$sql_itm3);
    }
}
else{
    ?>
 <script type="text/JavaScript">
     alert("<?php echo "Folio Number Not found." ; ?>");
    
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
 