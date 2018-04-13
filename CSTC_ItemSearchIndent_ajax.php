<?php 
session_start();
//if(isset($_POST['folio_no'])){
//Connect to database from here
require_once('Connections/cstccon.php');


$folio_no=htmlspecialchars($_POST['folio_no1'],ENT_QUOTES);
$query14 =  "SELECT * from current_part_no where PART_NO = '$folio_no'";
$result14 = mysqli_query($cstccon,$query14) or die(mysqli_error());
if(mysqli_num_rows($result14) > 0){
$row14 = mysqli_fetch_assoc($result14);
$alt_no_3 = $row14['ALT_NO_3'];
}
else {
    $alt_no_3 = '';
}
//echo $_POST['unit_to_code'];


//$cc_id=htmlspecialchars($_POST['unit_to1'],ENT_QUOTES);
//echo $cc_id;
//echo $folio_no;
$query1 =  "SELECT * from itm where PART_NO = '$folio_no'";
$result1 = mysqli_query($cstccon,$query1) or die(mysqli_error());
if(mysqli_num_rows($result1) > 0){
    $row1 = mysqli_fetch_assoc($result1);
//if(mysqli_num_rows($result)>0)

$query =  "SELECT distinct B.TC_APRV_QTY,B.INDNT_ID,C.CC_ID,A.PART_NO,A.UOM_ID,B.INDNT_ID,B.REQ_QTY,B.REQ_DT FROM itm A, indntitm B, indnt C where B.INDNT_ID = C.INDNT_ID  and A.PART_NO = '$folio_no' and B.BUCKET_ID = 'Y' and A.PART_NO = B.PART_NO order  by B.REQ_DT DESC";
$i = 1;                       
$result = mysqli_query($cstccon,$query) or die(mysqli_error());
if(mysqli_num_rows($result) > 0){
echo "<div align='center'>";
echo "DETAILS OF INDENT NOT PROCESSED YET ";
echo "<p></p>";
echo '<table height = "50" id="tbl_id" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example"class="rounded-corners">';
echo "<tr>";
echo "<th  align='center'color='black' style='text-align:center;'><font color='#000000'>INDENT NO.</th></font>";
echo "<th  align='center'color='black' style='text-align:center;'><font color='#000000'>DATE</th></font>";
echo "<th  align='center'color='black' style='text-align:center;'><font color='#000000'>DEPOT/UNIT</th></font>";
echo "<th color='black' style='text-align:center;'><font color='#000000'>INDENT QTY</th></font>";


echo "</tr>";

while($row = mysqli_fetch_assoc($result))  {

echo '<tr>';
echo "<td  align='center' style='text-align:center;' >" ;
echo "<font color='#000000'>" . $row['INDNT_ID'] . "</font>";
echo "</td>";
echo "<td   align='center' style='text-align:center;' >" ;
echo "<font color='#000000'>" . $row['REQ_DT'] . "</font>";
echo "</td>";
$query11 =  "SELECT * from unit where UNIT = '" . $row['CC_ID'] . "'";
$result11 = mysqli_query($cstccon,$query11) or die(mysqli_error());
$row11 = mysqli_fetch_assoc($result11) ;
echo "<td   align='center' >" ;
echo "<font color='#000000' style='text-align:center;'>" . $row11['UNIT_DESC'] . "</font>";
echo "</td>";

echo "<td  align='right'  >" ;
echo "<font color='#000000'>" . $row['REQ_QTY'] . "</font>";
echo "</td>";


echo '</tr>';
}

echo '</table>';
echo "<p></p>";
echo "<font color='#000000'>" . "ACTIVE PART NUMBER : <b>" . $alt_no_3  . "</b></font>";
echo "<p></p>";
echo "</div>";


}else {
    echo "<font color='red'>No Indent Found</font>";
    echo '<p></p>';
    echo "<font color='#000000'>" . "ACTIVE PART NUMBER :<b>" . $alt_no_3  . "</b></font>";
}

}
else{
    echo "Invalid FolioNumber. Please try again";
}

?>

