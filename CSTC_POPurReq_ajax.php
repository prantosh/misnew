<?php 
session_start();
if(isset($_POST['folio_no1'])){
//Connect to database from here
require_once('Connections/cstccon.php');


$CUR_FIN_YR = $_SESSION['CUR_FIN_YR'];

$folio_no=htmlspecialchars($_POST['folio_no1'],ENT_QUOTES);
$unt_id=htmlspecialchars($_POST['unt_id'],ENT_QUOTES);
//echo $folio_no ;
//echo $unt_id ;
$sql_itmz="SELECT * from itm where PART_NO = '" . $folio_no . "'";
$result_itmz=mysqli_query($cstccon,$sql_itmz);
$row_itmz =mysqli_fetch_array($result_itmz);

$itm_nm = $row_itmz['ITM_NM'];
//$alt_no = $row_itmz['ALT_NO'];
$alt_no_2 = $row_itmz['ALT_NO_2'];
$uom_id = $row_itmz['UOM_ID'];

$sql_itmz4="SELECT * from current_part_no where PART_NO = '" . $folio_no . "'";
$result_itmz4=mysqli_query($cstccon,$sql_itmz4);
$row_itmz4 =mysqli_fetch_array($result_itmz4);
$alt_no = $row_itmz4['ALT_NO_3'];


$sql_itmC="UPDATE purreqitm set PO_QTY = 0 WHERE PO_QTY IS NULL";
$result_itmC=mysqli_query($cstccon,$sql_itmC);

$sql_itm="SELECT distinct A.PART_NO,A.PUR_PLN_QTY,A.TC_QTY,A.PB_QTY,A.PO_QTY,B.PUR_REQ_ID,B.REQ_DT FROM purreqitm A, purreq B where A.PART_NO = '" . $folio_no . "' and A.PUR_REQ_ID = B.PUR_REQ_ID AND A.PO_QTY = 0 and B.UNT_ID = '" . $unt_id . "' ORDER BY B.REQ_DT DESC";
$result_itm=mysqli_query($cstccon,$sql_itm);

if(mysqli_num_rows($result_itm) > 0){



echo "<p></p>";
echo "<font style = 'color:blue;'>FOLIO NO : " . $folio_no . " ;  NAME : " . $itm_nm . " ; PART NO. : " . $alt_no . " ; UOM : " . $uom_id . "</font>" ;
echo "<p></p>";
//echo '<table align="center"id="tbl_id1" cellpadding="0" cellspacing="0" border="0" class="TFtable" width="60%">';
echo '<table id="tbl_id" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example"class="rounded-corners">';


echo "<tr>";
echo "<th >";
echo "REQ. ID";
echo "</th>";
echo "<th >";
echo "REQ. DT.";
echo "</th>";
echo "<th >";
echo "PLANNED QTY";
echo "</th>";
echo "<th >";
echo "TC QTY";
echo "</th>";
echo "<th >";
echo "PB QTY";
echo "</th>";
echo "<th >";
echo "PO ISSUED" ;
echo "</th>";
echo "<th >";
echo "AVAILABLE QTY" ;
echo "</th>";


echo "</tr>";
while ($row_itm = mysqli_fetch_assoc($result_itm)){
echo "<tr>";
echo "<td>";
echo "<font style = 'color:black;'>" . $row_itm['PUR_REQ_ID'] . "</font>";
echo "</td>";
echo "<td>";
echo "<font style = 'color:black;'>" . $row_itm['REQ_DT'] . "</font>";
echo "</td>";
echo "<td style= 'text-align:right'>";
echo "<font style = 'color:black;'>" . $row_itm['PUR_PLN_QTY'] . "</font>";
echo "</td>";
echo "<td style= 'text-align:right'>";
echo "<font style = 'color:black;'>" . $row_itm['TC_QTY'] . "</font>";
echo "</td>";
echo "<td style= 'text-align:right'>";
echo "<font style = 'color:black;'>" . $row_itm['PB_QTY'] . "</font>";
echo "</td>";

$req_id = $row_itm['PUR_REQ_ID'];
$sql_itmG="SELECT PART_NO,SUM(PO_QTY) tot_po_qty FROM poitm where REQ_ID = '$req_id' AND PART_NO = '" . $folio_no . "' GROUP BY PART_NO";
$result_itmG=mysqli_query($cstccon,$sql_itmG);
$row_itmG = mysqli_fetch_assoc($result_itmG);





echo "<td style= 'text-align:right' >";
echo "<font style = 'color:black;'>" . $row_itmG['tot_po_qty'] . "</font>"  ;
echo "</td>";
echo "<td style= 'text-align:right' >";
$available_qty = $row_itm['TC_QTY'] - $row_itmG['tot_po_qty'];
echo "<font style = 'color:black;'>" . $available_qty . "</font>"  ;
echo "</td>";

echo "</tr>";
}

echo "</table>";  


$sql_itm1="SELECT A.PART_NO,A.PUR_PLN_QTY,A.TC_QTY,A.PB_QTY,A.PO_QTY,B.PUR_REQ_ID,B.REQ_DT FROM purreqitm A, purreq B where A.PART_NO = '" . $folio_no . "' and A.PUR_REQ_ID = B.PUR_REQ_ID and B.UNT_ID = '" . $unt_id . "' and A.TC_QTY > A.PO_QTY ORDER BY B.REQ_DT DESC";
$result_itm1=mysqli_query($cstccon,$sql_itm1);

echo '<p></p>';

echo '<font style = "color:black;">SELECT REQUISITION ID : </font><div class="form-group"><select class="form-control"name="pur_req_id" id="pur_req_id" tabindex="2">"
    ';
while ($row_itm1 = mysqli_fetch_assoc($result_itm1)){
    echo '<option value = ' . $row_itm1["PUR_REQ_ID"] . '>' . $row_itm1["PUR_REQ_ID"] . '</option>';
}
echo '</select></div>';
}

else {
 echo "<font style = 'color:red;'>No Purchase Requisition Found. Please Create PR First</font>";   
}





}

?>
