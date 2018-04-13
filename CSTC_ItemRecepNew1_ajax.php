<?php 
session_start();
if(isset($_POST['folio_no1'])){
//Connect to database from here
require_once('Connections/cstccon.php');

$CUR_FIN_YR = $_SESSION['CUR_FIN_YR'];

$unit = $_SESSION['UNIT'] ;
$folio_no=htmlspecialchars($_POST['folio_no1'],ENT_QUOTES);
$depot_receive_date1=htmlspecialchars($_POST['depot_receive_date1'],ENT_QUOTES);
$item_rate=htmlspecialchars($_POST['item_rate'],ENT_QUOTES);
$_SESSION['folio_no'] = $folio_no;
$qty_to_rec=htmlspecialchars($_POST['qty_to_rec'],ENT_QUOTES);

//**************************************************
//now validating the PF A/C NO
$sql_itm="DELETE FROM item_receive_local_purchase WHERE PART_NO = '" . $folio_no . "'";
$result_itm=mysqli_query($cstccon,$sql_itm);

$sql_itmz="DELETE FROM item_receive_local_purchase WHERE QTY = 0";
$result_itmz=mysqli_query($cstccon,$sql_itmz);

$sql_itm="SELECT * FROM itm WHERE PART_NO = '" . $folio_no . "'";
$result_itm=mysqli_query($cstccon,$sql_itm);

if(mysqli_num_rows($result_itm) >  0){
//echo $folio_no . "'," . $qty_to_rec . ",'" . $unit . "','" . $depot_receive_date1 . "'," . $item_rate . ")";


$sql_itm="INSERT INTO item_receive_local_purchase(PART_NO,QTY,DEPOT,DOC_DT,ITEM_RATE) VALUES('" . $folio_no . "'," . $qty_to_rec . ",'" . $unit . "','" . $depot_receive_date1 . "'," . $item_rate . ")";
$result_itm=mysqli_query($cstccon,$sql_itm);


echo "<style type='text/css'>";

echo "</style>";

       $sql_itm="SELECT A.ITEM_RATE,A.PART_NO,A.QTY,B.ITM_NM,B.ALT_NO,B.ALT_NO_2,B.UOM_ID FROM item_receive_local_purchase A, itm B where A.PART_NO = B.PART_NO and A.DEPOT = '" . $unit . "'";
        $result_itm=mysqli_query($cstccon,$sql_itm);
        $row_itm=mysqli_fetch_array($result_itm);
       
        echo "<H6><font color='black'>FOLLOWING ITEMS WILL BE RECEIVED</font></H6>";

echo '<table align="center"id="tbl_id1" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example"class="rounded-corners">';
        echo "<tbody>";
                        echo "<tr style='margin: 0; padding: 0; border-collapse: collapse;'>";
                        echo "<th align='center'>SRL</th>";
                        echo "<th align='center'>FOLIO NO.</th>";
                        echo "<th align='center'style='margin: 0; padding: 0; border-collapse: collapse;'>PART NO.</th>";
                        echo "<th align='center'style='margin: 0; padding: 0; border-collapse: collapse;'>DESCRIPTION</th>";
                        echo "<th align='center'style='margin: 0; padding: 0; border-collapse: collapse;'>UOM</th>";
                         echo "<th align='center'style='margin: 0; padding: 0; border-collapse: collapse;'>QTY</th>";
                        echo "<th align='center'style='margin: 0; padding: 0; border-collapse: collapse;'>UNIT RATE</th>";
                        echo "<th align='center'style='margin: 0; padding: 0; border-collapse: collapse;'>VALUE</th>";

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

                        

                        
                       
                        echo "<td align='right'>" . $row_itm['QTY'] . "</td>";
                         echo "<td align='right'>" . number_format($row_itm['ITEM_RATE'],2) . "</td>";
                         $value_tot = $row_itm['QTY'] * $row_itm['ITEM_RATE'] ;
                          echo "<td align='right'>" . number_format($value_tot,2) . "</td>";
                        echo "</tr>";
                          $x = $x + 1;
                          } while ($row_itm = mysqli_fetch_assoc($result_itm));
                        echo "</tbody>";
                        echo "</table>";
                        echo "</div>";
                        echo "</div>";

        
}

       
       
	
}

?>
