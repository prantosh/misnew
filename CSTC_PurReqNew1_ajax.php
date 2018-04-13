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
$indent_id=htmlspecialchars($_POST['indent_id1'],ENT_QUOTES);

$_SESSION['folio_no'] = $folio_no;

$pr_qty = $qty2;

$sql_itm="DELETE FROM purreqitm_temp WHERE PART_NO = '" . $folio_no . "' and INDNT_ID = '" . $indent_id . "'";
$result_itm=mysqli_query($cstccon,$sql_itm);

$sql_itmz="DELETE FROM purreqitm_temp WHERE PUR_PLN_QTY = 0";
$result_itmz=mysqli_query($cstccon,$sql_itmz);

$sql_itmz1="SELECT ALT_NO_3 FROM current_part_no where PART_NO = '" . $folio_no . "'";
$result_itmz1=mysqli_query($cstccon,$sql_itmz1);
$row_itmz1=mysqli_fetch_array($result_itmz1);
$ITEM_NO = $row_itmz1['ALT_NO_3'];

if($indent_id == 'all'){
    
$sql_itm="DELETE FROM purreqitm_temp WHERE PART_NO = '" . $folio_no . "'";
$result_itm=mysqli_query($cstccon,$sql_itm);

$sql_itmq="SELECT A.INDNT_ID,A.BUCKET_ID,A.PART_NO,A.REQ_DT,A.REQ_QTY,B.CC_ID from indntitm A,indnt B where A.INDNT_ID = B.INDNT_ID AND A.PART_NO = '" . $folio_no . "' and A.BUCKET_ID = 'Y'";
$result_itmq=mysqli_query($cstccon,$sql_itmq);
$row_itmq =mysqli_fetch_array($result_itmq);
$qty = 0;
if(mysqli_num_rows($result_itmq)>0)
{
  
    do{
        $qty1 = $row_itmq['REQ_QTY'];
        $indnt_id = $row_itmq['INDNT_ID'];
        $part_no = $row_itmq['PART_NO'];
        $req_qty = $row_itmq['REQ_QTY'];
        $qty = $qty + $qty1;
        $plan_qty = $qty;
    $sql_itmp="INSERT INTO purreqitm_temp(INDNT_ID,PART_NO,PUR_PLN_QTY,ITEM_NO) VALUES('" . $indnt_id . "','" .$part_no . "'," . $req_qty . ",'" . $ITEM_NO . "')";
    $result_itmp=mysqli_query($cstccon,$sql_itmp);
    }  while ($row_itmq = mysqli_fetch_assoc($result_itmq));
    
}                       
                        
}  
else{
    
$sql_itmq="SELECT A.INDNT_ID,A.BUCKET_ID,A.PART_NO,A.REQ_DT,A.REQ_QTY,B.CC_ID from indntitm A,indnt B where A.INDNT_ID = B.INDNT_ID AND A.INDNT_ID = '" . $indent_id . "' AND A.PART_NO = '" . $folio_no . "' and A.BUCKET_ID = 'Y'";
$result_itmq=mysqli_query($cstccon,$sql_itmq);
$row_itmq =mysqli_fetch_array($result_itmq);
$qty = 0;

if(mysqli_num_rows($result_itmq)>0)
{
 $qty = $row_itmq['REQ_QTY']; 
    
    $plan_qty = $qty;
    $sql_itmp="INSERT INTO purreqitm_temp(INDNT_ID,PART_NO,PUR_PLN_QTY,ITEM_NO) VALUES('" . $indent_id . "','" . $folio_no . "'," . $plan_qty . ",'" . $ITEM_NO . "')";
    $result_itmp=mysqli_query($cstccon,$sql_itmp);
}       
}

echo "<style type='text/css'>";
echo "</style>";

        $sql_itm="SELECT A.INDNT_ID,A.ITEM_NO,A.PART_NO,A.PUR_PLN_QTY,B.ITM_NM,B.ALT_NO,B.ALT_NO_2,B.UOM_ID FROM purreqitm_temp A, itm B where A.PART_NO = B.PART_NO";
        $result_itm=mysqli_query($cstccon,$sql_itm);
       
        echo "<H5><p style='color:black;'>FOLLOWING ITEMS WILL BE INCLUDED IN PURCHASE REQUISITION</p></H5>";

        echo '<table height = "50" id="tbl_id" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example"class="rounded-corners">';
        echo "<tbody>";
                        echo "<tr style='margin: 0; padding: 0; border-collapse: collapse;'>";
                        echo "<th style='margin: 0; padding: 0; border-collapse: collapse;'>SRL</th>";
                        echo "<th style='margin: 0; padding: 0; border-collapse: collapse;'>FOLIO NO.</th>";
                                               echo "<th style='margin: 0; padding: 0; border-collapse: collapse;'>INDENT ID</th>";

                        echo "<th style='margin: 0; padding: 0; border-collapse: collapse;'>PART NO.</th>";
                        echo "<th style='margin: 0; padding: 0; border-collapse: collapse;'>DESCRIPTION</th>";
                        echo "<th style='margin: 0; padding: 0; border-collapse: collapse;'>UOM</th>";
                        echo "<th style='margin: 0; padding: 0; border-collapse: collapse;'>INDENT QTY</th>";
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
 
                $proposed_qty = $plan_qty - $stock;        
           
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
