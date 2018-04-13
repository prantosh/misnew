<?php 
session_start();

//Connect to database from here
require_once('Connections/cstccon.php');

$CUR_FIN_YR = $_SESSION['CUR_FIN_YR'];
//$po_no = $_SESSION['po_no'];
$folio_no=htmlspecialchars($_POST['folio_no'],ENT_QUOTES);
$alt_no=htmlspecialchars($_POST['alt_no'],ENT_QUOTES);
$itm_nm=htmlspecialchars($_POST['itm_nm'],ENT_QUOTES);
//$uom_id=htmlspecialchars($_POST['uom_id'],ENT_QUOTES);
$spec=htmlspecialchars($_POST['spec'],ENT_QUOTES);
//$cat=htmlspecialchars($_POST['cat'],ENT_QUOTES);
$act=htmlspecialchars($_POST['act'],ENT_QUOTES);


$sql_itmz="select * from itm where PART_NO = '" . $folio_no . "'";
$result_itmz=mysqli_query($cstccon,$sql_itmz);
if(mysqli_num_rows($result_itmz) > 0){
    
    if($alt_no != ''){
        $sql = "update itm set alt_no = '" . $alt_no . "' where PART_NO = '" . $folio_no . "'";
        $result=mysqli_query($cstccon,$sql);
        
         
        $sql1 = "update current_part_no set ALT_NO_3 = '" . $alt_no . "' where PART_NO = '" . $folio_no . "'";
        $result1=mysqli_query($cstccon,$sql1);
        
        $sql_itmz11="insert into itmalias(PART_NO,ALIAS_NO,CREUSR) values('" . $folio_no . "','" . $alt_no . "','" . $_SESSION['USER_ID'] . "')" ;
        $result_itmz11=mysqli_query($cstccon,$sql_itmz11);
    }
    if($itm_nm != ''){
        $sql = "update itm set ITM_NM = '" . $itm_nm . "' where PART_NO = '" . $folio_no . "'";
        $result=mysqli_query($cstccon,$sql);
    }
    if($spec != ''){
        $sql = "update itm set SPEC = '" . $spec . "' where PART_NO = '" . $folio_no . "'";
        $result=mysqli_query($cstccon,$sql);
    }
    if($act != ''){
        $sql = "update itm set ACT_FLG = '" . $act . "' where PART_NO = '" . $folio_no . "'";
        $result=mysqli_query($cstccon,$sql);
    }
    
   ?>
<script type="text/javascript">
    alert("Item Modified Successfully")
     document.location="CSTC_FindItem_Edit.php";
</script>
<?php 
}
else 
    {
    ?>
    <script type="text/javascript">
     alert("Folio Number Not Found")
     
     document.location="CSTC_FindItem_Edit.php";

</script>
<?php

    }
?>




