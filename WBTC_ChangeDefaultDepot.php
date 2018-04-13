<?php 
session_start();
if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');    
    
}
if(isset($_POST['unit_to_change'])){
//Connect to database from here
    
$unit_to_change =  htmlspecialchars($_POST['unit_to_change'],ENT_QUOTES);   

$unit = $unit_to_change;  
    
require_once('Connections/cstccon.php');
$_SESSION['UNIT']=$unit_to_change;
$query_Recordsetunit = "SELECT *  FROM cstcmis.unit where UNIT = '" . $_SESSION['UNIT'] . "'";
$Recordsetunit = mysqli_query($cstccon,$query_Recordsetunit) or die(mysqli_error());
$row_Recordsetunit = mysqli_fetch_assoc($Recordsetunit);
$unit_desc = $row_Recordsetunit['UNIT_DESC'];
              
                $_SESSION['UNIT_DESC']=$unit_desc;
		
                $_SESSION['UNIT_CODE']=$row_Recordsetunit['UNIT_CODE'];



 ?>
 <script type="text/JavaScript">
     alert("<?php echo "Updation Successful." ; ?>");
    
     document.location="WBTC_MainMenu.php";

</script>   <?php
}
?>
 