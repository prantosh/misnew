<?php 
session_start();

if(isset($_POST['folio_no1'])){
//Connect to database from here
require_once('Connections/cstccon.php');

$CUR_FIN_YR = $_SESSION['CUR_FIN_YR'];
//echo $ofr_val;

$folio_no   =   htmlspecialchars($_POST['folio_no1'],ENT_QUOTES);
$po_no      =   htmlspecialchars($_POST['po_no1'],ENT_QUOTES);
$ofr_qty    =   htmlspecialchars($_POST['ofr_qty1'],ENT_QUOTES);
$ofr_val    =   htmlspecialchars($_POST['ofr_val1'],ENT_QUOTES);

$_SESSION['folio_no'] = $folio_no;

$sql_itmz1="DELETE FROM billitem_temp WHERE PO_LINE = '" . $folio_no . "'";
$result_itmz1=mysqli_query($cstccon,$sql_itmz1);
//echo $folio_no . $po_no;
$sql="SELECT PO_QTY FROM poitm WHERE PO_NO = '" . $po_no . "' and PART_NO = '" . $folio_no . "'";
$result=mysqli_query($cstccon,$sql);
$row=mysqli_fetch_array($result);
$po_qty = $row['PO_QTY'];

$sql1="SELECT a.PO_LINE po_line1,sum(a.OFR_QTY) tot_offr_qty FROM billitm a,bill b WHERE a.PO_LINE = '" . $folio_no . "' and b.ORD_NO = '" . $po_no . "' and a.BIL_ID = b.BIL_ID group by a.PO_LINE";
$result1=mysqli_query($cstccon,$sql1);
$row1=mysqli_fetch_array($result1);
$ofr_qty_billed = $row1['tot_offr_qty'];
//echo '*' . $ofr_qty_billed;
if($po_qty > $ofr_qty_billed){

$sql_itm="DELETE FROM billitm_temp WHERE PO_LINE = '" . $folio_no . "'";
$result_itm=mysqli_query($cstccon,$sql_itm);

$sql_itmz="DELETE FROM billitem_temp WHERE OFR_QTY = 0";
$result_itmz=mysqli_query($cstccon,$sql_itmz);

$sql_itmz1="DELETE FROM billitem_temp WHERE PO_LINE = '" . $folio_no . "'";
$result_itmz1=mysqli_query($cstccon,$sql_itmz1);

$sql_itm="INSERT INTO billitm_temp(PO_LINE,OFR_QTY,OFR_VAL) VALUES('" . $folio_no . "'," . $ofr_qty . "," . $ofr_val . ")";
$result_itm=mysqli_query($cstccon,$sql_itm);
}
else{
    echo "<p>";
        echo   "<H6><font color='red'>Sorry. Offered Quantity is greater than already billed quantity for " . $folio_no . "</font></H6>";
        echo "</p>";
    
       
}
echo "<style type='text/css'>";
//echo "table.alternate tr:nth-child(odd) {background-color: #ffffff;color:black;}";
//echo "table.alternate tr:nth-child(even) {background-color: grey;color:white;}";

echo "</style>";

       $sql_itm="SELECT * FROM billitm_temp";
        $result_itm=mysqli_query($cstccon,$sql_itm);
        $row_itm=mysqli_fetch_array($result_itm);
       
        echo "<H6><font color='black'>PAYMENT PROPOSAL WILL BE CREATED FOR THE FOLLOWING ITEMS</font></H6>";
echo '<table id="tbl_id" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example"class="rounded-corners">';

//echo '<table  id="tbl_id" cellpadding="0" cellspacing="0" border="0"  class="TFtable">';
        echo "<tbody>";
                        echo "<tr style='margin: 0; padding: 0; border-collapse: collapse;'>";
                        echo "<th align='center'>SRL</th>";
                        echo "<th align='center'>FOLIO NO.</th>";
                        echo "<th align='center'style='margin: 0; padding: 0; border-collapse: collapse;'>OFFERED QUANTITY</th>";
                        echo "<th align='center'style='margin: 0; padding: 0; border-collapse: collapse;'>TOTAL VALUE</th>";
                       echo "</tr>";
              
                                
                               
                                $i = 1;                       
                               
                                $x = 1;
                    do{
                                
                        echo "<tr style='margin: 0; padding: 0; border-collapse: collapse;'>";
                        echo "<td>" . $x . "</td>";
                        echo "<td>" . $row_itm['PO_LINE'] . "</td>";
                        echo "<td align='right'>" . $row_itm['OFR_QTY'] . "</td>";
                        echo "<td align='right'>" . $row_itm['OFR_VAL'] . "</td>";
                       
                        
                       
                        echo "</tr>";
                          $x = $x + 1;
                          } while ($row_itm = mysqli_fetch_assoc($result_itm));
                        echo "</tbody>";
                        echo "</table>";
                        echo "</div>";
                        echo "</div>";

        

       
       
	
}

?>
