<?php // 
session_start();
if(isset($_POST['pur_req_id'])){
//Connect to database from here
require_once('Connections/cstccon.php');

$CUR_FIN_YR = $_SESSION['CUR_FIN_YR'];
//$po_no = $_SESSION['po_no'];
$folio_no=htmlspecialchars($_POST['folio_no1'],ENT_QUOTES);
$po_no=htmlspecialchars($_POST['po_no1'],ENT_QUOTES);
$cd=htmlspecialchars($_POST['cd'],ENT_QUOTES);
$cgst=htmlspecialchars($_POST['cgst'],ENT_QUOTES);
$sgst=htmlspecialchars($_POST['sgst'],ENT_QUOTES);
$igst=htmlspecialchars($_POST['igst'],ENT_QUOTES);
if($cd == ''){$cd = 0;}
if($cgst == ''){$cgst = 0;}
if($sgst == ''){$sgst = 0;}

if($igst == ''){$igst = 0;}

$pur_req_id=htmlspecialchars($_POST['pur_req_id'],ENT_QUOTES);
$_SESSION['folio_no'] = $folio_no;
$qty_po=htmlspecialchars($_POST['qty_po'],ENT_QUOTES);
$unt_rt=htmlspecialchars($_POST['unt_rt'],ENT_QUOTES);
//echo $cgst ;
//echo  $po_no . "','" . $folio_no . "','" . $pur_req_id . "'," . $qty_po . "," . $unt_rt . "," . $cd . "," . $cgst . "," . $sgst . "," . $igst ;

//$unit = $_POST['unit'];
//now validating the PF A/C NO
$sql_itm="DELETE FROM po_item_issue WHERE PART_NO = '" . $folio_no . "'";
$result_itm=mysqli_query($cstccon,$sql_itm);

$sql_itmz="DELETE FROM po_item_issue WHERE QTY = 0";
$result_itmz=mysqli_query($cstccon,$sql_itmz);

$sql_itmR="SELECT * FROM purreqitm WHERE PART_NO = '" . $folio_no . "' and PUR_REQ_ID = '$pur_req_id'";
$result_itmR=mysqli_query($cstccon,$sql_itmR);
$row_itmR=mysqli_fetch_array($result_itmR);
$tc_qty = $row_itmR['TC_QTY'];



$sql_itmG="SELECT PART_NO,SUM(PO_QTY) tot_po_qty FROM poitm where REQ_ID = '$pur_req_id' AND PART_NO = '" . $folio_no . "' GROUP BY PART_NO";
$result_itmG=mysqli_query($cstccon,$sql_itmG);
if(mysqli_num_rows($result_itmG) > 0){
$row_itmG = mysqli_fetch_assoc($result_itmG);
$xx = $row_itmG['tot_po_qty'];
$valid_qty = $tc_qty - $xx ;
}
else{
    $xx = 0 ;
    $valid_qty = $tc_qty ;
}
if($qty_po > $valid_qty){
    $qty_po = $valid_qty;
}



if($valid_qty > 0){

$sql_itmtot="select count(*) tot FROM po_item_issue";
$result_itmtot=mysqli_query($cstccon,$sql_itmtot);
$row_itmtot=mysqli_fetch_array($result_itmtot);    
    
if($row_itmtot['tot'] <= 16){    
$sql_itm="INSERT INTO po_item_issue(PO_NO,PART_NO,REQ_ID,PO_QTY,UNT_RT,cd,cgst,sgst,igst) VALUES('" . $po_no . "','" . $folio_no . "','" . $pur_req_id . "'," . $qty_po . "," . $unt_rt . "," . $cd . "," . $cgst . "," . $sgst . "," . $igst . ")";
$result_itm=mysqli_query($cstccon,$sql_itm);
}

echo "<style type='text/css'>";
echo "table.alternate tr:nth-child(odd) {background-color: #ffffff;color:black;}";
echo "table.alternate tr:nth-child(even) {background-color: grey;color:white;}";

echo "</style>";

       $sql_itmH="SELECT A.cgst,A.sgst,A.igst,A.cd,A.PART_NO,A.PO_QTY,B.ITM_NM,B.ALT_NO,B.ALT_NO_2,B.UOM_ID,A.REQ_ID,A.UNT_RT,C.ALT_NO_3 FROM po_item_issue A, itm B,current_part_no C where C.PART_NO = B.PART_NO and A.PART_NO = B.PART_NO";
        $result_itmH=mysqli_query($cstccon,$sql_itmH);
       // $row_itmH=mysqli_fetch_array($result_itmH);
       
        echo "PURCHASE ORDER OF THE FOLLOWING ITEMS WILL BE ISSUED";
echo "<p></p>";
echo '<table  id="tbl_id" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example"class="rounded-corners">';

        //echo '<table class = "TFtable" id="tbl_id" cellpadding="0" cellspacing="0" border="0" class="table alternate table-bordered" id="example"class="rounded-corners">';
        echo "<tbody>";
                        echo "<tr style='margin: 0; padding: 0; border-collapse: collapse;'>";
                        echo "<th style='margin: 0; padding: 0; border-collapse: collapse;'>SRL</th>";
                        echo "<th style='margin: 0; padding: 0; border-collapse: collapse;'>FOLIO NO.</th>";
                        echo "<th style='margin: 0; padding: 0; border-collapse: collapse;'>PART NO.</th>";
                        echo "<th style='margin: 0; padding: 0; border-collapse: collapse;'>DESCRIPTION</th>";
                        echo "<th style='margin: 0; padding: 0; border-collapse: collapse;'>UOM</th>";
                        echo "<th style='margin: 0; padding: 0; border-collapse: collapse;'>REQ. ID</th>";
                        echo "<th style='margin: 0; padding: 0; border-collapse: collapse;'>PR QTY</th>";
                        echo "<th style='margin: 0; padding: 0; border-collapse: collapse;'>TC QTY</th>";
                        echo "<th style='margin: 0; padding: 0; border-collapse: collapse;'>PO QTY</th>";
                        echo "<th style='margin: 0; padding: 0; border-collapse: collapse;'>CD</th>";
                        echo "<th style='margin: 0; padding: 0; border-collapse: collapse;'>CGST</th>";
                        echo "<th style='margin: 0; padding: 0; border-collapse: collapse;'>SGST</th>";
                        echo "<th style='margin: 0; padding: 0; border-collapse: collapse;'>IGST</th>";
                        echo "<th style='margin: 0; padding: 0; border-collapse: collapse;'>UNIT RATE</th>";
                        echo "</tr>";
              
                                
                                
                                $x = 1;
                   while ($row_itmH = mysqli_fetch_assoc($result_itmH)){
                                
                        echo "<tr style='margin: 0; padding: 0; border-collapse: collapse;'>";
                        echo "<td>" . $x . "</td>";
                        echo "<td>" . $row_itmH['PART_NO'] . "</td>";
                        echo "<td>" . $row_itmH['ALT_NO_3'] ."</td>";
                        echo "<td>" . $row_itmH['ITM_NM'] . "</td>";
                        echo "<td>" . $row_itmH['UOM_ID'] . "</td>";
                        
                        $part_no = $row_itmH['PART_NO'];
                        $req_id = $row_itmH['REQ_ID'];
                        
                        echo "<td>" . $row_itmH['REQ_ID'] . "</td>";
                        
$sql_itmS="SELECT * FROM purreqitm WHERE PART_NO = '" . $part_no . "' and PUR_REQ_ID = '$req_id'";
$result_itmS=mysqli_query($cstccon,$sql_itmS);
$row_itmS=mysqli_fetch_array($result_itmS);                        
                        
                        
                        
                        
                        
                        echo "<td>" . $row_itmS['PUR_PLN_QTY'] . "</td>";
                        echo "<td>" . $row_itmS['TC_QTY'] . "</td>";
                        echo "<td>" . $row_itmH['PO_QTY'] . "</td>";
                        echo "<td>" . $row_itmH['cd'] . "</td>";
                        echo "<td>" . $row_itmH['cgst'] . "</td>";
                        echo "<td>" . $row_itmH['sgst'] . "</td>";
                        echo "<td>" . $row_itmH['igst'] . "</td>";
                        

                        
                        echo "<td>" . number_format($row_itmH['UNT_RT'],2) . "</td>";
                        echo "</tr>";
                          $x = $x + 1;
                          } 
                        echo "</tbody>";
                        echo "</table>";
                        echo "</div>";
                        echo "</div>";

        
}
else{?>
<script type="text/javascript">
    alert("Sorry. Issue Quantity is Greater than TC Quantity")
</script>
<?php    
       
}
       
       
	
}

?>
