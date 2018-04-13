<?php 
session_start();
if(isset($_POST['folio_no1'])){
//Connect to database from here
require_once('Connections/cstccon.php');

$creusr = $_SESSION['USER_ID'];
//echo $folio_no ;
$folio_no=htmlspecialchars($_POST['folio_no1'],ENT_QUOTES);
$alt_no_3=htmlspecialchars($_POST['alt_no_3'],ENT_QUOTES);
//$ITEM_NO=htmlspecialchars($_POST['ITEM_NO'],ENT_QUOTES);
if($alt_no_3 != ''){
   
        $sql_itmt="SELECT * from current_part_no where PART_NO = '" . $folio_no . "'";
        $result_itmt=mysqli_query($cstccon,$sql_itmt);
        if(mysqli_num_rows($result_itmt) > 0){
            $sql_itmt1="update current_part_no set ALT_NO_3 = '" . $alt_no_3 . "' where PART_NO = '" . $folio_no . "'";
            $result_itmt1=mysqli_query($cstccon,$sql_itmt1);
        }
        else{
            $sql_itmt1="insert into current_part_no(PART_NO,ALT_NO_3) VALUES('" . $folio_no . "','" . $alt_no_3 . "')";
            $result_itmt1=mysqli_query($cstccon,$sql_itmt1);
            
            $sql_itmt="SELECT * from itmalias where PART_NO = '" . $folio_no . "' and ALIAS_NO = '" . $alt_no_3 . "'";
        $result_itmt=mysqli_query($cstccon,$sql_itmt);
        if(mysqli_num_rows($result_itmt) <= 0){
            
            $sql_itmt1="insert into itmalias(PART_NO,ALIAS_NO,CREUSR) VALUES('" . $folio_no . "','" . $alt_no_3 . "'" . $creusr . "')";
            $result_itmt1=mysqli_query($cstccon,$sql_itmt1);
            
        }
            
            
            
            
            
            
        }
}

$query13 =  "SELECT * from current_part_no where PART_NO = '$folio_no'";
$result13 = mysqli_query($cstccon,$query13) or die(mysqli_error());
if(mysqli_num_rows($result13) > 0){
$row13 = mysqli_fetch_array($result13);
$ITEM_NO = $row13['ALT_NO_3'];}
else {
    $ITEM_NO = '';
}

     





$query1 =  "SELECT * from itm where PART_NO = '$folio_no'";
$result1 = mysqli_query($cstccon,$query1) or die(mysqli_error());
if(mysqli_num_rows($result1) > 0){



$req_qty=htmlspecialchars($_POST['req_qty'],ENT_QUOTES);
if($req_qty == ''){$req_qty = 0;}
$req_dt=htmlspecialchars($_POST['req_dt'],ENT_QUOTES);
$stk_dt=htmlspecialchars($_POST['stock_date1'],ENT_QUOTES);
$lst_cons=htmlspecialchars($_POST['lst_cons'],ENT_QUOTES);
$cur_stk=htmlspecialchars($_POST['cur_stk'],ENT_QUOTES);
if($lst_cons == ''){$lst_cons = 0;}
if($cur_stk == ''){$cur_stk = 0;}
$req_dt1 = substr($req_dt,6,4) . '-' . substr($req_dt,3,2) . '-' . substr($req_dt,0,2);
$stk_dt1 = substr($stk_dt,6,4) . '-' . substr($stk_dt,3,2) . '-' . substr($stk_dt,0,2);


$sql_itmH1="DELETE FROM  indntitm_temp where PART_NO = '$folio_no' ";
$result_itmH1=mysqli_query($cstccon,$sql_itmH1);
// echo '*' . $folio_no . '*' . $req_qty . '*' . $req_dt1 . '*' . $lst_cons . '*' . $cur_stk ;        

 if($folio_no != '' && $req_qty > 0)  {     
$query =  "insert into indntitm_temp (PART_NO,REQ_QTY,REQ_DT,LST_CONS,CUR_STK,STK_AS_ON,ITEM_NO) values('$folio_no','$req_qty','$req_dt1','$lst_cons','$cur_stk','$stk_dt1','$ITEM_NO')";
                       
$result = mysqli_query($cstccon,$query) or die(mysqli_error());
 }
}
//016 -9--12

// ********************************************************
//echo $req_dt1;
echo "<style type='text/css'>";
//echo "table.alternate tr:nth-child(odd) {background-color: #ffffff;color:black;}";
//echo "table.alternate tr:nth-child(even) {background-color: grey;color:white;}";

echo "</style>";

 

       $sql_itmH="SELECT * from indntitm_temp A,itm B where A.PART_NO = B.PART_NO";
        $result_itmH=mysqli_query($cstccon,$sql_itmH);
        //$row_itmH=mysqli_fetch_array($result_itmH);
       echo "<div align='center'>";
        echo "INDENT FOR THE FOLLOWING ITEMS WILL BE CREATED";
echo "<p></p>";
echo '<table height = "50" id="tbl_id" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example"class="rounded-corners">';
        echo "<tbody>";
        
                        echo "<tr>";
                        echo "<th align='center'style='text-align:center;margin: 0; padding: 0; border-collapse: collapse;'>SRL</th>";
                        echo "<th style='text-align:center;margin: 0; padding: 0; border-collapse: collapse;'>FOLIO NO.</th>";
                        echo "<th style='text-align:center;margin: 0; padding: 0; border-collapse: collapse;'>PART NO.</th>";
                        echo "<th style='text-align:center;margin: 0; padding: 0; border-collapse: collapse;'>DESCRIPTION</th>";
                        echo "<th style='text-align:center;margin: 0; padding: 0; border-collapse: collapse;'>UNIT</th>";
                        echo "<th style='text-align:center;margin: 0; padding: 0; border-collapse: collapse;'>QTY REQ.</th>";
                        echo "<th style='text-align:center;margin: 0; padding: 0; border-collapse: collapse;'>REQ. DATE</th>";
                        echo "<th style='text-align:center;margin: 0; padding: 0; border-collapse: collapse;'>LAST CONSUMPTION</th>";
                        echo "<th style='text-align:center;margin: 0; padding: 0; border-collapse: collapse;'>STOCK</th>";
                        echo "<th style='text-align:center;margin: 0; padding: 0; border-collapse: collapse;'>STOCK AS ON</th>";
                            echo "</tr>";
              
                                
                                
                                $x = 1;
         while ($row_itmH=mysqli_fetch_array($result_itmH) ){        
                                
                        echo "<tr style='margin: 0; padding: 0; border-collapse: collapse;'>";
                        echo "<td style='text-align:center;'>" . $x . "</td>";
                        echo "<td style='text-align:center;'>" . $row_itmH['PART_NO'] . "</td>";
                        echo "<td style='text-align:center;'>" . $row_itmH['ITEM_NO'] . "</td>";
                        echo "<td style='text-align:center;'>" . $row_itmH['ITM_NM'] . "</td>";
                        echo "<td style='text-align:center;'>" . $row_itmH['UOM_ID'] . "</td>";
                        echo "<td align='right'>" . $row_itmH['REQ_QTY']  ."</td>";
                        echo "<td style='text-align:center;'>" . $row_itmH['REQ_DT'] . "</td>";
                        echo "<td align='right'>" . $row_itmH['LST_CONS'] . "</td>";
                        
                        
                        echo "<td align='right'>" . $row_itmH['CUR_STK'] . "</td>";
                        echo "<td  style='text-align:center;'>" . $row_itmH['STK_AS_ON'] . "</td>";
   
                        echo "</tr>";
                          $x = $x + 1;
                          } 
                        echo "</tbody>";
                        echo "</table>";
                        
                        echo "</div>";
                        
                        echo "</div>";
                        echo "</div>";





// ********************************************************
}		
		
?>








