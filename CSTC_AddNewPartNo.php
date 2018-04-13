<?php 
session_start();
require_once('Connections/cstccon.php');
if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');    
   
}
if(isset($_POST['part_no'])){
    $part_no =  htmlspecialchars($_POST['part_no'],ENT_QUOTES);   
    $alt_no  =  htmlspecialchars($_POST['alt_no'],ENT_QUOTES);  
    
    
    
    $queryA = "SELECT *  FROM itm where PART_NO = '" . $part_no . "'";
    $RecordsetA = mysqli_query($cstccon,$queryA) or die(mysqli_error());
    if(mysqli_num_rows($RecordsetA) > 0){
    
//Connect to database from here
 
 

$user_id = $_SESSION['USER_ID'];
    


$query = "SELECT *  FROM current_part_no where PART_NO = '" . $part_no . "'";
$Recordset = mysqli_query($cstccon,$query) or die(mysqli_error());
if(mysqli_num_rows($Recordset) > 0){
$row = mysqli_fetch_assoc($Recordset);
$alt_no_3_old = $row['ALT_NO_3'];

$query1 = "update current_part_no set ALT_NO_3 = '" . $alt_no . "', UPDUSR = '" . $user_id . "' where PART_NO = '" . $part_no . "'";
$Recordset1 = mysqli_query($cstccon,$query1) or die(mysqli_error());

    $query3 = "delete FROM itmalias where PART_NO = '" . $part_no . "' and ALIAS_NO = '" . $alt_no . "'";
    $Recordset3 = mysqli_query($cstccon,$query3) or die(mysqli_error());

    $query4 = "insert into itmalias(PART_NO,ALIAS_NO,UPDUSR) values('" . $part_no . "','" .  $alt_no . "','" . $user_id . "')";
    $Recordset4 = mysqli_query($cstccon,$query4) or die(mysqli_error());
}
else {
    $query2 = "insert into current_part_no(PART_NO,ALT_NO_3,UPDUSR) values('" . $part_no . "','" .  $alt_no . "','" . $user_id . "')";
    $Recordset2 = mysqli_query($cstccon,$query2) or die(mysqli_error());
    
   $query4 = "insert into itmalias(PART_NO,ALIAS_NO,UPDUSR) values('" . $part_no . "','" .  $alt_no . "','" . $user_id . "')";
    $Recordset4 = mysqli_query($cstccon,$query4) or die(mysqli_error());
}


 ?>
 <script type="text/JavaScript">
     alert("<?php echo "Updation Successful." ; ?>");
    
     document.location="CSTC_MainMenu.php";

</script>   <?php
    }
    else{
        ?>
 <script type="text/JavaScript">
     alert("<?php echo "Folio Number Does Not Exist." ; ?>");
    
     document.location="CSTC_MainMenu.php";

</script>   <?php
    }
}
?>
 