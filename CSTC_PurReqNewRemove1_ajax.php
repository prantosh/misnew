<?php 
session_start();
if(isset($_POST['folio_no1'])){
    $qty2 = $_SESSION['qty'];
    if($qty2 < 0){$qty2 = 0;}
//Connect to database from here
require_once('Connections/cstccon.php');

$CUR_FIN_YR = $_SESSION['CUR_FIN_YR'];

$unit_to_code = $_SESSION['unit_to'] ;
$folio_no=htmlspecialchars($_POST['folio_no1'],ENT_QUOTES);

$sql_itm="DELETE FROM purreqitm_temp WHERE PART_NO = '" . $folio_no . "'";
$result_itm=mysqli_query($cstccon,$sql_itm);

$sql_itmz="DELETE FROM purreqitm_temp WHERE PUR_PLN_QTY = 0";
$result_itmz=mysqli_query($cstccon,$sql_itmz);






echo "<style type='text/css'>";
//echo "table.alternate tr:nth-child(odd) {background-color: #ffffff;color:black;}";
//echo "table.alternate tr:nth-child(even) {background-color: grey;color:white;}";

echo "</style>";

        $sql_itm="SELECT A.INDNT_ID,A.ITEM_NO,A.PART_NO,A.PUR_PLN_QTY,B.ITM_NM,B.ALT_NO,B.ALT_NO_2,B.UOM_ID FROM purreqitm_temp A, itm B where A.PART_NO = B.PART_NO";
        $result_itm=mysqli_query($cstccon,$sql_itm);
       // $row_itm=mysqli_fetch_array($result_itm);
       
        echo "<H5><p style='color:black;'>FOLLOWING ITEMS WILL BE INCLUDED IN PURCHASE REQUISITION</p></H5>";

        echo '<table id="tbl_id" cellpadding="0" cellspacing="0" border="0"  id="example"class="TFtable">';
        echo "<tbody>";
                        echo "<tr style='margin: 0; padding: 0; border-collapse: collapse;'>";
                        echo "<th style='margin: 0; padding: 0; border-collapse: collapse;'>SRL</th>";
                        echo "<th style='margin: 0; padding: 0; border-collapse: collapse;'>FOLIO NO.</th>";
                                               echo "<th style='margin: 0; padding: 0; border-collapse: collapse;'>INDENT ID</th>";

                        echo "<th style='margin: 0; padding: 0; border-collapse: collapse;'>PART NO.</th>";
                        echo "<th style='margin: 0; padding: 0; border-collapse: collapse;'>DESCRIPTION</th>";
                        echo "<th style='margin: 0; padding: 0; border-collapse: collapse;'>UOM</th>";
                        echo "<th style='margin: 0; padding: 0; border-collapse: collapse;'>INDENT QTY</th>";
                      //  echo "<th style='margin: 0; padding: 0; border-collapse: collapse;'>STOCK</th>";
                        //echo "<th style='margin: 0; padding: 0; border-collapse: collapse;'>PROPOSED QTY</th>";
                        echo "</tr>";
              
                                
                                
                                $x = 1;
                    while ($row_itm = mysqli_fetch_assoc($result_itm)){
                                
                        echo "<tr style='margin: 0; padding: 0; border-collapse: collapse;'>";
                        echo "<td>" . $x . "</td>";
                        
                        echo "<td>" . $row_itm['PART_NO'] . "</td>";
                        echo "<td>" . $row_itm['INDNT_ID'] . "</td>";
                        echo "<td>" . $row_itm['ITEM_NO'] ."</td>";
                        echo "<td>" . $row_itm['ITM_NM'] . "</td>";
                        echo "<td>" . $row_itm['UOM_ID'] . "</td>";
                        
                        $folio_no = $row_itm['PART_NO'];
                        
if($row_itm['PART_NO'] == 'all'){                       
                        
                        $sql_itmq="SELECT A.INDNT_ID,A.BUCKET_ID,A.PART_NO,A.REQ_DT,A.REQ_QTY,B.CC_ID from indntitm A,indnt B where A.INDNT_ID = B.INDNT_ID AND A.PART_NO = '" . $folio_no . "' and A.BUCKET_ID = 'Y' ORDER BY A.PART_NO,A.INDNT_ID";
$result_itmq=mysqli_query($cstccon,$sql_itmq);
$row_itmq =mysqli_fetch_array($result_itmq);
$qty = 0;
if(mysqli_num_rows($result_itmq)>0)
{
  
    do{
        $qty1 = $row_itmq['REQ_QTY'];
        $qty = $qty + $qty1;
    }  while ($row_itmq = mysqli_fetch_assoc($result_itmq));
     $plan_qty = $qty; 
}                       
                        
}
else{
    $plan_qty = $row_itm['PUR_PLN_QTY'];
}
                        

                        echo "<td align='right'>" . $plan_qty . "</td>";
                        
 $sql_itm1="SELECT OPNG_QTY,ISS_QTY,RCT_QTY from bincrd where FIN_YR = '$CUR_FIN_YR' AND PART_NO = '" . $folio_no . "'";
    $result_itm1=mysqli_query($cstccon,$sql_itm1);
    $row_itm1 =mysqli_fetch_array($result_itm1);
    $stock = $row_itm1['OPNG_QTY'] + $row_itm1['RCT_QTY'] - $row_itm1['ISS_QTY'] ;                       
                        
                        
                        
                        
                        
                        
                        
                     //   echo "<td align='right'>" . $stock . "</td>";
                        
                        

                        
                $proposed_qty = $plan_qty - $stock;        
                        
                       // echo "<td align='right'>" . $proposed_qty . "</td>";
                        
                        echo "</tr>";
                          $x = $x + 1;
                          } 
                        echo "</tbody>";
                        echo "</table>";
                        echo "</div>";
                        echo "</div>";

        
}


unset($folio_no);	


?>
