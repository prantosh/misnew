<?php 
session_start();
if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');    
    
}
//echo 'kolkata';
if(isset($_POST['folio_no1'])){
//Connect to database from here
require_once('Connections/cstccon.php');


$CUR_FIN_YR = $_SESSION['CUR_FIN_YR'];

$folio_no=htmlspecialchars($_POST['folio_no1'],ENT_QUOTES);
//echo '*' . $folio_no ;
$unit = $_SESSION['UNIT'];
$sql_itm="SELECT * FROM itm A where PART_NO = '" . $folio_no . "'";
$result_itm=mysqli_query($cstccon,$sql_itm);
$row_itm =mysqli_fetch_array($result_itm);
if($row_itm['PART_NO'] == $folio_no)
    {
        $sql_itm1="SELECT * from bincrd_depot where DEPOT = '" . $_SESSION['UNIT'] . "' AND FIN_YR = '$CUR_FIN_YR' AND PART_NO = '" . $folio_no . "'";
        $result_itm1=mysqli_query($cstccon,$sql_itm1);
        $row_itm1 =mysqli_fetch_array($result_itm1);
        if($row_itm1['OPNG_QTY'] + $row_itm1['RCT_QTY'] - $row_itm1['ISS_QTY'] > 0)
        {
            echo '<table id="tbl_id" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example"class="rounded-corners">';

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
            echo "<font >" . $row_itm['PART_NO'] . "</font>";
            echo "</td>";
                $sql_itm13="SELECT ALT_NO_3 from current_part_no where PART_NO = '" . $folio_no . "'";
                $result_itm13=mysqli_query($cstccon,$sql_itm13);
                $row_itm13 =mysqli_fetch_array($result_itm13);
            echo "<td>";
            echo "<font >" . $row_itm13['ALT_NO_3'] . "</font>";
            echo "</td>";
            echo "<td >";
            echo "<font >" . $row_itm['ITM_NM'] . "</font>";
            echo "</td>";
            echo "<td >";
            echo "<font >" . $row_itm['UOM_ID'] . "</font>"  ;
            echo "</td>";
            echo "<td>";
            echo "<font >" . ($row_itm1['OPNG_QTY'] + $row_itm1['RCT_QTY'] - $row_itm1['ISS_QTY']) . "</font>";
            echo "</tr>";


echo "</table>";    
    } 
  else{
        echo '<script type="text/javascript">';
        echo "alert('No stock. Item cannot be issued.')";
        echo '</script>';
}                                         
    
}
else{
    echo $row_itm['PART_NO'];
        echo '<script type="text/javascript">';
        echo "alert('Item not found in the Item Master. Please contact Central Store to include the item')";
        echo '</script>';}
        

}
?>
