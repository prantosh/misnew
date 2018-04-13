<?php 
session_start();
if(isset($_POST['folio_no1'])){
//Connect to database from here
require_once('Connections/cstccon.php');


$unit_to_code=htmlspecialchars($_POST['unit_to_code'],ENT_QUOTES);
$unit_to=htmlspecialchars($_POST['unit_to1'],ENT_QUOTES);

$ref_no=htmlspecialchars($_POST['ref_no'],ENT_QUOTES);
$req_dt=htmlspecialchars($_POST['req_dt'],ENT_QUOTES);
$fin_yr = $_SESSION['CUR_FIN_YR'] ;
$req_dt1 = substr($req_dt,6,4) . '-' . substr($req_dt,3,2) . '-' . substr($req_dt,0,2);

$sql1 = "select max(substring(INDNT_ID,length(INDNT_ID) - 3,4)) MAX_ID FROM indnt where FIN_YR = '" . $_SESSION['CUR_FIN_YR'] . "'";
$result1=mysqli_query($cstccon,$sql1);
$row1 = mysqli_fetch_array($result1);
$new_number = $row1['MAX_ID'] + 1;
if (strlen($new_number) == 3){ $new_number = '0' . $new_number ;}
if (strlen($new_number) == 2){ $new_number = '00' . $new_number ;}
if (strlen($new_number) == 1){ $new_number = '000' . $new_number ;}

$INDNT_ID = 'I' . substr($unit_to_code,0,1) . $_SESSION['CUR_FIN_YR'] . $new_number;
 
$creusr = $_SESSION['USER_ID'];

$query2 =  "insert into indnt(INDNT_ID,UNT_ID,FIN_YR,CC_ID,REF_DOC,INDNT_DT,CREUSR,CREDT)"
                    . "values('$INDNT_ID','B','$fin_yr','$unit_to','$ref_no','$req_dt1','$creusr',DATE_FORMAT(DATE_ADD( now( ) , INTERVAL  '12:30' HOUR_MINUTE ),'%Y-%m-%d'))";
                       
            $result2 = mysqli_query($cstccon,$query2) or die(mysqli_error());   

$query =  "select * from indntitm_temp";
                       
$result = mysqli_query($cstccon,$query) or die(mysqli_error());
 
         while ($row=mysqli_fetch_array($result) ){ 
             $part_no = $row['PART_NO'];
             $req_qty = $row['REQ_QTY'];
             $req_dt = $row['REQ_DT'];
             $lst_cons = $row['LST_CONS'];
             $cur_stk = $row['CUR_STK'];
             $ITEM_NO = $row['ITEM_NO'];
            
             
            $query1 =  "insert into indntitm(INDNT_ID,BUCKET_ID,PART_NO,REQ_QTY,REQ_DT,LST_CONS,CUR_STK,ITEM_NO,CREUSR,CREDT)"
                    . "values('$INDNT_ID','Y','$part_no','$req_qty','$req_dt','$lst_cons','$cur_stk','$ITEM_NO','$creusr',DATE_FORMAT(DATE_ADD( now( ) , INTERVAL  '12:30' HOUR_MINUTE ),'%Y-%m-%d'))";
                       
            $result1 = mysqli_query($cstccon,$query1) or die(mysqli_error()); 
            
            $query4 =  "UPDATE current_part_no set ALT_NO_3 = '" . $ITEM_NO . "' WHERE PART_NO = '" . $part_no . "'";
            $result4 = mysqli_query($cstccon,$query4) or die(mysqli_error());
 
                       
                          } 
                      
}		
		
?>

<script type="text/javascript">  
alert(" <?php echo 'Indent Number ' . $INDNT_ID . ' created successfully';?> ") ;  
window.location = "CSTC_MainMenu.php";
</script>






