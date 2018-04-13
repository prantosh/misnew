<?php 
session_start();
$_SESSION['qty'] = 0 ;    
if(isset($_POST['folio_no1'])){
//Connect to database from here
require_once('Connections/cstccon.php');



$folio_no=htmlspecialchars($_POST['folio_no1'],ENT_QUOTES);
$unit = htmlspecialchars($_POST['unit'],ENT_QUOTES);
$CUR_FIN_YR = $_SESSION['CUR_FIN_YR'];

$sql_itm5="SELECT * from itm where PART_NO = '" . $folio_no . "'";
$result_itm5=mysqli_query($cstccon,$sql_itm5);
$row_itm5 =mysqli_fetch_array($result_itm5);
$itm_name = $row_itm5['ITM_NM'];
$uom_id = $row_itm5['UOM_ID'];

$sql_itm1="SELECT OPNG_QTY,ISS_QTY,RCT_QTY from bincrd where FIN_YR = '$CUR_FIN_YR' AND PART_NO = '" . $folio_no . "'";
    $result_itm1=mysqli_query($cstccon,$sql_itm1);
    $row_itm1 =mysqli_fetch_array($result_itm1);
    $stock = $row_itm1['OPNG_QTY'] + $row_itm1['RCT_QTY'] - $row_itm1['ISS_QTY'] ;

$sql_itm="SELECT A.ITEM_NO,A.INDNT_ID,A.BUCKET_ID,A.PART_NO,A.REQ_DT,A.REQ_QTY,B.CC_ID from indntitm A,indnt B where A.INDNT_ID = B.INDNT_ID AND A.PART_NO = '" . $folio_no . "' and A.BUCKET_ID = 'Y'";
$result_itm=mysqli_query($cstccon,$sql_itm);
$row_itm =mysqli_fetch_array($result_itm);
if(mysqli_num_rows($result_itm)>0)
{
echo "<p></p>";
echo "<b>DETAILS OF INDENTS PENDING FOR PURCHASE REQUISITION</b>" ;
    echo "<p></p>";
echo '<table height = "50" id="tbl_id" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example"class="rounded-corners">';
echo '<tr>';
echo '<td>';
echo "FOLIO NO.: " . $folio_no ;
echo '</td>';
echo '<td>';
echo "DESCRIPTION: " . $itm_name ;
echo '</td>';
echo '<td>';
echo "UNIT : " . $uom_id ;
echo '</td>';
echo '</tr>';
echo '</table>';

echo '<table height = "50" id="tbl_id" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example"class="rounded-corners">';

echo "<tr>";
echo "<th>";
echo "INDENT ID";
echo "</th>";

echo "<th>";
echo "UNIT";
echo "</th>";

echo "<th>";
echo "REQUIRED DATE";
echo "</th>";
echo "<th>";
echo "REQUIRED QTY.";
echo "</th>";
echo "</tr>";
$qty = 0;
do{
    
                echo "<tr>";
                  echo "<td >"; 
                echo  $row_itm['INDNT_ID'] ;
                echo "</td>";
               
                
                echo "<td >";
                $sql="SELECT UNIT_DESC FROM unit WHERE UNIT = '" . $row_itm['CC_ID'] . "'";
                $result=mysqli_query($cstccon,$sql);
                $row =mysqli_fetch_array($result);
                $unit_desc = $row['UNIT_DESC'];
                echo  $unit_desc ;
                echo "</td>";
                echo "<td >"; 
                echo  $row_itm['REQ_DT'] ;
                echo "</td>";
                echo "<td align='right'>"; 
                echo  $row_itm['REQ_QTY'];
                $qty1 = $row_itm['REQ_QTY'];
                echo "</td>";
                echo "</tr>";
                
    $qty = $qty + $qty1;
 
}  while ($row_itm = mysqli_fetch_assoc($result_itm));

//echo "</tr>";
echo "</table>";  
echo "<p></p>";
$rec_qty = $qty - $stock ;
echo "<font style = 'color:black;font-weight:bold;'> RECOMMENDED QUANTITY FOR REQUISITION = " . $rec_qty . "</font>";
  

echo "<H4>Select Indent ID</span></h4>";
echo '<div class="form-group">';
echo '<select class="form-control"name="indent_id1"" id="indent_id1">';
                                               
                          	
                                $query = "SELECT INDNT_ID FROM indntitm WHERE PART_NO = '" . $folio_no . "' and BUCKET_ID = 'Y'";
                                $Recordset = mysqli_query($cstccon,$query) or die(mysqli_error());
                               // $row = mysqli_fetch_assoc($Recordset);
                                echo  "<option value='all'>ALL INDENTS</option>";
                                while ($row = mysqli_fetch_assoc($Recordset)) {  
                               echo  "<option value=" . $row['INDNT_ID'] . ">" . $row['INDNT_ID'] . "</option>";
                          	
					} 
				
 echo                        			'</select>';
 echo '</div>';
                                    
                                         
$_SESSION['qty'] = $rec_qty ;    

        
}
else{
echo "No record found.";	
}
}
?>
