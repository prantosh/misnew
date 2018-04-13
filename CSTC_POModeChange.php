<?php 
session_start();
if(isset($_POST['po_no_mod'])){
//Connect to database from here
    
$po_no_mod =  htmlspecialchars($_POST['po_no_mod'],ENT_QUOTES);   

    
require_once('Connections/cstccon.php');



$sql_itm="SELECT * FROM po where PO_NO = '" . $po_no_mod . "'";
$result_itm=mysqli_query($cstccon,$sql_itm);
if(mysqli_num_rows($result_itm) > 0){
    
   
        
        $sql_itm2="update po set STS = 'D' WHERE PO_NO = '" . $po_no_mod . "'";
        $result_itm2=mysqli_query($cstccon,$sql_itm2);
         ?>
        <script type="text/JavaScript">
        alert("<?php echo "Updation Successful." ; ?>");
         document.location="CSTC_MainMenu.php";
        </script>   
        <?php
   }
    

else{
    ?>
 <script type="text/JavaScript">
     alert("<?php echo "PO Number Not found." ; ?>");
    
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
 