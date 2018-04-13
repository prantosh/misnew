<?php 
session_start();
if(isset($_POST['folio_no1'])){
//Connect to database from here
require_once('Connections/cstccon.php');


$creusr = $_SESSION['USER_ID'];
$unit_to_code=htmlspecialchars($_POST['unit_to_code'],ENT_QUOTES);
$ref_no=htmlspecialchars($_POST['ref_no'],ENT_QUOTES);
$INDNT_ID=htmlspecialchars($_POST['indnt_id1'],ENT_QUOTES);
$fin_yr = $_SESSION['CUR_FIN_YR'] ;
//$req_dt1 = substr($req_dt,6,4) . '-' . substr($req_dt,3,2) . '-' . substr($req_dt,0,2);

$queryZ =  "select * from indnt where INDNT_ID = '" . $INDNT_ID . "'";
$resultZ = mysqli_query($cstccon,$queryZ) or die(mysqli_error());
$rowZ=mysqli_fetch_array($resultZ) ;
$req_dt = $rowZ['INDNT_DT'];

$query =  "select * from indntitm_temp";
                       
$result = mysqli_query($cstccon,$query) or die(mysqli_error());
 
         while ($row=mysqli_fetch_array($result) ){ 
             $part_no = $row['PART_NO'];
             $req_qty = $row['REQ_QTY'];
            // $req_dt = $row['REQ_DT'];
             $lst_cons = $row['LST_CONS'];
             $cur_stk = $row['CUR_STK'];
             $stk_as_on = $row['STK_AS_ON'];
             $ITEM_NO = $row['ITEM_NO'];
         $queryC =  "select * from indntitm WHERE INDNT_ID = '" . $INDNT_ID . "' AND PART_NO = '" . $part_no . "'";
         $resultC = mysqli_query($cstccon,$queryC) or die(mysqli_error()); 
         if(mysqli_num_rows($resultC) <= 0){
             
            $query1 =  "insert into indntitm(INDNT_ID,BUCKET_ID,PART_NO,REQ_QTY,REQ_DT,LST_CONS,CUR_STK,STK_AS_ON,ITEM_NO,CREUSR,CREDT)"
                    . "values('$INDNT_ID','Y','$part_no','$req_qty','$req_dt','$lst_cons','$cur_stk','$stk_as_on','$ITEM_NO','$creusr',DATE_FORMAT(DATE_ADD( now( ) , INTERVAL  '12:30' HOUR_MINUTE ),'%Y-%m-%d'))";
                       
            $result1 = mysqli_query($cstccon,$query1) or die(mysqli_error()); 
            
            $query4 =  "UPDATE current_part_no set ALT_NO_3 = '" . $ITEM_NO . "' WHERE PART_NO = '" . $part_no . "'";
            $result4 = mysqli_query($cstccon,$query4) or die(mysqli_error());
         }
                       
                          } 
                      
}		
		
?>

<script type="text/javascript">  
alert(" <?php echo 'Indent Number ' . $INDNT_ID . ' modified successfully';?> ") ;  
window.location = "CSTC_MainMenu.php";
</script>






