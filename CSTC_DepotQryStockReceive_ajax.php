<?php 
session_start();
if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');    
    
}
if(isset($_POST['folio_no1'])){
//Connect to database from here
require_once('Connections/cstccon.php');


$CUR_FIN_YR = $_SESSION['CUR_FIN_YR'];

$folio_no=htmlspecialchars($_POST['folio_no1'],ENT_QUOTES);

$unit = $_SESSION['UNIT'];


$sql_itm="SELECT A.PART_NO,A.ALT_NO,A.ALT_NO_2,A.UOM_ID,A.ITM_NM,B.ISS_QTY FROM itm A, bincrd_depot B where A.PART_NO = '" . $folio_no . "' and A.PART_NO = B.PART_NO AND B.DEPOT = '" . $unit . "' and B.FIN_YR = '" . $CUR_FIN_YR . "'";
$result_itm=mysqli_query($cstccon,$sql_itm);
$row_itm =mysqli_fetch_array($result_itm);
        if($row_itm['PART_NO'] == $folio_no)
{
    
    $sql_itm1="SELECT OPNG_QTY,ISS_QTY,RCT_QTY from bincrd_depot where DEPOT = '" . $unit . "' and FIN_YR = '$CUR_FIN_YR' AND PART_NO = '" . $folio_no . "'";
    $result_itm1=mysqli_query($cstccon,$sql_itm1);
    $row_itm1 =mysqli_fetch_array($result_itm1);
    if($row_itm1['OPNG_QTY'] + $row_itm1['RCT_QTY'] - $row_itm1['ISS_QTY'] > 0)
    {
echo '<table align="center"id="tbl_id1" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example"class="rounded-corners">';


echo "<tr>";
echo "<th >";
echo "FOLIO NO";
echo "</th>";
echo "<th >";
echo "PART NO";
echo "</th>";
echo "<th >";
echo "DESCRIPTION";
echo "</th>";
echo "<th >";
echo "UOM" ;
echo "</th>";
echo "<th >";
echo "STOCK" ;
echo "</th>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "<font style = 'color:black;'>" . $row_itm['PART_NO'] ;
echo "</td>";
echo "<td>";
echo "<font style = 'color:black;'>" . $row_itm['ALT_NO'] . ',' . $row_itm['ALT_NO_2'] ;
echo "</td>";
echo "<td >";
echo "<font style = 'color:black;'>" . $row_itm['ITM_NM'] ;
echo "</td>";
echo "<td >";
echo "<font style = 'color:black;'>" . $row_itm['UOM_ID']   ;
echo "</td>";
echo "<td>";
echo "<font style = 'color:black;'>" . ($row_itm1['OPNG_QTY'] + $row_itm1['RCT_QTY'] - $row_itm1['ISS_QTY']) ;
echo "</tr>";


echo "</table>";    
    } 
  else{
        echo '<script type="text/javascript">';
        echo "alert('No stock. ')";
        echo '</script>';
}                                         
    

        
}
else{
    echo $row_itm['PART_NO'];
        echo '<script type="text/javascript">';
        echo "alert('No stock. ')";
        echo '</script>';}
}
?>
