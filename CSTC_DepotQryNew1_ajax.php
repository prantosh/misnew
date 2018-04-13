<?php 
session_start();
if(!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID'])=='')) {
    header('Location: access.php');    
    
}
if(isset($_POST['folio_no1'])){
//Connect to database from here
require_once('Connections/cstccon.php');

$CUR_FIN_YR = $_SESSION['CUR_FIN_YR'];

//$unit_to = $_SESSION['unit_to'] ;
$folio_no=htmlspecialchars($_POST['folio_no1'],ENT_QUOTES);
$v_no_add=htmlspecialchars($_POST['v_no_add1'],ENT_QUOTES);
//echo $folio_no . $v_no_add;
$sql_itmv="SELECT * FROM bintxnitm WHERE PART_NO = '" . $folio_no . "' and BNTXN_ID = '" . $v_no_add . "'";
$result_itmv=mysqli_query($cstccon,$sql_itmv);
if(mysqli_num_rows($result_itmv) > 0){
    echo 'Sorry. The Item is already included in the existing voucher.';
}


$_SESSION['folio_no'] = $folio_no;
$qty=htmlspecialchars($_POST['qty_to_iss'],ENT_QUOTES);
$unit_to=htmlspecialchars($_POST['unit_to_new'],ENT_QUOTES);
$unit_from=htmlspecialchars($_POST['unit_from_new'],ENT_QUOTES);
//echo $unit_to . $qty;
$sql_itm="DELETE FROM item_issue WHERE PART_NO = '" . $folio_no . "'";
$result_itm=mysqli_query($cstccon,$sql_itm);

$sql_itmz="DELETE FROM item_issue WHERE QTY = 0";
$result_itmz=mysqli_query($cstccon,$sql_itmz);

$sql_itm="SELECT * FROM bincrd WHERE PART_NO = '" . $folio_no . "' and FIN_YR = '" . $CUR_FIN_YR . "'";
//$sql_itm="SELECT * FROM depot_disp1 WHERE PART_NO = '" . $folio_no . "'";
$result_itm=mysqli_query($cstccon,$sql_itm);
$row_itm=mysqli_fetch_array($result_itm);
$stock = $row_itm['OPNG_QTY'] + $row_itm['RCT_QTY'] - $row_itm['ISS_QTY'] ;
//echo $stock . $qty;
if($qty > $stock){
    echo 'Sorry. Issue Quantity is Greater than Available Stock';
}

$sql_itmi = "select A.CC_ID,SUM(B.REQ_QTY) TOT_QTY FROM indnt A,indntitm B WHERE A.CC_ID = '" . $unit_to . "' and A.INDNT_ID = B.INDNT_ID AND  B.PART_NO = '" . $folio_no . "' group by A.CC_ID ORDER BY A.CC_ID";
$result_itmi=mysqli_query($cstccon,$sql_itmi);
if(mysqli_num_rows($result_itmi) > 0){
$row_itmi=mysqli_fetch_array($result_itmi);
$tot_qty_indent = $row_itmi['TOT_QTY'];}
else{
    $tot_qty_indent = 0;
}

$sql_itmg = "select A.PRTY_CD,SUM(B.ITM_QTY) TOT_QTY FROM bintxn A,bintxnitm B WHERE A.PRTY_CD = '" . $unit_to . "' and A.BNTXN_ID = B.BNTXN_ID AND  B.PART_NO = '" . $folio_no . "' group by A.PRTY_CD HAVING SUM(B.ITM_QTY) < 0 ORDER BY A.PRTY_CD";
$result_itmg=mysqli_query($cstccon,$sql_itmg);
if(mysqli_num_rows($result_itmg) > 0){
$row_itmg=mysqli_fetch_array($result_itmg);
$tot_qty_issue = $row_itmg['TOT_QTY'];}
else{
    $tot_qty_issue = 0;
}

$balance_qty = 0;
$balance_qty = $tot_qty_indent - $tot_qty_issue ;

if($qty > $balance_qty){
  //  echo 'Sorry. Issue Quantity is Greater than Indent Quantity';
}


$sql_itmtot="select count(*) tot FROM item_issue";
$result_itmtot=mysqli_query($cstccon,$sql_itmtot);
$row_itmtot=mysqli_fetch_array($result_itmtot);   

$sql_itmZ1="SELECT a.PART_NO,SUM(a.ITM_QTY) TOT_ITEM_QTY FROM bintxnitm a,bintxn b where a.PART_NO = '$folio_no' and  a.BNTXN_ID = b.BNTXN_ID AND b.FIN_YR = '$CUR_FIN_YR' and b.PRTY_CD = '$unit_to' group by a.PART_NO";
$result_itmZ1=mysqli_query($cstccon,$sql_itmZ1);
if(mysqli_num_rows($result_itmZ1) > 0){
$row_itmZ1=mysqli_fetch_array($result_itmZ1);
$ytd_issue = $row_itmZ1['TOT_ITEM_QTY'] ;
}
else{
    $ytd_issue = 0;
}



//echo $folio_no . '*' . $qty . '*' . $unit . '*' . $ytd_issue . '*' . $stock ;


    
if($row_itmtot['tot'] <= 50){ 
    
    $sql_itmv="SELECT * FROM bintxnitm WHERE PART_NO = '" . $folio_no . "' and BNTXN_ID = '" . $v_no_add . "'";
$result_itmv=mysqli_query($cstccon,$sql_itmv);
if(mysqli_num_rows($result_itmv) <= 0){
    
 //   if($qty <= $stock && $qty <= $balance_qty){
      if($qty <= $stock){
$sql_itm="INSERT INTO item_issue(PART_NO,QTY,UNIT,UNIT_FROM,ytd_issue,stock) VALUES('" . $folio_no . "'," . $qty . ",'" . $unit_to . "','" . $unit_from . "'," . $ytd_issue . "," . $stock . ")";
$result_itm=mysqli_query($cstccon,$sql_itm);
    }
}
}
echo "<style type='text/css'>";
//echo "table.alternate tr:nth-child(odd) {background-color: #ffffff;color:black;}";
//echo "table.alternate tr:nth-child(even) {background-color: grey;color:white;}";

echo "</style>";

       $sql_itm="SELECT A.PART_NO,A.QTY,A.ytd_issue,A.stock,B.ITM_NM,B.ALT_NO,B.ALT_NO_2,B.UOM_ID FROM item_issue A, itm B where A.PART_NO = B.PART_NO";
        $result_itm=mysqli_query($cstccon,$sql_itm);
        $row_itm=mysqli_fetch_array($result_itm);
       
        echo "FOLLOWING ITEMS WILL BE ISSUED";

        echo '<table id="tbl_id" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example"class="rounded-corners">';
        echo "<tbody>";
                        echo "<tr style='margin: 0; padding: 0; border-collapse: collapse;'>";
                        echo "<th align='center'>SRL</th>";
                        echo "<th align='center'>FOLIO NO.</th>";
                        echo "<th align='center'style='margin: 0; padding: 0; border-collapse: collapse;'>PART NO.</th>";
                        echo "<th align='center'style='margin: 0; padding: 0; border-collapse: collapse;'>DESCRIPTION</th>";
                        echo "<th align='center'style='margin: 0; padding: 0; border-collapse: collapse;'>UOM</th>";
                        echo "<th align='center'style='margin: 0; padding: 0; border-collapse: collapse;'>YTD ISSUED</th>";
                        echo "<th align='center'style='margin: 0; padding: 0; border-collapse: collapse;'>STOCK</th>";
                        echo "<th align='center'style='margin: 0; padding: 0; border-collapse: collapse;'>QTY</th>";
                        echo "</tr>";
                                $i = 1;                       
                                $x = 1;
                    do{
                                
                        echo "<tr style='margin: 0; padding: 0; border-collapse: collapse;'>";
                        echo "<td>" . $x . "</td>";
                        echo "<td>" . $row_itm['PART_NO'] . "</td>";
                        echo "<td>" . $row_itm['ALT_NO'] . "," . $row_itm['ALT_NO'] ."</td>";
                        echo "<td>" . $row_itm['ITM_NM'] . "</td>";
                        echo "<td>" . $row_itm['UOM_ID'] . "</td>";
                        
                        $part_no = $row_itm['PART_NO'];
                        echo "<td align='right'>" . -$row_itm['ytd_issue'] . "</td>";
                  
                        echo "<td align='right'>" . $row_itm['stock'] . "</td>";
                        echo "<td align='right'>" . $row_itm['QTY'] . "</td>";
                        echo "</tr>";
                          $x = $x + 1;
                          } while ($row_itm = mysqli_fetch_assoc($result_itm));
                        echo "</tbody>";
                        echo "</table>";
                        echo "</div>";
                        echo "</div>";
	
}

?>
